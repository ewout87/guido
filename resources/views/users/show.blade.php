@extends('layouts.app')

@section('content')  
<div class="row justify-content-md-center">
<div class="col-md-4 ">
  <div class="container-header">
    <h2><i class="fas fa-user"></i>
          Gebruikers</h2>
              </div> 
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{$user->name}}</h3>
          </div>
          <div class="card-body">
            <img class="rounded-circle mx-auto d-block" src="/guido/public/storage/avatars/{{$user->avatar}}" alt="{{$user->avatar}}" width="140" height="140">
            <br>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$user->email}}</li>
                <li class="list-group-item">{{$user->tel}}</li>
                <li class="list-group-item">
                  @foreach($user->languages as $language)
                      <span type="button" class="badge badge-pill badge-secondary">{{$language->taal}}</span>
                  @endforeach
                </li>
                <li class="list-group-item">
                  @if ($user->status === 1)
                          <span class="badge badge-primary">Actief</span>
                  @else
                          <span class="badge badge-secondary">Inactief</span>
                  @endif
                </li>
                <li class="list-group-item">{{$user->role->name}}</li>
            </ul>   
            
          </div>
          <div class="card-footer">
            <a href="{{$user->id}}/edit"><button type="submit" class="btn btn-outline-primary">Update</button></a>
            <a href="{{url('/users')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection