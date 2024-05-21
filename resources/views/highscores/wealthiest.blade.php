@extends('layouts.app')
@section('pageTitle', 'Wealthiest')

@section('content')

<div class="container vh-100">
<!-- Container -->

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <h1 class="text-center mb-4 mt-3">Top 20 Wealthiest Players</h1>
    <!-- Emulate Card Ends here -->
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Total Wealth</th>
                    </tr>
                </thead>

                <tbody>
                    @empty($data)
                        <td colspan="3">There are no user accounts registered in the server.</td>
                    @else
                        @foreach($data as $d)
                        
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->charname }}</td>
                            <td>${{ number_format($d->total_wealth) }}</td>
                        </tr>

                        @endforeach
                    @endempty
                </tbody>
            </table>
        </div>
    <!-- Emulate Card Ends here -->
    </div>

<!-- Container Ends here -->
</div>

@endsection