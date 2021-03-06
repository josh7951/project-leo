@extends('layouts.form')

@section('content')
<div class="container box is-lavender">
  <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
        <p class="box has-background-{{ $msg }} has-text-white" style="text-align: center;font-size: 20px;width: 80%;margin-left: auto;margin-right: auto;margin-bottom: 0.75em;padding: 0.75rem!important;">{{ Session::get('alert-' .$msg) }} </p>
      @endif
    @endforeach
  </div>
  <div class="columns">
    <div class="column is-four-fifths">
      <h2 class="title is-3">Registration</h2>
      <form method="POST" action="{{ route('register') }}">
      @csrf
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Name</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded has-icons-left">
                <input class="input form-control" onkeyup="validateFName()" id="firstname" name="firstname" type="text" placeholder="First Name" required>
                <span class="icon is-small is-left">
                  <i class="fas fa-user"></i>
                </span>
              </p>
            </div>
            <div class="field">
              <p class="control is-expanded has-icons-left">
                <input class="input form-control" onkeyup="validateLName()" id="lastname" name="lastname" type="text" required placeholder="Last Name">
                <span class="icon is-small is-left">
                  <i class="fas fa-user"></i>
                </span>
              </p>
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Username</label>
          </div>
          <div class="field-body">
            <div class="field">
            <p class="control is-expanded has-icons-left">
                <input class="input form-control @error('name') is-invalid @enderror" onkeyup="validateUName()" id="name" type="text" name="username" type="text" placeholder="leo123" value="{{ old('name') }}" required autocomplete="username">
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror                
                <span class="icon is-small is-left">
                  <i class="fas fa-user"></i>
                </span>
              </p>
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">E-Mail</label>
          </div>
          <div class="field-body">
            <div class="field">
            <p class="control is-expanded has-icons-left">
                <input class="input form-control @error('email') is-invalid @enderror" onkeyup="validateMail()" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="leo@mail.com">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror              
                <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
              </p>
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Birthday</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded has-icons-left">
                <input type="date" id="birthday" class="input form-control" name="birthday" required>
                <span class="icon is-small is-left">
                  <i class="fas fa-birthday-cake"></i>
                </span>
              </p>
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Password</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded has-icons-left">
                <input onkeyup="strengthMeter()" id="password" type="password" class="input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
                </span>
                <div class="indicator">
                  <span class="weak"></span>
                  <span class="medium"></span>
                  <span class="strong"></span>
                </div>
                <div class="indicator-text"></div>
									<span style="color:#D0D1CD;"><input type="checkbox" onclick="toggleVisibility()"> Show Password</span>
									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
              </p>
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Confirm Password</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded has-icons-left">
                <input onkeyup="samePassword()" id="password-confirm" type="password" class="input form-control" name="password_confirmation" required autocomplete="new-password">
                <span id="validate-status"></span>
                <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
                </span>
              </p>
            </div>
          </div>
        </div>
        
        <div class="field is-horizontal {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
          <div class="field-label is-normal">
            <label class="label"></label>
          </div>
          <div class="field-body">
            <div class="field">
             {!! app('captcha')->display() !!}
              @if ($errors->has('g-recaptcha-response'))
                <span class="help-block text-danger">
                  <strong>Passing reCaptcha is required! Please Try Again</strong>
                </span>
              @endif
            </div>
          </div>
        </div>

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label"></label>
          </div>
          <div class="field-body">
            <p class="control has-text-grey-light">
              <button id="submit-button" type="submit" class="button is-royal-blue">
                {{ __('Register') }}
              </button>
              <br>
              <span>Already registered? <a class="has-text-dark" href="/login">Sign in here</a></span>
            </p>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

<style>
form .indicator {
    height: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 10px 0;
    display: none;
}
form .indicator span{
    width: 100%;
    height: 100%;
    background: lightgrey;
    border-radius: 5px;
    position: relative;
}
form .indicator span.medium{
    margin: 0 3px;
}
form .indicator span:before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 5px;
}
form .indicator span.active.weak:before{
    background-color: #ff4757;
}
form .indicator span.active.medium:before{
    background-color: orange;
}
form .indicator span.active.strong:before{
    background-color: #23ad5c;
}
form .indicator-text{
    font-size: 14px;
    font-weight: 500;
    display: none;
    color:#D0D1CD;
}
form .indicator-text.weak{
    color: black;
}
form .indicator-text.medium{
    color: black;
}
form .indicator-text.strong{
    color: black;
}

.is-royal-blue{
    background-color: #265eaa!important;
    border-color:#265eaa!important;
    color: white!important;
}

.is-lavender{
    background-color: #a394de!important;
}

.is-yellow{
    background-color: #eeec66!important;
}

</style>