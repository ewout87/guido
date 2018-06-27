@extends('layouts.app')

@section('content')
<div class="row justify-content-md-center">
  <div class="col-md-4">
    <div class="container-header">
                <h2><i class="fas fa-bullhorn"></i>
                  Rondleidingen</h2>
              </div> 
      <div class="card">
        <div class="card-header">
           <h3 class="card-title">
             Create rondleiding
           </h3 >
        </div>
        {!! Form::open(['action' => 'tourController@store', 'method' => 'POST']) !!}
        <div class="card-body">
              <div class="form-group row">
                {{Form::label('datum', 'Datum', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::date('datum', '', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                {{Form::label('tijdstip', 'Tijdstip', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::time('tijdstip', '', ['class' => 'form-control']) }}
                </div>
              </div>
              {{Form::hidden('tijdstip_einde', '')}}
              <div class="form-group row">
                {{Form::label('aantal_volwassenen', 'Aantal volwassenen', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::number('aantal_volwassenen', '', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                {{Form::label('aantal_kinderen', 'Aantal kinderen', ['class' => "col-sm-4 col-form-label text-md-right"])}}
                <div class="col-md-8">
                  {{Form::number('aantal_kinderen', '', ['class' => 'form-control'])}}
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-md-right">Groep</label>
                <div class="col-md-8">
                  <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true">
                    <option value="3">Geen groep</option>
                      @foreach($groups as $group)
                        <option value="{{$group->id}}">{{$group->naam}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label text-md-right">Product</label>
                <div class="col-md-8">
                  <select name="product_id" id="product_id" class="form-control selectpicker" data-live-search="true">
                    <option value="11" selected>Standaardrondleiding</option>
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
                    <option value="0" selected>Gepland</option>
                    <option value="1" disabled>Afgelopen</option>
                    <option value="2">Geannuleerd</option>
                  </select>
                </div>
              </div>
        </div>
        <div class="card-footer">
              <div class="button-group">
              {{Form::submit('submit', ['class' => 'btn btn-outline-primary'])}}
              <a href="{{url('/tours')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
              </div>
        </div>
      </div>  
      {!! Form::close() !!}
    
    </div>
  </div>
</div>
@endsection