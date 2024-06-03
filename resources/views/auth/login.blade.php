@extends('layouts.app')
@section('pageTitle', 'Login')

@section('content')
<div class="container-fluid vh-100">
    <div class="row py-5 d-flex vh-100 justify-content-center align-items-center">
        <div class="col-lg-4 col-md-8 col-xs-12 float-none mx-auto">
            <div class="shadow-lg p-3 mb-5 bg-light rounded">
                <div class='alert alert-warning'>
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong class="mx-2">Notice!</strong> 

                    <strong>Please register to our game server in order to access our UCP.</strong> 
                </div>            

                <div class="card-header mb-5">
                    <h5 class="text-center">
                        <i class="fa fa-user"></i> Account Login
                    </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" aria-live="assertive">
                                <i class="fas fa-exclamation-circle"></i>
                                <strong class="mx-2">Error!</strong> 

                                <hr>

                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div id="ajax"></div>

                        @if (session('status'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i>
                                <strong class="mx-2">Success!</strong> 

                                <strong>{{ session('status') }}</strong>
                            </div>
                        @endif

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
                            <button type="submit" class="btn btn-dark w-100 text-white">
                                Login
                            </button>

                            <div class="text-center mt-3">
                                <a href="{{ route('passwords.request') }}">Forgot your password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
