<nav class="navbar navbar-dark sticky-top bg-dark ">
  <a class="navbar-brand" href="{{ url('/') }}">
      GUIDO
  </a>
    <div>
      <!-- Right Side Of Navbar -->
      <ul class="nav mr-auto">
          <!-- Authentication Links -->
          @guest
              <li><a class="btn btn-outline-light" href="{{ route('login') }}">{{ __('Login') }}</a></li>
              <li><a class="btn btn-outline-light" href="{{ route('register') }}">{{ __('Register') }}</a></li>
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="btn btn-outline-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
      </ul>
    </div>
</nav>