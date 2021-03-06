@extends('layouts.app')



@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-4">
    <div class="container-header">
                <h2><i class="fas fa-users"></i> Edit Group
                </h2>
              </div> 
        {!! Form::open(['action' => ['groupController@update', $group->id], 'method' => 'POST']) !!}
        <div class="card">
          <div class="card-header">
           <h3 class="card-title">
              Edit group 
            </h3>
          </div>
          <div class="card-body">
                <div class="form-group row">
                  {{Form::label('naam', 'Naam', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::text('naam', $group->naam, ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                  {{Form::label('email', 'Email', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::email('email', $group->email, ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                  {{Form::label('tel', 'Tel', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::text('tel', $group->tel, ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right">Taal</label>
                    <div class="col-md-8">
                      <select name="language_id" id="language_id" class="form-control">
                        <option value="{{$group->language->id}}" selected>{{$group->language->taal}}</option> 
                            @foreach($languages as $language)
                                <option value="{{$language->id}}">{{$language->taal}}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>
                <div class="form-group row">
                  {{Form::label('postcode', 'Postcode', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::text('postcode', $group->postcode, ['class' => 'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                  {{Form::label('aantal', 'Aantal', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                  <div class="col-md-8">
                    {{Form::number('aantal', $group->aantal, ['class' => 'form-control'])}}
                  </div>
                </div>
          </div>
          <div class="card-footer">
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
                <a href="{{url('/groups')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
          </div>      
        </div> 
    {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection