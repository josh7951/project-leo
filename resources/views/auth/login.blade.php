@extends('layouts.form')

@section('content')
<div class="columns">
  <div class="column is-three-fifths is-offset-one-fifth box is-lavender">
    <h1 class="title is-3">Login</h1>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="field">
        <p class="control has-icons-left">
          <input id="email" class="input form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          @error('email')
            <span class="box has-background-danger" style="padding:0.75rem!important;" role="alert">
              <strong class="has-text-white">{{ $message }}</strong>
            </span>
          @enderror
          <span class="icon is-small is-left">
            <i class="fas fa-envelope"></i>
          </span>
        </p>
      </div>
      <div class="field">
        <p class="control has-icons-left">
          <input id="password" class="input form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required autocomplete="current-password">
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong class="has-text-danger">{{ $message }}</strong>
            </span>
          @enderror
          <span class="icon is-small is-left">
            <i class="fas fa-lock"></i>
          </span>
          @if (Route::has('password.request'))
            <a class="btn btn-link has-text-dark" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
            </a>
          @endif
        </p>
      </div>
      <div class="field">
        <p class="control has-text-grey-light">
          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

          <label for="remember">
            {{ __('Remember Me') }}
          </label>
        </p>
      <div class="field">
        <p class="control has-text-grey-light">
          <button type="submit" class="button is-royal-blue">
            {{ __('Login') }}
          </button>
          <br>
          <span>New User? <a class="has-text-dark" href="/register">Sign up here</a></span>
        </p>
      </div>
    </form>
  </div>
</div>
@endsection

<style>
  .is-royal-blue{
      background-color: #265eaa!important;
      border-color:#265eaa!important;
      color: white!important;
  }
  .is-lavender{
      background-color: #a394de!important;
  }

  .input{
    margin-bottom:0.75rem;
  }
</style>