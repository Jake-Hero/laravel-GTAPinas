@extends('layouts.navbar')
@section('pageTitle', "Characters")

@section('content')

@include('includes.admin')

<div class="container vh-100">
<!-- Container -->

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->

        <div class="table-responsive">
            <table id="usersTable" class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center"># ID</th>
                        <th class="text-center">Character Name</th>
                        <th class="text-center">Owner</th>
                    </tr>
                </thead>
            </table>
        </div>

    <!-- Emulate Card Ends here -->
    </div>

<!-- Container Ends here -->
</div>

@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" as="preload" type="text/css" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js" charset="utf8" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        var url = "{{ url('/') }}"; // Use Laravel's URL helper

        $('#usersTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('ajax.fetch_characters') }}",
                "type": "GET"
            },
            "columns": [
                {data: 'id'},
                {
                    data: 'charname',
                    render: function (data, type, row, meta) {
                        return '<a href="' + url + '/admin/character/' + row.id + '">' + row.charname + '</a>';
                    }
                },
                {data: 'owner_name'}
            ]
        });
    });
</script>
@endsection