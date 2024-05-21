@extends('layouts.app')
@section('pageTitle', 'Used Skins')

@section('content')

<div class="container vh-100">
<!-- Container -->

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <h1 class="text-center mb-4 mt-3">Top 20 Used Skins</h1>
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
                        <td colspan="4">There are no user accounts registered in the server.</td>
                    @else
                        @foreach($data as $d)
                        
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td><img src="{{ getSkinImage($d->last_skin) }}" alt="{{ $d->last_skin }}" height="100" style="filter: drop-shadow(1px 1px 4px);" /></td>
                            <td class="align-middle">{{ $d->last_skin }}</td>
                            <td class="align-middle">{{ $d->skin_count }}</td>
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