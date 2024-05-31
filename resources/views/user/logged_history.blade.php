@extends('layouts.navbar')
@section('pageTitle', 'Logged History')

@section('content')

<div class="container vh-100">
<!-- Container -->

    <div class="row mt-2 mb-5">
        <!-- Back to My Characters -->
        <div class="col">
            <a href="{{ route('user.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back to My Characters</a>
        </div>
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="container">
            <h1 class="text-center mb-4 mt-3">{{ $master_name }} - Logged History</h1>

            <p>Showing last 30 connections for this account.</p>
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead class="table-dark">
                        <th>IP Address</th>
                        <th>Logged In Date</th>
                    </thead>

                    <tbody>
                        @if(!empty($loggedins))
                            @foreach($loggedins as $log)
                                <td>{{ $log->ip }}</td>
                                <td>{{ $log->timestamp }}</td>
                            @endforeach
                        @else 
                            <td colspan="2">No logged history found.</td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    <!-- Emulate Card Ends here -->
    </div>
<!-- Container Ends here -->
</div>

@endsection