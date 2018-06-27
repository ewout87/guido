@extends('layouts.app')

@section('content')  
<div class="row justify-content-md-center">
  <div class="col-md-6">
    <div class="container-header">
                  <h2>
                    <i class="fas fa-flask"></i>
                    Products
                  </h2>
                </div> 
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$product->titel}}</h3> 
            </div>
            <div class="card-body">
              <div class="row">
                 <div class="col-md-6">    
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">{{$product->beschrijving}}</li>
                   </ul>
                </div>
                <div class="col-md-6">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$product->duur}} min</li>
                    <li class="list-group-item">{{$product->max_aantal}} personen</li>
                      <li class="list-group-item">
                            @if ($product->status === 1)
                                <span class="badge badge-primary">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                      </li>
                      <li class="list-group-item"><a href="{{$product->id}}/download">{{$product->bijlage}}</a></li>
                      <li class="list-group-item">
                        @foreach($product->users as $user)
                            <span type="button" class="badge badge-pill badge-secondary">{{$user->name}}</span>
                            @endforeach
                      </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="{{$product->id}}/edit"><button type="submit" class="btn btn-outline-primary">Update</button></a>
              <a href="{{url('/products')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection