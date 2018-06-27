<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Role;
use App\Language;

class userController extends Controller
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
          if (auth()->user()->role_id!==4){
            return redirect('dashboard')->with('error', 'Unauthorized Page');
          }
      
        $users = User::orderBy('name', 'asc') -> simplePaginate(3);
        return view('users.cards')->with('users', $users);
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
            return redirect('dashboard')->with('error', 'Unauthorized Page');
          }
        //talen ophalen
        $languages = Language::all();
        $roles = Role::all();
        return view('users.create',compact ('roles', 'languages'));
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
        'name' => 'required',
        'email' => 'required|unique:users',
        'status' => 'required',
        'role_id' => 'required',
        'avatar' => 'image|nullable|max:1999'
      ]) ;
      //Handle file Upload
      if($request->hasFile('avatar')){
        //get filename with extension
        $filenameWithExt = $request->file('avatar')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('avatar')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //upload image
        $path = $request -> file('avatar') -> storeAs('/public/avatars', $fileNameToStore);
      }
      else
        $fileNameToStore = 'noimage.jpg';
      
      //Create user
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->tel = $request->tel;
      $user->languages()->sync($request->language_id);
      $user->avatar = $fileNameToStore;
      $user->status = $request->status;
      $user->role_id = $request->role_id;
      $user->save();

      return redirect('/users') -> with ('success', 'Gebruiker aangemaakt');
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
          if (auth()->user()->role_id!==4){
            return redirect('dashboard')->with('error', 'Unauthorized Page');
          }
      
        $user = User::find($id);
        return view ('users.show') -> with('user', $user);
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
          if (auth()->user()->role_id!==4){
            return redirect('dashboard')->with('error', 'Unauthorized Page');
          }
      
        //talen ophalen die deze gebruiker nog niet beheerst
        $languages = Language::whereDoesntHave('users', function ($query) use ($id) {
        $query->where('users.id', '=', $id);})->get();
        //rollen ophalen die nog niet werden toegekend aan deze gebruiker
        $roles = Role::whereDoesntHave('users', function ($query) use ($id) {
        $query->where('users.id', '=', $id);})->get();
        
        $user = User::find($id);
        return view ('users.edit', compact('user', 'roles', 'languages'));
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
        'name' => 'required',
        'email' => 'required',
        'role_id' => 'required'
      ]) ;
      //Handle file Upload
      if($request->hasFile('avatar')){
        //get filename with extension
        $filenameWithExt = $request->file('avatar')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('avatar')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //upload image
        $path = $request -> file('avatar') -> storeAs('/public/avatars', $fileNameToStore);
      }

      $user = User::find($id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->tel = $request->tel;
      $user->languages()->sync($request->language_id);
      if($request->hasFile('avatar')){
        $user->avatar = $fileNameToStore;
      }
      $user->status = $request->status;
      $user->role_id = $request->role_id;
      $user->save();

      return redirect('/users') -> with ('success', 'Gebruiker bijgewerkt');
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
            return redirect('dashboard')->with('error', 'Unauthorized Page');
          }
      
        if($user->avatar != 'nof.jpg'){
          //Delete image
          Storage::delete('public/avatars/'.$user->avatar);
        }
        
        $user = User::find($id);
        $user -> delete();

        return redirect('/users') -> with ('success', 'Gebruiker verwijderd');
    }
  
}
