@extends('layouts.app')
@section('pageTitle', "Login")

@section('content')
<div class="container-fluid">
    <div class="row py-5 d-flex justify-content-center align-items-center">
        <div class="col-lg-4 col-md-4 col-xs-12 float-none mx-auto">
            <div class="shadow-lg p-3 mb-5 bg-light rounded">
                <div class="card-header mb-5">
                    <h5 class="text-center">
                        <i class="fa fa-user"></i> Account Login
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div id="ajax"></div>

                        <div class="row mb-3">
                            <label for="login" class="col-md-4 col-form-label text-md-end">{{ __('Email or Username') }}</label>

                            <div class="col-md-6">
                                <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" placeholder="Email or Username" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" id="passForm" required autocomplete="current-password" />
                            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="py-3 mt-3">
                            <button type="submit" class="btn btn-info w-100 text-white">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
