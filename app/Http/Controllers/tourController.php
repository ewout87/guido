<?php

namespace App\Http\Controllers;


use App\Notifications\tourAssigned;
use Illuminate\Http\Request;
use App\Tour;
use App\User;
use App\Group;
use App\Product;
use App\Agenda;
use DB;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class tourController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Check for gids
        if (auth()->user()->role_id===2){
          $tours = Tour::where([['datum','>=', Carbon::today('Europe/Brussels')->toDateString()], ['user_id', auth()->user()->id]])->
          orderBy('datum', 'desc') -> paginate(10);
        
        return view('tours.index')->with('tours', $tours);
        }
        //Check for balie
        if (auth()->user()->role_id===3){
          $tours = Tour::where('datum','>=', Carbon::today('Europe/Brussels')->toDateString())->orderBy('datum', 'desc') -> paginate(10);
        
        return view('tours.index')->with('tours', $tours);
        }
        //Meldingen
        //geen toegewezen gidsen
        $noUsersAssigned = Tour::doesntHave('user')->get();
        $noStatusClosed = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->get();
        $tours = Tour::orderBy('created_at', 'desc') -> paginate(10);
        
        return view('tours.index', compact('tours', 'noUsersAssigned', 'noStatusClosed'));
    }
  
    public function search (Request $request)
    {
        //Check for gids
        if (auth()->user()->role_id===2){
         return redirect('tours.index')->with('error', 'Unauthorized Page');
        }  
        // Gets the query string from our form submission
        $query = $request->input('search');
        // Returns an array of articles that have the query string located somewhere within
        // our articles titles. Paginates them so we can break up lots of search results.
        $tours = Tour::first()
          ->join('products', 'tours.product_id', '=', 'products.id')
          ->join('users', 'tours.user_id', '=', 'users.id')
          ->join('groups', 'tours.group_id', '=', 'groups.id')
          ->where('datum', 'LIKE', '%' . $query . '%')
          ->orwhere('products.titel', 'LIKE', '%' . $query . '%')
          ->orwhere('users.name', 'LIKE', '%' . $query . '%')
          ->orwhere('groups.naam', 'LIKE', '%' . $query . '%')
          ->paginate(10);
      
        $noUsersAssigned = Tour::doesntHave('user')->get();
        $noStatusClosed = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->get();
        // returns a view and passes the view the list of articles and the original query.
        return view('tours.index', compact('tours', 'noUsersAssigned', 'noStatusClosed'));
    }
  
    public function noStatusClosed()
    {
      //Check for correct user
      if (auth()->user()->role_id!==4){
        return redirect('tours.index')->with('error', 'Unauthorized Page');
      }
      $noUsersAssigned = Tour::doesntHave('user')->get();
      $noStatusClosed = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->get();
      
      $tours = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->orderBy('datum', 'desc')->paginate(10);

      return view('tours.index', compact('tours', 'noUsersAssigned', 'noStatusClosed'));
    }
      
    public function noUsersAssigned()
    {
      //Check for correct user
      if (auth()->user()->role_id!==4){
        return redirect('tours.index')->with('error', 'Unauthorized Page');
      }
      $noUsersAssigned = Tour::doesntHave('user')->get();
      $noStatusClosed = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->get();
      
      $tours = Tour::doesntHave('user')->orderBy('datum', 'desc')->paginate(10);

      return view('tours.index', compact('tours', 'noUsersAssigned', 'noStatusClosed'));
    }
  
    public function orderBy($id, $dir)
    {
      //Check for correct user
      if (auth()->user()->role_id===2){
        return redirect('tours.index')->with('error', 'Unauthorized Page');
      }
      $noUsersAssigned = Tour::doesntHave('user')->get();
      $noStatusClosed = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->get();
      
      $tours = Tour::orderBy($id, $dir)->paginate(10);

      return view('tours.index', compact('tours', 'noUsersAssigned', 'noStatusClosed'));
    }
    
    public function filterByDay($day)
    {
      //Check for correct user
      if (auth()->user()->role_id===2){
        return redirect('tours.index')->with('error', 'Unauthorized Page');
      } 
      $noUsersAssigned = Tour::doesntHave('user')->get();
      $noStatusClosed = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->get();
      
      $tours = Tour::where('datum','=', Carbon::$day('Europe/Brussels')->toDateString())->orderBy('datum', 'desc') -> paginate(10);

      return view('tours.index', compact('tours', 'noUsersAssigned', 'noStatusClosed'));
    }
  
    public function filterByWeek($week)
    {
      //Check for correct user
      if (auth()->user()->role_id===2){
        return redirect('tours.index')->with('error', 'Unauthorized Page');
      } 
      $noUsersAssigned = Tour::doesntHave('user')->get();
      $noStatusClosed = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->get();
      $date = Carbon::now('Europe/Brussels')->$week();
      
      $tours = Tour::where([['datum','>=', $date->startOfWeek()->toDateString()], ['datum','<=', $date->endOfWeek()->toDateString()]])->orderBy('datum', 'desc') -> paginate(10);

      return view('tours.index', compact('tours', 'noUsersAssigned', 'noStatusClosed'));
    }
  
    public function filterByMonth($month)
    {
      //Check for correct user
      if (auth()->user()->role_id===2){
        return redirect('tours.index')->with('error', 'Unauthorized Page');
      } 
      $noUsersAssigned = Tour::doesntHave('user')->get();
      $noStatusClosed = Tour::where([['status', 0],['datum', '<', Carbon::today('Europe/Brussels')->toDateString()]])->get();
      $date = Carbon::now('Europe/Brussels')->$month();
      
      $tours = Tour::where([['datum','>=', $date->startOfMonth()->toDateString()], ['datum','<=', $date->endOfMonth()->toDateString()]])->orderBy('datum', 'desc') -> paginate(10);

      return view('tours.index', compact('tours', 'noUsersAssigned', 'noStatusClosed'));
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check for correct user
        if (auth()->user()->role_id===2){
          return redirect('tours.index')->with('error', 'Unauthorized Page');
        }
        //filter actieve producten
        $products = Product::where('status', 1)->get();
        $groups = Group::all();
        return view('tours.create', compact('products', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request) 
    {
      $this->validate($request, [
        'datum' => 'required',
        'status' => 'required',
        'product_id' => 'required',
        'group_id' => 'required'
      ]) ;

      $tour = new Tour;
      $tour->datum = $request->datum;
      $tour->tijdstip = $request->tijdstip;
      $tour->status = $request->status;
      $tour->aantal_volwassenen = $request->aantal_volwassenen;
      $tour->aantal_kinderen = $request->aantal_kinderen;
      $tour->aantal_totaal = $request->aantal_kinderen + $request->aantal_volwassenen;
      $tour->group_id = $request->group_id;
      $tour->user_id = $request->user_id;
      $tour->product_id = $request->product_id;
      $tour->save();

      return redirect('/tours') -> with ('success', 'Rondleiding aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = Tour::Find($id);
        return view ('tours.show') -> with('tour', $tour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Check for correct user
        if (auth()->user()->role_id===2){
          return redirect('tours.index')->with('error', 'Unauthorized Page');
        }
        
        $tour = Tour::find($id);
        $datum = $tour->datum;
      
        //producten die niet werden toegekend
        $products = Product::whereDoesntHave('tours', function ($query) use ($id) {
        $query->where('tours.id', '=', $id);
        })->where('status', 1)->get();
        //groepen die niet werden toegekend
        $groups = Group::whereDoesntHave('tour', function ($query) use ($id) {
        $query->where('tours.id', '=', $id);
        })->get();
        //beschikbare gebruikers met de vereiste kennis
        $usersAvailable = User::select('users.name', 'users.id')
          ->join('product_user', 'product_user.user_id', '=', 'users.id')
          ->join('products', 'product_user.product_id', '=', 'products.id')
          ->join('agenda_user', 'agenda_user.user_id', '=', 'users.id')
          ->join('agendas', 'agenda_user.agenda_id', '=', 'agendas.id')
          ->join('language_user', 'language_user.user_id', '=', 'users.id')
          ->join('groups', 'groups.language_id', '=', 'language_user.language_id')
          ->join('tours', 'tours.datum', '=', 'agendas.datum')
          ->where([
            ['products.id', '=', $tour->product_id],
            ['groups.id', '=', $tour->group_id],
            ['agendas.datum', '=', $tour->datum]
          ])
          ->whereDoesntHave('tours', function ($query) use ($datum) {
            $query->where('tours.datum', '=', $datum);})
          ->withCount(['tours' => function ($query) {
            $query->where('status', '=', 0);}])
          ->orderBy('tours_count', 'desc')
          ->groupBy('users.id', 'users.name')
          ->get();
        //zoek gebruikers die al werden toegewezen aan een andere rondleiding op dezelfde datum
        $otherUsersThisDay = User::select('users.name', 'users.id')
          ->join('product_user', 'product_user.user_id', '=', 'users.id')
          ->join('products', 'product_user.product_id', '=', 'products.id')
          ->join('agenda_user', 'agenda_user.user_id', '=', 'users.id')
          ->join('agendas', 'agenda_user.agenda_id', '=', 'agendas.id')
          ->join('language_user', 'language_user.user_id', '=', 'users.id')
          ->join('groups', 'groups.language_id', '=', 'language_user.language_id')
          ->join('tours', 'tours.datum', '=', 'agendas.datum')
          ->where([
            ['products.id', '=', $tour->product_id],
            ['groups.id', '=', $tour->group_id],
            ['agendas.datum', '=', $tour->datum],
          ])
          ->whereHas('tours', function ($query) use ($datum) {
            $query->where('tours.datum', '=', $datum);})
          ->whereDoesntHave('tours', function ($query) use ($id) {
            $query->where('tours.id', '=', $id);})
          ->withCount(['tours' => function ($query) {
            $query->where('status', '=', 0);}])
          ->orderBy('tours_count', 'desc')
          ->groupBy('users.id', 'users.name')
          ->get();
      
        return view('tours.edit', compact('tour', 'products', 'groups', 'usersAvailable', 'otherUsersThisDay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'datum' => 'required',
        'status' => 'required',
        'product_id' => 'required',
        'group_id' => 'required'
      ]) ;

      $tour = Tour::find($id);
      $tour->datum = $request->datum;
      $tour->tijdstip = $request->tijdstip;
      $tour->status = $request->status;
      $tour->aantal_volwassenen = $request->aantal_volwassenen;
      $tour->aantal_kinderen = $request->aantal_kinderen;
      $tour->aantal_totaal = $request->aantal_kinderen + $request->aantal_volwassenen;
      $tour->group_id = $request->group_id;
      $tour->user_id = $request->user_id;
      $tour->product_id = $request->product_id;
      $tour->save();
      
      if($request->user_id != NULL && $request->sendEmail == 1){
        $user = User::findOrFail($request->user_id);
        $user->notify(new tourAssigned($user));
      }
      
        return redirect('/tours') -> with ('success', 'Rondleiding bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //Check for correct user
        if (auth()->user()->role_id===2){
          return redirect('tours.index')->with('error', 'Unauthorized Page');
        }
      
        $tour = Tour::find($id);
        $tour -> delete();

        return redirect('/tours') -> with ('success', 'Rondleiding verwijderd');
    }
}
