@extends('auth.layout')

@section('content')
<div class="ui hidden divider"></div>
<div class="ui text container">
  <div class="ui header">{{ __('Login') }}</div>
  
  <div class="ui segment">
    <form method="POST" class="ui form" action="{{ route('login') }}">
      @csrf
  
      <div class="field">
        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
  
        <div class="col-md-6">
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
  
          @if ($errors->has('email'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
      </div>
  
      <div class="field">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
  
        <div class="col-md-6">
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
  
          @if ($errors->has('password'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
      </div>
    
      <div class="field mb-0">
        <div class="col-md-8 offset-md-4">
          <button type="submit" class="ui red button">
            {{ __('Login') }}
          </button>
  
{{--           <a class="ui basic button" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
 --}}
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
