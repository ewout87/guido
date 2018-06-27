@extends('layouts.app')

@section('content')  
<div class="row justify-content-md-center">
  <div class="col-md-4">
    <div class="container-header">
                  <h2><i class="fas fa-bullhorn"></i>
                    Rondleidingen </h2>
                </div> 
          <div class="card">
            <div class="card-body">
              <h2 class="card-title">{{$tour->datum}} : 
                <?php 
                    $tijdstip = strtotime($tour->tijdstip);
                    $duur = ($tour->product->duur)*60;
                    $einde = gmdate("H:i", $tijdstip + $duur);
                    $start = gmdate("H:i", $tijdstip);
                ?>
                <small>{{$start}} - {{$einde}}</small>
              </h2>     
              <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                  @if ($tour->status === 0)
                      Gepland
                  @elseif ($tour->status === 1)
                      Afgelopen
                  @else
                      Geannuleerd
                  @endif
                  </li>
                  <li class="list-group-item">{{$tour->aantal_volwassenen}} volwassenen</li>
                  <li class="list-group-item">{{$tour->aantal_kinderen}} kinderen</li>
                  <li class="list-group-item">{{$tour->aantal_totaal}} totaal</li>
                  <li class="list-group-item">{{$tour->user->name}}</li>
                  <li class="list-group-item">{{$tour->group->naam}}</li>
                  <li class="list-group-item">{{$tour->product->titel}}</li>
              </ul>
            </div>
            <div class="card-footer">
              <a href="{{$tour->id}}/edit"><button type="submit" class="btn btn-outline-primary">Update</button></a>
              <a href="{{url('/tours')}}"><button type="button" class="btn btn-outline-secondary">Cancel</button></a>
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection