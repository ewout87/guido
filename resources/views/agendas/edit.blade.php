@extends('layouts.app')

@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-3">
    <div class="container-header">
                <h2><i class="far fa-calendar-check"></i> Agenda
                </h2>
              </div> 
        <div class="card">
          {!! Form::open(['action' => ['agendaController@update', $agenda->id], 'method' => 'POST']) !!}
          <div class="card-header">
                <h3 class="card-title">Edit agenda item</h3>
            </div>
          <div class="card-body">
                  <div class="form-group row">
                    {{Form::label('datum', 'Datum', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                    <div class="col-md-8">
                      {{Form::date('datum', $agenda->datum, ['class' => 'form-control'])}}
                    </div>
                  </div>
                
                <div class="form-group row">
                  @if(Auth::user()->role_id===2)
                    <label class="col-md-4 col-form-label text-md-right">Beschikbaar</label>
                    <div class="col-md-8">
                      <label class="switch">
                          <input type="checkbox" name="user_id" id="user_id" value='{{Auth::user()->id}}' checked>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  @else
                  <label class="col-md-4 col-form-label text-md-right">Beschikbare gidsen</label>
                  <div class="col-md-8">
                    <select name="user_id[]" id="user_id" class="form-control selectpicker" multiple data-actions-box="true">
                      @foreach($users as $user)
                        <option value="{{$user->id}}" selected>{{$user->name}} </option>
                      @endforeach
                      @foreach($usersAvailable as $userAvailable)
                        <option value="{{$userAvailable->id}}">{{$userAvailable->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  @endif
                </div>
          </div>
          <div class="card-footer">
               <div class="button-group">
                  {{Form::hidden('_method', 'PUT')}}
                  {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
                   <a href="{{url('/agendas')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
                </div>
                
          </div>
    </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection