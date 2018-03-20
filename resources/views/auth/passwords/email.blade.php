@extends('auth.layout')

@section('content')
<div class="ui text container">
  <div class="ui hidden divider"></div>
  <div class="ui header">{{ __('Reset Password') }}</div>
  <div class="ui segment">
    
    <div class="ui form">
      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif
    
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
    
        <div class="field">
          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
          <div class="col-md-6">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
    
            @if ($errors->has('email'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="field mb-0">
          <div class="col-md-6 offset-md-4">
            <button type="submit" class="ui red button">
              {{ __('Send Password Reset Link') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
