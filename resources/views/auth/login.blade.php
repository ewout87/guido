@extends('welcome')

@section('content')
<div class="card">
  <div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="form-group-item">{{ __('E-Mail Address') }}</label>

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
        </div>
        <div class="form-group">
            <label for="password" class="form-group-item">{{ __('Password') }}</label>

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label">{{ __('Remember Me') }}</label>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">
              {{ __('Login') }}
          </button>
          <a class="btn btn-link" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
          </a>
        </div>
      </form>
  </div>
</div>
  
@endsection
