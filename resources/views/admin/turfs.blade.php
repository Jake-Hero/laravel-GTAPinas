@extends('layouts.navbar')
@section('pageTitle', "Characters")

@section('content')

@include('includes.admin')

<div class="container vh-100">
<!-- Container -->
    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->

    <h3>Turfs</h3>

    <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Type</th>
                    <th>Availability</th>
                </tr>
            </thead>

            <tbody>
                @if(!$turfs->isEmpty())
                    @foreach($turfs as $t)
                    @php
                        $type = getTurfType($t['turftype']); 
                        $availiability = ($t->turfavailability > 0) ? ($t->turfavailability . ' hour(s)') : ('Available for Capture');
                        $leader = fetchData('characters', 'charname', 'id', $g->leader);

                        $capturer = $t->turfcapturergroup; 
                        $capturer_type = $t->turfcapturertype; 
                        $owner = 'Neutral';

                        if($capturer_type > 0) {
                            $capturer = ($capturer_type == 1) ? (fetchData('factions', 'name', 'factionid', $capturer)) : ($obj->fetchData('gangs', 'name', 'id', $capturer));
                        }
                    @endphp

                    <tr>
                        <td>{{ $t->turfname }}</td>
                        <td>{{ $type }}</td>
                        <td>{{ $capturer }}</td>
                        <td>{{ $availiability }}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="4">No turfs created in the server yet.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Emulate Card Ends here -->
    </div>

<!-- Container Ends here -->
</div>
@endsection
