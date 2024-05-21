@extends('layouts.app')
@section('pageTitle', 'Popular Vehicles')

@section('content')

<div class="container vh-100">
<!-- Container -->

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <h1 class="text-center mb-4 mt-3">Top 20 Popular Vehicles</h1>
    <!-- Emulate Card Ends here -->
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Rank</th>
                        <th></th>
                        <th>Model</th>
                        <th>Amount</th>
                    </tr>
                </thead>

                <tbody>
                    @empty($data)
                        <td colspan="4">There are no vehicles in the server.</td>
                    @else
                        @foreach($data as $d)
                        
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td><img src="{{ getVehicleImage($d->model) }}" alt="{{ $d->model }}" /></td>
                            <td class="align-middle">{{ $d->model }}</td>
                            <td class="align-middle">{{ $d->model_count }}</td>
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