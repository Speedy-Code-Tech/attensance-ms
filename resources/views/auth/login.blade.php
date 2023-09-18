@extends('layouts.auth', ['title' => 'Login'])

@section('content')
<div class="">
    <div class="">
        <div class="col-md-4 ml-auto mr-auto m-top-50">
            <img src="{{ asset('images/rotary_logo.png') }}" class="w-full my-3 center" style="width:30%;" alt="Rotary Club of Tanauan Logo">
            
            <div class="card">
                <div class="card-header text-center c-theme-bg">
                    <div class="card-title text-white" style="font-size:17px;">Rotary Club of Tanauan
                        Attendance System</div>
                    <small id="emailHelp2" class="form-text  text-white">Login Account</small>
                </div>
                
                <div class="card-body pb-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            {{-- <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label> --}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa fa-user"></i></span>
                                </div>
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username"
                                    aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa fa-key"></i></span>
                                        </div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password"
                                        aria-label="Password" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                        
                        <button type="submit" class="btn btn-info btn-round btn-border float-right my-3 c-theme-border">
                            <i class="fa fa-check"></i> LOGIN
                        </button>

                        {{-- <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@error('username')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
@endsection
