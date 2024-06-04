@extends('layouts.app')
@section('pageTitle', 'Forgot Password')

@section('content')

<div class="container vh-10">
<!-- Container -->
    <div class="row py-5 d-flex justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-xs-12 float-none mx-auto">
            <div class="shadow-lg p-3 mb-5 bg-light rounded">
            <!-- Emulate Card -->

                <h1 class="text-center">Reset Password</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong class="mx-2">Error!</strong> 

                        <hr>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('passwords.update') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <input type="hidden" name="token" value="{{ $token }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Enter new password" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm new password" required>
                    </div>

                    <div class="py-3 mt-3 text-center">
                        <button class="btn btn-dark mx-auto" type="submit">Reset Password</button>
                    </div>
                </form>

            <!-- Emulate Card Ends here -->
            </div>
        </div>
    </div>
<!-- Container -->
</div>
@endsection
