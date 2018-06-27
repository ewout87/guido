@extends('layouts.app')

@section('content')  
        
    <div class="col-md-12">
      <div class="container-header">
        <h2>
          <i class="fas fa-user"></i>
          Gebruikers <a href="users/create"><button type="submit" class="btn btn-outline-success">Create</button></a></h2>
      </div>
       <div class="row">   
              @if(count($users)>0)
              @foreach($users as $user)
         <div class="col-md-4">
               <div class="card">
                 <div class="card-header text-center">
                   <h3 class="card-title">{{$user->name}}</h3>
                 </div>
              <div class="card-body">
                <img class="rounded-circle mx-auto d-block" src="public/storage/avatars/{{$user->avatar}}" alt="{{$user->avatar}}" width="140" height="140">
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
                                <span class="badge badge-primary">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                          </li>
                    <li class="list-group-item">{{$user->role->name}}</li>
                </ul>
              </div>
                  <div class="card-footer text-center">
                    <div class="btn-group">
                        {!! Form::open(['action' => ['userController@destroy', $user->id], 'method' => 'POST', 'class' => '']) !!}
                          {{Form::hidden('_method', 'DELETE')}}
                          {{Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm', 'data-toggle' => 'confirmation'])}}
                        {!! Form::close() !!}
                        <script>
                          $(function () {
                            $('[data-toggle="confirmation"]').confirmation({
                              btnOkLabel: "Ja",
                              btnCancelLabel: "Nee",
                              btnCancelClass: "btn btn-outline-primary",
                              content: "Ben je zeker dat je deze gebruiker wil verwijderen?",
                              title: "Opgepast!"
                            })
                          })
                        </script> 
                        <a href="users/{{$user->id}}"><button type="submit" class="btn btn-outline-warning btn-sm">View</button></a>
                        <a href="users/{{$user->id}}/edit"><button type="submit" class="btn btn-outline-primary btn-sm">Update</button></a>
                      </div>
                </div>
              </div>
          </div>
        @endforeach
        @else
          <p>Geen gebruikers gevonden</p>
        @endif
      </div>
      <div class="nav justify-content-center">  
        {{$users->links()}}
      </div>    
    </div>

  
          
@endsection