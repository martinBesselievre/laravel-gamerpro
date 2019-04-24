@extends('layouts.gamerhorizon')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <div class="col-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                          <label for="password" class="col-4 col-form-label text-md-right">{{ __('Password') }}</label>
                          <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                          </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">&nbsp;</div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                     {{ __('Remember Me') }}
                                </label>
                            </div>

                        </div>
                    </div> 
                    <div class="form-group row">
                        <div class="col-4">&nbsp;</div>
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            <a  href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>

                </form>
           </div>
 
        </div>
    <div>
</div>
@endsection
