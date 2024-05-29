@extends('layouts.navbar')
@section('pageTitle', 'Settings')

@section('content')

<div class="container vh-100">
<!-- Container -->

    <div class="row mt-2 mb-5">
        <!-- Back to My Characters -->
        <div class="col">
            <a href="{{ route('user.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back to My Characters</a>
        </div>
    </div>


    <div class='alert alert-warning'>
        <strong>Settings in the user control panel will reflect into your in-game account.</strong> 
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="container">
            <h1 class="text-center mb-4 mt-3">Settings</h1>

            @if($isDemo)
                <div class='alert alert-danger'>
                    <strong>Settings feature is disabled on Demo Account.</strong> 
                </div>
            @endif

            @if(empty($email))
                <div class="alert alert-danger">
                    <strong>You have not set your email yet, Please set your email to verify your account.</strong>
                </div>
            @else 
                @if (!$verified)
                    <div class="alert alert-warning">
                        <strong>You need to verify your email address to access all settings.</strong>
                        <p>Please check your email for the verification link.</p>

                        @if (session('resent'))
                            <p class="mt-3">A new verification link has been sent to your email address.</p>
                        @else
                            <p class="mt-3">If you haven't received the email, you can <a href="{{ route('mail.resend') }}">resend verification email</a>.</p>
                        @endif
                    </div>
                @endif
            @endif

            <form method="POST" action="{{ route('user.settings.change') }}">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('email_verification'))
                    <div class="alert alert-success">
                        {{ session('email_verification') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-lg-5 col-md-5 col-xs-12 float-none mx-auto">
                    <div class="form-group">
                        <small style="font-size: 10px">Current Email: {{ $email }}</small><br/>
                        <label class="form-label">Email</label>
                        <input class="form-control" type="text" placeholder="Email" name="new_email" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input class="form-control" type="password" placeholder="Password" name="new_password" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input class="form-control" type="password" placeholder="Confirm New Password" name="new_password_confirmation" id="confirmpassForm" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input class="form-control" type="password" placeholder="Current Password" name="cur_password" />
                    </div>

                    <div class="py-3 mt-3">
                        <button type="submit" class="btn btn-info w-100 text-white">Save Settings</button>
                    </div>
                </div>
            </form>

        </div>
    <!-- Emulate Card Ends here -->
    </div>
<!-- Container Ends here -->
</div>

@endsection