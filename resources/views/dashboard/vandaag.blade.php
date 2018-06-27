<div class="card">
  <div class="card-header">
    <h3><i class="far fa-newspaper"></i> Vandaag {{$today}}</h3>
  </div>
  <div class="card-body">
    <ul class="list-group list-group-flush">
      
      <li class="list-group-item ">
          <strong>
            Gidsen toegewezen
          </strong>
          <br>
            @if (count($usersAssignedToday)>0)
            <div class="row text-center">
              @foreach ($usersAssignedToday as $userAssignedToday)
                <div class="col-md-4">
                <img class="img-thumbnail rounded-circle mx-auto d-block" src="storage/app/public/avatars/{{$userAssignedToday->avatar}}" alt="{{$userAssignedToday->avatar}}" width="140" height="140">
                {{$userAssignedToday ->name}}
              </div>
              @endforeach
            </div>
            @else
            <p>Geen gidsen</p>
             @endif
        </li>
      
        <li class="list-group-item ">
          <strong>
            Gidsen beschikbaar
          </strong>
          <br>
          @if (count($usersAvailableToday)>0)
          <div class="row text-center">
          @foreach ($usersAvailableToday as $userAvailableToday)
            <div class="col-md-4">
              <img class="img-thumbnail rounded-circle mx-auto d-block" src="storage/app/public/avatars/{{$userAvailableToday->avatar}}" alt="{{$userAvailableToday->avatar}}" width="140" height="140">
              {{$userAvailableToday ->name}}
            </div>
          @endforeach
        </div>
        @else
          <p>Geen gidsen</p>
        @endif
      </li>
   
   
        <li class="list-group-item ">
          <strong>
            Rondleidingen
          </strong>
          <br>
          @if (count($toursToday)>0)
          @foreach ($toursToday as $tourToday)
            <p>
            {{$tourToday->product->titel}} 
            @if ($tourToday->status === 0)
                gepland
            @elseif ($tourToday->status === 1)
                afgelopen
            @else
                geannuleerd
            @endif 
            om {{$tourToday->tijdstip}}
            </p>
          @endforeach
          @else
            <p>Geen rondleidingen</p>
          @endif
      </li>
    
    </ul>
  </div>
</div>   