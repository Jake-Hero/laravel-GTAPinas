@extends('layouts.app')
@section('pageTitle', 'Register')

@section('content')
<div class="container vh-100">
    <div class="row py-5 d-flex justify-content-center align-items-center">
        <div class="col-lg-4 col-md-8 col-xs-12 float-none mx-auto">
            <div class="shadow-lg p-3 mb-5 bg-light rounded">
                <div class="card-header mb-5">
                    <h5 class="text-center">
                        <i class="fa fa-user"></i> Account Register
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Username') }}</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="py-3 mt-3">
                            <button type="submit" class="btn btn-dark w-100 text-white">
                                Register
                            </button>

                            <div class="text-center mt-3">
                                <a href="{{ route('user.login') }}">Already have account?</a> <br/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection