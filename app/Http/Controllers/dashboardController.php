<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Agenda;
use App\Tour;
use App\Group;
use App\Product;
use Carbon\Carbon;
use DB;

class dashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Cijfers
        //gemiddelde aantal bezoekers per rondleiding deze maand
        $lastMonth = Carbon::now('Europe/Brussels')->subMonth()->format('m');
        $nameLastMonth = Carbon::now('Europe/Brussels')->subMonth()->format('F');
        $aantalBezoekersLastMonth = Tour::where('status', 1)->whereMonth('datum', '=', $lastMonth)->sum('aantal_totaal');
        $aantalToursLastMonth = Tour::where('status', 1)->whereMonth('datum', '=', $lastMonth)->count('status');
        $avgBezoekersLastMonth = round($aantalBezoekersLastMonth/$aantalToursLastMonth, 1);
      
        //groei aantal bezoekers tov vorig jaar
        $lastYear = Carbon::now('Europe/Brussels')->subYear()->format('y');
        $aantalBezoekersLastMonthLastYear = Tour::where('status', 1)->whereMonth('datum', '=', $lastMonth)->whereYear('datum', '=', $lastYear)->sum('aantal_totaal');
        $aantalToursLastMonthLastYear = Tour::where('status', 1)->whereMonth('datum', '=', $lastMonth)->whereYear('datum', '=', $lastYear)->count('status');
        $growthAantalBezoekers = $aantalBezoekersLastMonth-$aantalBezoekersLastMonthLastYear;
      
        //Grafieken
        //aantal bezoekers
        $months = Tour::select('datum')->where('datum', '>=', Carbon::now('Europe/Brussels')->subMonths(6))->where('status', 1)->groupBy('datum')->get()->toArray();
        $months = array_column($months, 'datum');
        $aantalVolwassenen = Tour::select(DB::raw("sum(aantal_volwassenen) as volwassenen"))->where('datum', '>=', Carbon::now('Europe/Brussels')->subMonths(6))->where('status', 1)->groupBy('datum')->get()->toArray();
        $aantalVolwassenen = array_column($aantalVolwassenen, 'volwassenen');
        $aantalKinderen = Tour::select(DB::raw("sum(aantal_kinderen) as kinderen"))->where('datum', '>=', Carbon::now('Europe/Brussels')->subMonths(6))->where('status', 1)->groupBy('datum')->get()->toArray();
        $aantalKinderen = array_column($aantalKinderen, 'kinderen');
        $totaal = Tour::select(DB::raw("sum(aantal_totaal) as totaal"))->where('datum', '>=', Carbon::now('Europe/Brussels')->subMonths(6))->where('status', 1)->groupBy('datum')->get()->toArray();
        $totaal = array_column($totaal, 'totaal');
          
        //gelopen rondleidingen per gids
        $usersLastMonth = User::whereHas('tours', function ($query) {
        $query->where('status', 1)->whereMonth('datum', '=', Carbon::today('Europe/Brussels')->submonth()->format('m'));
        })->select('name')->orderBy('id', 'asc')->get()->toArray();
        $usersLastMonth = array_column($usersLastMonth, 'name');
        $toursLastMonthByUser = Tour::select(DB::raw("count('status') as aantal"))->where('status', 1)->whereMonth('datum', '=', $lastMonth)->groupBy('user_id')->orderBy('user_id', 'asc')->get()->toArray();
        $toursLastMonthByUser = array_column($toursLastMonthByUser, 'aantal');
        
        //gelopen rondleidingen per product
        $productsLastMonth = Product::whereHas('tours', function ($query) {
        $query->whereMonth('datum', '=', Carbon::today('Europe/Brussels')->submonth()->format('m'));
        })->select('titel')->orderBy('id', 'asc')->get()->toArray();
        $productsLastMonth = array_column($productsLastMonth, 'titel');
        $toursLastMonthByProduct = Tour::select(DB::raw("count('status') as aantal"))->where('status', 1)->whereMonth('datum', '=', $lastMonth)->groupBy('product_id')->orderBy('product_id', 'asc')->get()->toArray();
        $toursLastMonthByProduct = array_column($toursLastMonthByProduct, 'aantal');
      
        //Vandaag
        $today = Carbon::today('Europe/Brussels')->format('d-m');
        $usersAvailableToday = User::whereHas('agendasAvailable', function ($query){
        $query->whereDate('datum', '=', Carbon::today('Europe/Brussels')->toDateString());
        })->whereDoesntHave('tours', function ($query) {
        $query->whereDate('datum', '=', Carbon::today('Europe/Brussels')->toDateString());
        })->get();
        $usersAssignedToday = User::whereHas('tours', function ($query) {
        $query->whereDate('datum', '=', Carbon::today('Europe/Brussels')->toDateString() );
        })->get();
        $toursToday = Tour::whereDate('datum', '=', Carbon::today('Europe/Brussels')->toDateString())->get();
      
        //What's New
        $newUsers = User::where('created_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $updatedUsers = User::where('updated_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $newAgendaItems = Agenda::where('created_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $updatedAgendaItems = Agenda::where('updated_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $newProducts = Product::where('created_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $updatedProducts = Product::where('updated_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $newGroups = Group::where('created_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $updatedGroups = Group::where('updated_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $newTours = Tour::where('created_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
        $updatedTours = Tour::where('updated_at', '>=', Carbon::now('Europe/Brussels')->subDay(7))->get();
            
        //Message Board
        $posts = Post::where('created_at','>=', Carbon::now('Europe/Brussels')->subDay(7))->orderBy('created_at', 'desc')->paginate(5);
      
         ;
        return view('dashboard', compact('posts', 'noUsersAvailable', 'noUsersAssigned', 'usersAvailableToday', 'today', 'aantalBezoekersLastMonth',
        'usersAssignedToday', 'toursToday', 'lastMonth','nameLastMonth', 'newUsers', 'updatedUsers', 'avgBezoekersLastMonth', 'growthAantalBezoekers', 
        'newTours', 'updatedTours', 'newAgendaItems', 'updatedAgendaItems', 'newProducts', 'updatedProducts', 'newGroups', 'updatedGroups', 'thisMonth'
        ))
        ->with('usersLastMonth',json_encode($usersLastMonth,JSON_NUMERIC_CHECK))
        ->with('toursLastMonthByUser', json_encode($toursLastMonthByUser, JSON_NUMERIC_CHECK))    
        ->with('productsLastMonth',json_encode($productsLastMonth,JSON_NUMERIC_CHECK))
        ->with('toursLastMonthByProduct', json_encode($toursLastMonthByProduct, JSON_NUMERIC_CHECK))
        ->with('months', json_encode($months, JSON_NUMERIC_CHECK))
        ->with('totaal', json_encode($totaal, JSON_NUMERIC_CHECK))
        ->with('volwassenen', json_encode($aantalVolwassenen, JSON_NUMERIC_CHECK))
        ->with('kinderen', json_encode($aantalKinderen, JSON_NUMERIC_CHECK));
    }
  
    public function store (Request $request) 
    {
      $this->validate($request, [
        'body' => 'required',
      ]) ;

      $post = new Post;
      $post->body = $request->body;
      $post->author_id = $request->author_id;
      $post->save();
      
      return redirect('/dashboard') -> with ('success', 'post created');
    }
}