<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Language;

class groupController extends Controller
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
        if (auth()->user()->role_id===2){
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }
      
        $groups = Group::orderBy('created_at', 'desc') -> paginate(10);
        return view('groups.index')->with('groups', $groups);
    }
  
      public function search (Request $request)
    {
        //Check for gids
        if (auth()->user()->role_id===2){
         return redirect('groups.index')->with('error', 'Unauthorized Page');
        }  
        // Gets the query string from our form submission
        $query = $request->input('search');
        // Returns an array of articles that have the query string located somewhere within
        // our articles titles. Paginates them so we can break up lots of search results.
        $groups = Group::first()
          ->join('languages', 'groups.language_id', '=', 'languages.id')
          ->where('naam', 'LIKE', '%' . $query . '%')
          ->orwhere('languages.taal', 'LIKE', '%' . $query . '%')
          ->orwhere('email', 'LIKE', '%' . $query . '%')
          ->orwhere('tel', 'LIKE', '%' . $query . '%')
          ->paginate(10);
      
        // returns a view and passes the view the list of articles and the original query.
        return view('groups.index')->with('groups', $groups);
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
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }
        //talen ophalen
        $languages = Language::all();
        return view('groups.create')->with('languages', $languages);
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
        'naam' => 'required',
        'email' => 'required',
        'tel' => 'required',
        'postcode'=> 'required',
        'aantal' => 'required',
        'language_id' => 'required'
      ]) ;

      $group = new Group;
      $group->naam = $request->naam;
      $group->email = $request->email;
      $group->tel = $request->tel;
      $group->language_id = $request->language_id;
      $group->postcode = $request->postcode;
      $group->aantal = $request->aantal;
      $group->save();

      return redirect('/groups') -> with ('success', 'Groep aangemaakt');
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
        if (auth()->user()->role_id===2){
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }
      
        $group = Group::find($id);
        return view ('groups.show') -> with('group', $group);
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
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }
        
        //talen ophalen die nog niet werden toegekend aan deze groep
        $languages = Language::whereDoesntHave('groups', function ($query) use ($id) {
        $query->where('groups.id', '=', $id);
        })->get(); 
      
        $group = Group::find($id);
        return view ('groups.edit', compact('group', 'languages'));
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
        'naam' => 'required',
        'email' => 'required',
        'tel' => 'required',
        'postcode'=> 'required',
        'aantal' => 'required',
        'language_id' => 'required'
      ]) ;

      $group = Group::find($id);
      $group->naam = $request->naam;
      $group->email = $request->email;
      $group->tel = $request->tel;
      $group->language_id = $request->language_id;
      $group->postcode = $request->postcode;
      $group->aantal = $request->aantal;
      $group->save();


      return redirect('/groups') -> with ('success', 'Groep bijgewerkt');
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
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }
      
        $group = Group::find($id);
        $group -> delete();

        return redirect('/groups') -> with ('success', 'Groep verwijderd');
    }
}
