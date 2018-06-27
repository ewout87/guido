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
    {!! Form::open(['action' => ['productController@update', $product->id], 'method' => 'POST', 'enctype' => 'multipart/data', 'files' => true]) !!}
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit product</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                    {{Form::label('titel', 'Titel', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::text('titel', $product->titel, ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                    {{Form::label('beschrijving', 'Beschrijving', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::textarea('beschrijving', $product->beschrijving, ['class' => 'form-control'])}}
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                    {{Form::label('duur', 'Duur', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::number('duur', $product->duur, ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                    {{Form::label('max_aantal', 'Max. #deelnemers', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::number('max_aantal', $product->max_aantal, ['class' => 'form-control'])}}
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
                        @foreach($product->users as $user)
                        <option value="{{$user->id}}" selected>{{$user->name}}</option>
                        @endforeach 
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label text-md-right">Status</label>
                  <div class="col-md-8">
                    @if ($product->status === 1)
                      <label class="switch">
                        <input type="checkbox" name="status" id="status" value='1' checked>
                        <span class="slider round"></span>
                      </label>
                    @else
                      <label class="switch">
                        <input type="checkbox" name="status" id="status" value='1'>
                        <span class="slider round"></span>
                      </label>
                    @endif
                  </div>
                </div>
              </div>  
            </div>
          </div>
            <div class="card-footer">
                <div class="button-group">
                   {{Form::hidden('_method', 'PUT')}}
                   {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
                   <a href="{{url('/products')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
                </div>
          </div>
          {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection