<nav class="sidenav">
    <a id="dashboard" class="nav-link" href="{{url('/dashboard')}}" style="text-align:left;">
          Dashboard<i style="float:right;" class="fas fa-tachometer-alt"></i>
          </a>
      @if(Auth::user()->role_id!==3)
          <a id="producten" class="nav-link" href="{{url('/products')}}">
          Producten <i style="float:right;" class="fas fa-flask"></i>
          </a>
      @endif
      @if(Auth::user()->role_id===4)
          <a id="gebruikers" class="nav-link" href="{{url('/users')}}">
          Gebruikers <i style="float:right;" class="fas fa-user"></i>
          </a>
      </li>
      @endif
          <a id="rondleidingen" class="nav-link" href="{{url('/tours')}}">
          Rondleidingen <i style="float:right;" class="fas fa-bullhorn"></i>
          </a>
      @if(Auth::user()->role_id!==2)
          <a id="groepen" class="nav-link" href="{{url('/groups')}}">
          Groepen <i style="float:right;" class="fas fa-users"></i>
          </a>
      @endif
      @if(Auth::user()->role_id!==3)
          <a id="agenda" class="nav-link" href="{{url('/agendas')}}">
          Agenda <i style="float:right;" class="far fa-calendar-check"></i>
          </a>
      @endif
</nav>



