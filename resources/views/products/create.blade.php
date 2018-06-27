@extends('layouts.app')

@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-6">
    <div class="container-header">
                <h2>
                  <i class="fas fa-flask"></i>
                  Producten
                </h2>
              </div> 
    {!! Form::open(['action' => 'productController@store', 'method' => 'POST', 'enctype' => 'multipart/data', 'files' => true]) !!}
      <div class="card">
        <div class="card-header">
         <h3 class="card-title">
            Create product  
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                  {{Form::label('titel', 'Titel', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::text('titel', '', ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                  {{Form::label('beschrijving', 'Beschrijving', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::textarea('beschrijving', '', ['class' => 'form-control'])}}
                  </div>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                {{Form::label('duur', 'Duur', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::number('duur', '', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                {{Form::label('max_aantal', 'Max. aantal personen', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::number('max_aantal', '', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                {{Form::label('bijlage', 'Bijlage', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::file('bijlage', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-4 col-form-label text-md-right">Gids</label>
                  <div class="col-md-8">
                    <select name="user_id[]" id="user_id" class="form-control selectpicker" multiple data-actions-box="true">
                        @foreach($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-md-right">Status</label>
                <div class="col-md-8">
                  <label class="switch">
                    <input type="checkbox" name="status" id="status" value='1' checked>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
          </div>    
        </div>
        <div class="card-footer">
              <div class="button-group">
              {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
              <a href="{{url('/products')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
              </div>
        </div>
        {!! Form::close() !!}
    </div>
    </div>
    </div>
    </div>
@endsection