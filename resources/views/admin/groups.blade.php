@extends('layouts.navbar')
@section('pageTitle', "Characters")

@section('content')

@include('includes.admin')

<div class="container vh-100">
<!-- Container -->
    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->

    <h3>Gangs</h3>

    <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Strikes</th>
                    <th>Wealth</th>
                    <th>Members</th>
                    <th>Leader</th>
                </tr>
            </thead>

            <tbody>
                @if(!$gangs->isEmpty())
                    @foreach($gangs as $g)
                    @php
                        $members = countRowsInTableEx('characters', 'gang', $g->id);
                        $leader = fetchData('characters', 'charname', 'id', $g->leader);
                    @endphp

                    <tr>
                        <td>{{ $g->name }}</td>
                        <td>{{ $g->strike }}</td>
                        <td>${{ number_format($g->cash) }}</td>
                        <td>{{ $members }}</td>
                        <td>{{ $leader }}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="5">No gang created in the server yet.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <hr />

    <h3>Factions</h3>

    <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Average Salary</th>
                    <th>Members</th>
                    <th>Leader</th>
                </tr>
            </thead>

            <tbody>
                @if(!$factions->isEmpty())
                    @foreach($factions as $f)
                    @php 
                        $salary = [];
                        for($i = 0; $i < 15; $i++) {
                            $key = 'salary_' . $i;
                            $salary[] = $f->{$key};
                        }

                        $leader = fetchData('characters', 'charname', 'id', $f->leader);
                        $members = countRowsInTableEx('characters', 'faction', $f->factionid);
                        $avg = computeAverage($salary);
                    @endphp

                    <tr>
                        <td>{{ $f['name'] }}</td>
                        <td>${{ number_format($avg) }}</td>
                        <td>{{ $members }}</td>
                        <td>{{ $leader }}</td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="3">No faction created in the server yet.</td>
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
