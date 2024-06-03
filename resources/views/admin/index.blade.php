@extends('layouts.app')
@section('pageTitle', "Admin Panel")

@section('content')

@include('includes.admin')

<div class="container vh-100">
<!-- Container -->

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class='alert alert-warning'>
            <i class="fas fa-exclamation-triangle"></i>
            <strong class="mx-2">Notice!</strong> 
            <hr>
            <p>Admin Panel's Dashboard is still under development.</p>
        </div>

        <div class='alert alert-primary'>
            <strong>Admin MOTD: {{ $config->ADMIN_MOTD }}</strong> 
        </div>

        <div>
            @php
            $date_recorded = date('F d, Y h:iA', $config->highestplayertimestamp);
            $properties = countRowsInTable('properties');
            $business = countRowsInTable('business');
            $vips = countRowsInTableGreaterThan('accounts', 'donator', 1);
            $staffs = countRowsInTableGreaterThan('characters', 'admin', 1);
            $vehicles = countRowsInTable('vehicles');
            $characters = countRowsInTable('characters');
            $bans = countRowsInTable('bans');
            $accounts = countRowsInTable('accounts');
            @endphp

            <p>The highest player recorded on the server was on <b>{{ $date_recorded }}</b> (<b>{{ $config->highestplayer }} players</b>)</p>
            <p>There are <b>{{ number_format($vehicles) }}</b> vehicles in the server.</p>
            <p>There are <b>{{ number_format($business) }}</b> businesses in the server.</p>
            <p>There are <b>{{ number_format($staffs) }}</b> total characters with admin privileges in the server.</p>
            <p>There are <b>{{ number_format($vips) }}</b> VIPs in the server.</p>
            <p>There are <b>{{ number_format($characters) }}</b> total of characters made in the server.</p>
        </div>

        <div class="row">
            <div class="col border-top border-end border-4 text-center">
                <div style="margin: 50px">
                    <span class="fas fa-gavel" style="font-size: 50px;"></span>
                    <h4>{{ number_format($bans) }}</h4>
                    <h3>Banned Players</h3>
                </div>
            </div>
            <div class="col border-top border-end border-4 text-center">
                <div style="margin: 50px">
                    <span class="fas fa-users" style="font-size: 50px; color: #FF0000;"></span>
                    <h4>{{ number_format($accounts) }}</h4>                        
                    <h3>Registered Users</h3>
                </div>
            </div>
            <div class="col border-top border-4 text-center">
                <div style="margin: 50px">
                    <span class="fas fa-home" style="font-size: 50px; color: #33AA33;"></span>
                    <h4>{{ number_format($properties) }}</h4>        
                    <h3>Properties</h3>
                </div>
            </div>
        </div>

    <!-- Emulate Card Ends here -->
    </div>

<!-- Container Ends here -->
</div>

@endsection