<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\User;
use Carbon\Carbon; 

class agendaController extends Controller
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
        //Check for correct user
        if (auth()->user()->role_id===3){
          return redirect('agendas')->with('error', 'Unauthorized Page');
        }
      
        $today = Carbon::today('Europe/Brussels')->toDateString();
      
        //Meldingen
        //geen beschikbare gidsen
        $noUsersAvailable = Agenda::doesntHave('usersAvailable')->where('datum', '>=', $today)->get();
      
        //agenda van deze week
        $thisSunday = Carbon::parse('this sunday')->toDateString();
        $thisWeek = Agenda::where([['datum', '<=', $thisSunday],['datum', '>=', $today]])->orderBy('datum', 'asc')->get();
        //agenda van volgende week
        $nextSunday = Carbon::parse('next sunday')->addWeeks(1)->toDateString();
        $nextWeek = Agenda::where([['datum', '<=', $nextSunday],['datum', '>', $thisSunday]])->orderBy('datum', 'asc')->get();
        //agenda van over twee weken
        $sundayTwoWeeks = Carbon::parse('next sunday')->addWeeks(2)->toDateString();
        $upcomingWeek1 = Agenda::where([['datum', '<=', $sundayTwoWeeks],['datum', '>', $nextSunday]])->orderBy('datum', 'asc')->get();
        //agenda van over drie weken
        $sundayThreeWeeks = Carbon::parse('next sunday')->addWeeks(3)->toDateString();
        $upcomingWeek2 = Agenda::where([['datum', '<=', $sundayThreeWeeks],['datum', '>', $sundayTwoWeeks]])->orderBy('datum', 'asc')->get();
      
        return view('agendas.index', compact('thisWeek', 'nextWeek', 'upcomingWeek1', 'upcomingWeek2', 'noUsersAvailable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check for correct user
        if (auth()->user()->role_id!==4){
          return redirect('agendas')->with('error', 'Unauthorized Page');
        }
        //gidsen ophalen
        $users = User::where([
        ['role_id', 2],
        ['status', 1],
        ])->get();
        return view('agendas.create')->with('users', $users);
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
        'datum' => 'required|unique:agendas',
        
      ]) ;

      $agenda = new Agenda;
      $agenda->datum = $request->datum;
      $agenda->usersAvailable()->sync($request->user_id);
      $agenda->save();

      return redirect('/agendas') -> with ('success', 'Agenda item aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //Check for correct user
        if (auth()->user()->role_id===3){
          return redirect('agendas')->with('error', 'Unauthorized Page');
        }
      
        $agenda = Agenda::find($id);
        return view ('agendas.show') -> with('agenda', $agenda);
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
        if (auth()->user()->role_id===3){
          return redirect('agendas')->with('error', 'Unauthorized Page');
        }
        //gidsen ophalen die nog niet beschikbaar zijn op deze datum
        $agenda = Agenda::find($id);
        $datum = $agenda->datum;
      
        $users = User::whereHas('agendasAvailable', function ($query) use ($id) {
          $query->where('agendas.id', '=', $id);})
        ->get();
        $usersAvailable = User::whereDoesntHave('agendasAvailable', function ($query) use ($id) {
          $query->where('agendas.id', '=', $id);})
        ->where([
        ['role_id', 2],
        ['status', 1],
        ])->get();
        
        return view ('agendas.edit', compact('agenda', 'users', 'usersLocked', 'usersAvailable', 'datum'));
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
      //Check for correct user
        if (auth()->user()->role_id===2){
          $this->validate($request, [
          ]) ;

          $agenda = Agenda::find($id);
          $agenda->datum = $request->datum;
          $agenda->usersAvailable()->attach($request->user_id);
          $agenda->save();

          return redirect('/agendas') -> with ('success', 'Agenda item bijgewerkt');
        }
      $this->validate($request, [
      ]) ;

      $agenda = Agenda::find($id);
      $agenda->datum = $request->datum;
      $agenda->usersAvailable()->sync($request->user_id);
      $agenda->save();

      return redirect('/agendas') -> with ('success', 'Agenda item bijgewerkt');
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
        if (auth()->user()->role_id!==4){
          return redirect('agendas')->with('error', 'Unauthorized Page');
        }
      
        $agenda = Agenda::find($id);
        $agenda -> delete();

        return redirect('/agendas') -> with ('success', 'Agenda item verwijderd');
    }
}
