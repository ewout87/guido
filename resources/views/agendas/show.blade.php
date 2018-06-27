@extends('layouts.app')

@section('content')  
<div class="row justify-content-md-center">
  <div class="col-md-3">
    <div class="container-header">
      <h2><i class="far fa-calendar-check"></i> Agenda</h2>
                </div> 
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">{{$agenda->datum}}</h2>  
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                  @if (count($agenda->usersAvailable)>0)
                  <li class="list-group-item">
                    @foreach($agenda->usersAvailable as $userAvailable)
                       <span type="button" class="badge badge-pill badge-secondary">{{$userAvailable->name}}</span>
                    @endforeach
                  </li>
                  @else
                  <li class="list-group-item">
                    <p>Geen gids</p>
                  </li>
                  @endif
              </ul>   
            </div>
            <div class="card-footer">
              <div id="agenda-item" class="btn-group">
                @if(Auth::user()->role_id===4)
                  {!! Form::open(['action' => ['agendaController@destroy', $agenda->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                      {{Form::hidden('_method', 'DELETE')}}
                      {{Form::submit('Delete', ['class' => 'btn btn-outline-danger', 'data-toggle' => 'confirmation'])}}
                  {!! Form::close() !!}
                  <script>
                          $(function () {
                            $('[data-toggle="confirmation"]').confirmation({
                              btnOkLabel: "Ja",
                              btnCancelLabel: "Nee",
                              btnCancelClass: "btn btn-outline-primary",
                              content: "Ben je zeker dat je deze agenda item wil verwijderen?",
                              title: "Opgepast!"
                            })
                          })
                  </script> 
                @endif
                <a href="{{$agenda->id}}/edit"><button type="submit" class="btn btn-outline-primary pull-left">Update</button></a>
                <a href="{{url('/agendas')}}"><button type="button" class="btn btn-outline-secondary pull-left">Cancel</button></a>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>
@endsection