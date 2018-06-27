@extends('layouts.app')

@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-4">
    <div class="container-header">
       <h2>
          <i class="fas fa-user"></i> Users
        </h2>
              </div> 
      <div class="card">
        {!! Form::open(['action' => 'userController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="card-header">
          <h3 class="card-title">
             Create user
          </h3>
        </div>
        <div class="card-body">
              <div class="form-group row">
                {{Form::label('name', 'Naam', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::text('name', '', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                {{Form::label('email', 'Email', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::text('email', '', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-4 col-form-label text-md-right">Talen</label>
                  <div class="col-md-8">
                    <select name="language_id[]" id="language_id" class="form-control selectpicker" multiple data-actions-box="true">
                      <option value="0">nederlands</option>
                        @foreach($languages as $language)
                          <option value="{{$language->id}}">{{$language->taal}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              <div class="form-group row">
                {{Form::label('tel', 'Tel', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::text('tel', '', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                {{Form::label('avatar', 'Portret', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::file('avatar', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-4 col-form-label text-md-right">Rol</label>
                <div class="col-md-8">
                  <select name="role_id" id="role_id" class="form-control">
                    <option value=""></option>
                      @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-4 col-form-label text-md-right">
                    Status
                  </div>
                  <div class="col-md-8">
                    <label class="switch">
                      <input type="checkbox" name="status" id="status" value='1' checked>
                      <span class="slider round"></span>
                    </div>
                  </label>
              </div>
        </div>
              <div class="card-footer">
              {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
              <a href="{{url('/users')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
              </div>
         
        {!! Form::close() !!}
    </div>
   </div>
  </div>
</div>
@endsection