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
        <i class="fas fa-exclamation-triangle"></i>
        <strong class="mx-2">Notice!</strong> 
        <hr>
        <p><strong>Settings in the user control panel will reflect into your in-game account.</strong></p>
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="container">
            <h1 class="text-center mb-4 mt-3">Settings</h1>

            @if($isDemo)
                <div class='alert alert-danger'>
                    <i class="fas fa-exclamation-circle"></i>
                    <strong class="mx-2">Notice!</strong> 
                    <hr>
                    <p><strong>Settings feature is disabled on Demo Account.</strong></p>
                </div>
            @endif

            @if(empty($email))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong class="mx-2">Notice!</strong> 
                    <hr>
                    <p><strong>You have not set your email yet, Please set your email to verify your account.</strong></p>
                </div>
            @else 
                @if (!$verified)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong class="mx-2">Notice!</strong> 

                        <hr>

                        <strong>You need to verify your new email address in order to edit it.</strong>
                        <p>Please check your email for the verification link. (Check <strong>spam folder</strong>)</p>

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
                    <i class="fas fa-check-circle"></i>
                    <strong class="mx-2">Success!</strong> 
                    <hr>
                    <p><div class="alert alert-success">{{ session('success') }}</div></p>
                @endif

                @if (session('email_verification'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <strong class="mx-2">Success!</strong> 
                        <hr>
                        <p>{{ session('email_verification') }}</p>
                    </div>
                @endif
                
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

                <div class="col-lg-5 col-md-5 col-xs-12 float-none mx-auto">
                    <div class="form-group mt-3">
                        <small style="font-size: 10px">Current Email: {{ $email }}</small><br/>
                        <label class="form-label">Email</label>
                        <input class="form-control" type="text" placeholder="Email" name="new_email" 
                               @if(!empty($email) && !$verified) disabled @endif />
                    </div>

                    <div class="form-group mt-3">
                        <label for="cur_password" class="form-label">Current Password</label>
                        <input class="form-control" type="password" placeholder="Current Password" id="cur_password" name="cur_password" />
                    </div>

                    <div class="form-group mt-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input class="form-control" type="password" placeholder="Password" id="new_password" name="new_password" />
                    </div>

                    <div class="form-group mt-3">
                        <label for="confirmpassForm" class="form-label">Confirm New Password</label>
                        <input class="form-control" type="password" placeholder="Confirm New Password" name="new_password_confirmation" id="confirmpassForm" />
                    </div>

                    <div class="py-3 mt-3">
                        <button type="submit" class="btn btn-dark w-100 text-white">Save Settings</button>
                    </div>
                </div>
            </form>

        </div>
    <!-- Emulate Card Ends here -->
    </div>
<!-- Container Ends here -->
</div>

@endsection