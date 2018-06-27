@extends('layouts.app')



@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-4">
    <div class="container-header">
                <h2><i class="fas fa-user"></i> Users
                </h2>
              </div> 
        <div class="card">
          {!! Form::open(['action' => ['userController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
          <div class="card-header">
            <h3 class="card-title">Edit user</h3>
          </div>
          <div class="card-body">
                 <div class="form-group row">
                  {{Form::label('name', 'Naam', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                   <div class="col-md-8">
                    {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                   </div>
                </div>
                <div class="form-group row">
                  {{Form::label('email', 'Email', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::text('email', $user->email, ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                  {{Form::label('tel', 'Tel', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::text('tel', $user->tel, ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label text-md-right">Talen</label>
                  <div class="col-md-8">
                    <select name="language_id[]" id="language_id" class="form-control selectpicker" multiple data-actions-box="true">
                      @foreach($user->languages as $language)
                        <option value="{{$language->id}}" selected>{{$language->taal}} </option>
                      @endforeach
                      @foreach($languages as $language)
                        <option value="{{$language->id}}">{{$language->taal}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  {{Form::label('avatar', 'Portret', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::file('avatar', ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label text-md-right">Rol</label>
                  <div class="col-md-8">
                    <select name="role_id" id="role_id" class="form-control">
                      <option value="{{$user->role->id}}">{{$user->role->name}}</option>
                        @foreach($roles as $role)
                          <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  
                  @if ($user->status === 1)
                  <div class="col-sm-4 col-form-label text-md-right">
                    Status
                  </div>
                  <div class="col-md-8">
                    <label class="switch">
                      <input type="checkbox" name="status" id="status" value='1' checked>
                      <span class="slider round"></span>
                    </label>
                  </div>
                  @else
                  <div class="col-sm-4 col-form-label text-md-right">
                    Status
                  </div>
                  <div class="col-md-8">
                    <label class="switch">
                      <input type="checkbox" name="status" id="status" value='1'>
                      <span class="slider round"></span>
                    </label>
                  </div>
                  @endif
                </div>
          </div>
          <div class="card-footer">
                <div class="button-group">
                   {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
                <a href="{{url('/users')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
                </div>
          </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection