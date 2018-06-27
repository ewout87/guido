@extends('layouts.app')

@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-3">
    <div class="container-header">
                <h2>
                  <i class="far fa-calendar-check"></i>
                  Agenda 
                </h2>
        </div>
      <div class="card">
        <div class="card-header">
           <h3 class="card-title">
             Create agenda item
           </h3>
        </div>
        {!! Form::open(['action' => 'agendaController@store', 'method' => 'POST']) !!}
        <div class="card-body">
              <div class="form-group row">
                {{Form::label('datum', 'Datum', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::date('datum', '', ['class' => 'form-control'])}}
                </div>
              </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label text-md-right">Beschikbare gidsen</label>
              <div class="col-md-8">
                <select name="user_id[]" id="user_id" class="form-control selectpicker" multiple data-actions-box="true">
                      @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                  </select> 
              </div>
            </div>
        </div>
        <div class="card-footer">
         {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
              <a href="{{url('/agendas')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
              </div>
        </div>
        {!! Form::close() !!}
    </div>
    </div>
    </div>
    </div>
@endsection