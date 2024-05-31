@extends('layouts.app')
@section('pageTitle', 'Forgot Password')

@section('content')

<div class="container vh-100">
<!-- Container -->
    <div class="row py-5 d-flex vh-100 justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 float-none mx-auto">
            <div class="shadow-lg p-3 mb-5 bg-light rounded">
            <!-- Emulate Card -->

                <h1 class="text-center">Forgot Password</h1>

                @if (session('status'))
                <div class="alert alert-warning">
                    <strong>{{ session('status') }}</strong>
                </div>
                @endif

                @if ($errors->has('email'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
                @endif

                <form action="{{ route('passwords.email') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="py-3 mt-3 text-center">
                        <button class="btn btn-dark mx-auto" type="submit">Send Password Reset Link</button>
                    </div>
                </form>

            <!-- Emulate Card Ends here -->
            </div>
        </div>
    </div>
<!-- Container -->
</div>
@endsection
