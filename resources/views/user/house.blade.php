@extends('layouts.navbar')
@section('pageTitle')
    {{ $character->charname }}'s properties
@endsection

@section('content')

<div class="modal fade" id="inventoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Inventory for House ID: <span id="modalDataId"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="ajax"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container vh-100">
<!-- Container -->
    @include('includes.account')    

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <h1 class="text-center mb-4 mt-3">
            {{ $character->charname }}'s Houses
        </h1>
    <!-- Emulate Card Ends here -->
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="container mb-3">
        <!-- Initiate container -->
            
            @if(!$properties->isEmpty())
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Level</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Furnitures</th>
                                <th></th>
                            </tr>
                        </thead>

                        @foreach($properties as $house)
                            @php
                                $locked = ($house->locked) ? ("Locked") : ("Unlocked");
                            @endphp

                            <tr>
                                <td><i class="fas fa-home" style="font-size: 20px;"></i></td>
                                <td>{{ number_format($house->id) }}</td>
                                <td>{{ number_format($house->level) }}</td>
                                <td>${{ number_format($house->price) }}</td>
                                <td>{{ $locked }}</td>
                                <td>{{ $furnitures }}</td>
                                <td><a id="inventory" href="#" data-bs-toggle="modal" data-id="{{ $house->id }}" data-bs-target="#inventoryModal">Inventory</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>         
            @else
                <div class='alert alert-danger'>
                    <i class="fas fa-exclamation-circle"></i>
                    <strong class="mx-2">Notice!</strong> 
                    <hr>
                    <p>This character doesn't own any properties.</p>
                </div>  
            @endif

        <!-- Container ends here -->
        </div>
    <!-- Emulate Card Ends here -->
    </div>

<!-- Container Ends here -->
</div>

@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).on('click', '[data-bs-toggle="modal"]', function() {
        var id = $(this).data('id');

        $('#modalDataId').text(id);

        $.ajax(
        {
            type:"post",
            url: '{{ route('ajax.house_inventory') }}',
            data: { houseid: id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response)
            {
                $("#ajax").html(response.html);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //console.log(textStatus, errorThrown);
            }
        });
    });
</script>
@endsection