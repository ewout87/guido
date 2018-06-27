<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\User;
use Carbon\Carbon;

class productController extends Controller
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
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }
        $products = Product::orderBy('created_at', 'desc') -> simplePaginate(4);
        return view('products.cards', compact('products', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //Check for correct user
        if (auth()->user()->role_id===3){
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }
        //gidsen ophalen
        $users= User::where([
        ['role_id', 2],
        ['status', 1],
        ])->get();
        return view('products.create')->with('users', $users);
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
        'titel' => 'required'
      ]) ;
      //Handle file Upload
      if($request->hasFile('bijlage')){
        //get filename with extension
        $filenameWithExt = $request->file('bijlage')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('bijlage')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //upload image
        $path = $request -> file('bijlage') -> storeAs('/public/bijlage', $fileNameToStore);
      }

      $product = new Product;
      $product->titel = $request->titel;
      $product->beschrijving = $request->beschrijving;
      $product->duur = $request->duur;
      $product->max_aantal = $request->max_aantal;
      $product->status = $request->status;
      if($request->hasFile('bijlage')){
        $product->bijlage = $fileNameToStore;
      }
      $product->duur = $request->duur;
      $product->users()->sync($request->user_id);
      $product->save();

      return redirect('/products') -> with ('success', 'Product aangemaakt');
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
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }

        $product = Product::find($id);
        return view ('products.show') -> with('product', $product);
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
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }

        //gidsen ophalen die dit product nog niet beheersen
        $users= User::whereDoesntHave('products', function ($query) use ($id) {
        $query->where('products.id', '=', $id);})->where([
        ['role_id', 2],
        ['status', 1],
        ])->get();
        $product = Product::find($id);
        return view ('products.edit', compact('product', 'users'));
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
        'titel' => 'required',
      ]) ;
      //Handle file Upload
      if($request->hasFile('bijlage')){
        //get filename with extension
        $filenameWithExt = $request->file('bijlage')->getClientOriginalName();
        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get just ext
        $extension = $request->file('bijlage')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //upload image
        $path = $request -> file('bijlage') -> storeAs('/public/bijlage', $fileNameToStore);
      }

      $product = Product::find($id);
      $product->titel = $request->titel;
      $product->beschrijving = $request->beschrijving;
      $product->duur = $request->duur;
      $product->max_aantal = $request->max_aantal;
      $product->status = $request->status;
      if($request->hasFile('bijlage')){
        $product->bijlage = $fileNameToStore;
      }
      $product->duur = $request->duur;
      $product->users()->sync($request->user_id);
      $product->save();

      return redirect('/products') -> with ('success', 'Product bijgewerkt');
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
        if (auth()->user()->role_id===3){
          return redirect('dashboard')->with('error', 'Unauthorized Page');
        }

        //Delete image
        Storage::delete('public/bijlages/'.$product->bijlage);
      
        $product = Product::find($id);
        $product -> delete();

        return redirect('/products') -> with ('success', 'Product verwijderd');
    }
    public function download($id) {
      $product = Product::find($id);
      $pathToFile = "/public/bijlage/".$product -> bijlage;

      return Storage::download($pathToFile);
    }
    
}

