@extends('layouts.app')
@section('pageTitle', "Skins")

@section('content')
<div class="container">
<!-- Container -->
    <div class='alert alert-info'>
        <strong>Please <a href="https://www.open.mp/docs/scripting/resources/skins" target="_blank">click here</a> to check for original GTA-SA skin IDs.</strong> 
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Skin ID</th>
                        <th>Model</th>
                    </tr>
                </thead>

                <tbody>
                    @for($i = 20123; $i <= 20136; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td><img src="{{ getSkinImage($i) }}" alt="{{ $i }}" name="skin_pic" height="300" style="filter: drop-shadow(1px 1px 4px);" /></td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    <!-- Emulate Card Ends here -->
    </div>
<!-- Container Ends here -->
</div>
@endsection