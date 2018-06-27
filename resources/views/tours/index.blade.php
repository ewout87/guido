@extends('layouts.app')

@section('content')  
        
    <div class="col-md-12">
      <div class="container-header">
        <h2>
          <i class="fas fa-bullhorn"></i>
          Rondleidingen <a href="/guido/tours/create"><button type="submit" class="btn btn-outline-success ">Create</button></a>
        </h2>
      </div> 
       <div class="card">
         <div class="card-header">
           <h3 class="card-title">
             Overzicht
           </h3>
         </div>
        <div class="card-body">
          @if(Auth::user()->role_id!==2)
          <div class="row">
            <div class="col-md-9">
              <div class="form-inline">
                {!! Form::open(['action' => 'tourController@search', 'method' => 'GET']) !!}
                {!! Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'zoek...']) !!}
                {!! Form::submit('Zoek', ['class'=>'btn btn-outline-default']) !!}
                {!! Form::close() !!}
              </div>
            </div>
            <div class="col-md-3">
              <div class="btn-group">
                <div class="dropdown">
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dag</button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/guido/tours/filter/today/day">Vandaag</a>
                    <a class="dropdown-item" href="/guido/tours/filter/yesterday/day">Gisteren</a>
                    <a class="dropdown-item" href="/guido/tours/filter/tomorrow/day">Morgen</a>
                  </div>
                </div>
                <div class="dropdown">
                  <button type="button" class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Week</button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/guido/tours/filter/today/week">Deze week</a>
                    <a class="dropdown-item" href="/guido/tours/filter/subWeek/week">Vorige week</a>
                    <a class="dropdown-item" href="/guido/tours/filter/addWeek/week">Volgende week</a>
                  </div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Maand</button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/guido/tours/filter/today/month">Deze maand</a>
                    <a class="dropdown-item" href="/guido/tours/filter/subMonth/month">Vorige maand</a>
                    <a class="dropdown-item" href="/guido/tours/filter/addMonth/month">Volgende maand</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
        <br>
        <div>
          @include('tours.errors')
        </div>
        @if(count($tours)>0)
    <div class="table-responsive">
     <table class="table table-hover">
        <thead>
          <tr>
            <th>Datum <a href="/guido/tours/order/datum/desc"><i class="fas fa-sort"></a></i></th>
            <th>Start</th>
            <th>Einde</th>
            <th>Status <a href="/guido/tours/order/status/desc"><i class="fas fa-sort"></i></a></th>
            <th>#volwassenen</th>
            <th>#kinderen</th>
            <th>#totaal</th>
            <th>Gids <a href="/guido/tours/order/user_id/desc"><i class="fas fa-sort"></i></a></th> 
            <th>#gidsen beschikbaar</th>
            <th>Groep <a href="/guido/tours/order/group_id/desc"><i class="fas fa-sort"></i></a></th> 
            <th>Product <a href="/guido/tours/order/product_id/desc"><i class="fas fa-sort"></i></a></th> 
            <th>Acties</i></th> 
          </tr>
        <thead>

        <tbody>
          @foreach($tours as $tour)
          <tr>
            <td>{{$tour->datum}}</td>
            <?php 
              $tijdstip = strtotime($tour->tijdstip);
              $duur = ($tour->product->duur)*60;
              $einde = gmdate("H:i", $tijdstip + $duur);
              $start = gmdate("H:i", $tijdstip)
            ?>
            <td>{{$start}}</td>
            <td>{{$einde}}</td>
            <td>
              @if ($tour->status === 0)
                  Gepland
              @elseif ($tour->status === 1)
                  Afgelopen
              @else
                  Geannuleerd
              @endif
            </td>
            <td id="volwassenen">{{$tour->aantal_volwassenen}}</td>
            <td id="kinderen">{{$tour->aantal_kinderen}}</td>
            <td id="totaal">
              @if($tour->aantal_totaal > $tour->product->max_aantal)
                <a data-toggle="tooltip" data-placement="top" title="meer bezoekers dan maximaal toegelaten"><i class="fas fa-exclamation"></i> {{$tour->aantal_totaal}}</a>
              @else 
                {{$tour->aantal_totaal}}
              @endif
            </td>
            <td><a href="/guido/users/{{$tour->user_id}}">{{$tour->user->name}}</a> 
            <td><a href="/guido/agendas/{{$tour->agenda->id}}">{{count($tour->agenda->usersAvailable)}}</a></td></td>
            <td><a href="/guido/groups/{{$tour->group_id}}">{{$tour->group->naam}}</a></td>
            <td><a href="/guido/products/{{$tour->product_id}}">{{$tour->product->titel}}</a></td>
            <td>
              @if(Auth::user()->role_id!==2)
              <div class="btn-group">
               {!! Form::open(['action' => ['tourController@destroy', $tour->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                <button type="submit" class="btn btn-outline-danger btn-sm pull-left" data-toggle="confirmation"><i class="fas fa-trash-alt"></i></button>
               {!! Form::close() !!}
                <script>
                  $(function () {
                    $('[data-toggle="confirmation"]').confirmation({
                      btnOkLabel: "ja",
                      btnCancelLabel: "Nee",
                      btnCancelClass: "btn btn-outline-primary",
                      content: "Je staat op het punt om deze rondleiding te verwijderen. Ben je zeker?",
                      title: "Opgepast!"
                    })
                  })
                </script> 
                <a href="/guido/tours/{{$tour->id}}"><button type="submit" class="btn btn-outline-warning btn-sm pull-left"><i class="fas fa-eye"></i></button></a>
                <a href="/guido/tours/{{$tour->id}}/edit"><button type="submit" class="btn btn-outline-primary btn-sm pull-left"><i class="fas fa-edit"></i></button></a>
              </div>
              @endif
            </td>
          </tr>   
          @endforeach
        </tbody>
      </table>
      </div>
      @else
        <p>Geen rondleidingen gevonden</p>
      @endif

        </div>
         <div class="card-footer pagination justify-content-end">
            {{$tours->links()}}
         </div>
      </div>    
    </div>
          
@endsection