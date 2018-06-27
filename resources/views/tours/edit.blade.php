@extends('layouts.app')

@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-4">
    <div class="container-header">
                <h2><i class="fas fa-bullhorn"></i>
                  Rondleidingen
                </h2>
              </div> 
        {!! Form::open(['action' => ['tourController@update', $tour->id], 'method' => 'POST']) !!}
        <div class="card">   
            <div class="card-header">
               <h3 class="card-title">
                 Edit rondleiding
               </h3 >
            </div>
            <div class="card-body">
                  <div class="form-group row">
                    {{Form::label('datum', 'Datum', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                    <div class="col-md-8">
                      {{Form::date('datum', $tour->datum, ['class' => 'form-control'])}}
                    </div>
                  </div>
                  <div class="form-group row">
                    {{Form::label('tijdstip', 'Tijdstip', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                    <div class="col-md-8">
                      {{ Form::time('tijdstip', $tour->tijdstip, ['class' => 'form-control']) }}
                    </div>
                  </div>
                  <div class="form-group row">
                    {{Form::label('aantal_kinderen', '#kinderen', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                    <div class="col-md-8">
                      {{Form::number('aantal_kinderen', $tour->aantal_kinderen, ['class' => 'form-control'])}}
                    </div>
                  </div>
                  <div class="form-group row">
                    {{Form::label('aantal_volwassenen', '#volwassenen', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                    <div class="col-md-8">
                      {{Form::number('aantal_volwassenen', $tour->aantal_volwassenen, ['class' => 'form-control'])}}
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right">Gids</label>
                    <div class="col-md-8">
                      <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true" >
                        <option value="{{$tour->user->id}}" selected>{{$tour->user->name}}</option> 
                          @if (count($otherUsersThisDay)>0)
                          <optgroup label="Vandaag gids">
                            @foreach($otherUsersThisDay as $otherUserThisDay)
                               <option value="{{$otherUserThisDay->id}}">{{$otherUserThisDay->name}} ({{$otherUserThisDay->tours_count}} toegewezen)</option>
                            @endforeach
                          </optgroup>
                          @endif
                          @if (count($usersAvailable)>0)
                          <optgroup label="Ook beschikbaar">
                            @foreach($usersAvailable as $userAvailable)
                              <option value="{{$userAvailable->id}}">{{$userAvailable->name}} ({{$userAvailable->tours_count}} toegewezen)</option>
                            @endforeach
                          </optgroup>
                          @endif
                          @if (! is_null($tour->user))
                            <option value="">Geen gids</option>
                          @endif
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right">Groep</label>
                    <div class="col-md-8">
                      <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true">
                        <option value="{{$tour->group->id}}" selected>{{$tour->group->naam}}</option>
                          @foreach($groups as $group)
                            <option value="{{$group->id}}">{{$group->naam}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right">Product</label>
                    <div class="col-md-8">
                      <select name="product_id" id="product_id" class="form-control selectpicker">
                        <option value="{{$tour->product->id}}" selected>{{$tour->product->titel}}</option>
                          @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->titel}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right">Status</label>
                    <div class="col-md-8">
                      <select name="status" id="status" class="form-control selectpicker">
                        <option value="{{$tour->status}}" selected>
                          @if ($tour->status === 0)
                              Gepland
                          @elseif ($tour->status === 1)
                              Afgelopen
                          @else
                              Geannuleerd
                          @endif
                        </option>
                        @if ($tour->aantal_totaal > 0)
                          <option value="0">Gepland</option>
                          <option value="1">Afgelopen</option>
                          <option value="2" disabled>Geannuleerd</option>
                        @else
                          <option value="0">Gepland</option>
                          <option value="1" disabled>Afgelopen</option>
                          <option value="2">Geannuleerd</option>
                        @endif
                      </select>
                    </div>
                  </div>
          </div>
          <div class="card-footer">
            <div class="row justify-content">
              <div class="col-md-8 button-group">
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
                <a href="{{url('/tours')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
              </div>
              <div class="col-md-4 form-check">
                <input class="form-check-input" type="checkbox" value="1" id="sendEmail" name="sendEmail">
                <label class="form-check-label" for="defaultCheck1">
                  Stuur email
                </label>
              </div>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection