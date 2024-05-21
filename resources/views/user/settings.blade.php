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

            <form method="POST" action="{{ route('user.settings.change') }}">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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