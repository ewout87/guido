@extends('layouts.app')

@section('content')

  <div class="col-md-12">
    <div class="container-header">
      <h2>
        <i class="fas fa-tachometer-alt"></i> Welkom, {{ Auth::user()->name }}
      </h2>
      <h2>
        <small>Wat wil je doen vandaag? {{$today}}</small>
      </h2>
    </div>
  </div>
      <div class="row">
          <div class="col-md-4">
             <div class="card">
                <div class="card-header">
                   <h3><i class="fas fa-chart-line"></i> Facts & figures {{ $nameLastMonth }}</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      @include('dashboard.cijfers')
                    </div>
                    <div class="col-md-8">
                      @include('dashboard.graph2')
                      @include('dashboard.graph3')
                    </div>
                  </div>     
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  
                </div>
              </div>
          </div>
          <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   <h3><i class="fas fa-camera"></i> Bezoekers</h3>
                </div>
                <div class="card-body">
                  @include('dashboard.graph1')
              </div>
            </div>
          </div>
          <div class="col-md-4">
            @include('posts.index')
          </div>
        </div>
       
@endsection

