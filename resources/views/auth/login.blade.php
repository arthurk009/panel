@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row no-gutter">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image" style="background-image: url('{{ asset('img/login/bg4.jpg') }}')"></div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container login-sec">
              {{-- <div class="text-center">
              <img src="{{asset('img/login/avatar.png')}}" alt="Login" class="img-fluid rounded-circle" width="132" height="132">
                </div> --}}
                <h2 class="text-center">Iniciar Sesión</h2>
            <div class="row" id="form_login_cutom">
              <div class="col-md-9 col-lg-8 mx-auto">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                  <div class="form-label-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-label-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <label for="password">{{ __('Password') }}</label>


                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember"> {{ __('Remember Me') }}</label>
                  </div>
                  <button class="btn btn-lg btn-dark btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">{{ __('Login') }}</button>

                    {{-- @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="small" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>
                    </div>

                    @endif --}}

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
