@extends('layouts.navbar')
@section('pageTitle', 'Create Character')

@section('content')

<div class="container">
<!-- Container -->

    <div class="row mb-5">
        <!-- Back to My Characters -->
        <div class="col">
            <a href="{{ route('user.dashboard') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Back to My Characters</a>
        </div>

        <div class="col d-flex justify-content-end">
            <div class="row">
                <!-- Settings -->
                <div class="col">
                    <a href="{{ route('user.settings') }}" class="btn btn-dark"><i class="fas fa-cog"></i> Settings</a>
                </div>
            </div>
        </div>
    </div>

    <div class='alert alert-info'>
        <strong>Please <a href="https://www.open.mp/docs/scripting/resources/skins" target="_blank">click here</a> to check for original GTA-SA skin IDs.</strong> 
    </div>

    <div class='alert alert-danger'>
        <strong><a href="/skins.php" target="_blank">Click here</a> to check for custom skin IDs.</strong> 
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="container">
            <h1 class="text-center mb-4 mt-3">Create Character - Slot {{ $slot }}</h1>

            <form method="POST" action="{{ route('ajax.create_character', ['slot' => $slot]) }}">
                @csrf

                <div class="col-lg-8 col-md-8 col-xs-12 float-none mx-auto">
                    <div id="ajax"></div>

                    <div class="row d-flex justify-content-center">

                        <div class="col-lg-12 col-xl-12 col-md-12 col-xs-12 text-center">
                            <img src="{{ getSkinImage(0) }}" alt="Skin" name="skin_pic" height="300" style="filter: drop-shadow(1px 1px 4px);" />
                        </div>

                        <!-- Character's Info -->
                        <div class="col">
                            <input type="number" value="{{ $slot }}" id="slotForm" hidden />

                            <div class="form-group">
                                <label class="form-label">Character Name</label>
                                <input class="form-control" type="text" placeholder="Firstname_Lastname (e.g. John_Doe)" name="char_name" id="charnameForm" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Skin</label>
                                <input class="form-control" type="number" min="1" max="299" placeholder="skin id (select your gender first)" name="skin_id" id="skinForm" />
                            </div>

                            <div class="form-group">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender" id="genderForm">
                                    <option selected>Select your gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Birthday</label>
                                <input class="form-control" placeholder="Birthday" name="birth_day" id="bdayForm" data-toggle="datepicker">
                            </div>

                            <div class="py-3 mt-3">
                                <button type="submit" class="btn btn-info w-100 text-white" id="createBtn">
                                    Create Character
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    <!-- Emulate Card Ends here -->
    </div>
<!-- Container Ends here -->
</div>

@endsection

@section('scripts')

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- DatepickerJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet preload" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="text/javascript">
    $(document).ready(function() {
        var maleSkins = [1, 2, 3, 4, 5, 6, 7, 8, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 
        32, 33, 34, 35, 36, 37, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 57, 58, 59, 60, 61, 62, 
        66, 67, 68, 70, 71, 72, 73, 78, 79, 80, 81, 82, 83, 84, 86, 94, 95, 96, 97, 98, 99, 100, 101, 
        102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 
        121, 122, 123, 124, 125, 126, 127, 128, 129, 132, 133, 134, 135, 136, 137, 142, 143, 144, 146, 
        147, 149, 153, 154, 156, 158, 159, 160, 161, 162, 168, 170, 171, 173, 174, 175, 176, 177, 179, 
        180, 181, 182, 183, 184, 185, 186, 187, 188, 189, 200, 202, 206, 208, 209, 210, 212, 213, 220, 
        221, 222, 223, 227, 228, 229, 230, 234, 235, 236, 239, 240, 241, 242, 247, 248, 249, 250, 252, 
        253, 254, 255, 258, 259, 261, 262, 264, 269, 270, 271, 272, 273, 289, 299,
        20126, 20126, 20127, 20128, 20129, 20130, 20131, 20132, 20133, 20134, 20135, 20136];

        var femaleSkins = [9, 10, 11, 12, 13, 31, 38, 39, 40, 41, 53, 54, 55, 56, 63, 64, 65, 75, 76, 77, 85, 87, 88, 
        89, 90, 91, 92, 93, 129, 130, 131, 138, 139, 140, 141, 145, 148, 150, 151, 152, 157, 169, 
        172, 178, 190, 191, 192, 193, 194, 195, 196, 197, 198, 199, 201, 205, 207, 211, 214, 215, 
        216, 218, 219, 224, 225, 226, 231, 232, 233, 237, 238, 243, 244, 245, 246, 251, 256, 257, 
        263, 20123, 20124, 20125];

        $("#skinForm").prop('disabled', true);

        $("#genderForm").change(function(){
            var value = parseInt($(this).val());
            var picture = null;

            if(value == 1) {
                picture = "{{ asset('assets/pictures/skins/9.png') }}";
                $("#skinForm").prop('disabled', false);
            }
            else if(value == 2) {
                picture = "{{ asset('assets/pictures/skins/9.png') }}";
                $("#skinForm").prop('disabled', false);
            }
            else {
                picture = "{{ asset('assets/pictures/skins/0.png') }}";
                $("#skinForm").prop('disabled', true);
            }

            $("img[name=skin_pic]").attr("src", picture);
        });

        $("#skinForm").change(function(){
            var value = parseInt($(this).val());
            var gender = parseInt($("#genderForm").val());
            var isValid = -1;
            var picture = "{{ asset('assets/pictures/skins/0.png') }}";
            var baseUrl = "{{ asset('assets/pictures/skins/') }}";

            if(gender == 1) {
                isValid = $.inArray(value, maleSkins);

                if(isValid == -1) {
                    $("#skinForm").val(1);
                    value = $("#skinForm").val();
                }

                picture = baseUrl + "/" + value + ".png";
                $("img[name=skin_pic]").attr("src", picture);
            }

            if(gender == 2) {
                isValid = $.inArray(value, femaleSkins);

                if(isValid == -1) {
                    $("#skinForm").val(9);
                    value = $("#skinForm").val();
                }

                picture = baseUrl + "/" + value + ".png";
                $("img[name=skin_pic]").attr("src", picture);
            }
        });

        $('#createBtn').on('click', function(e) {
            e.preventDefault();

            var name = document.getElementById('charnameForm').value;
            var skin = document.getElementById('skinForm').value;
            var gender = document.getElementById('genderForm').value;
            var bday = document.getElementById('bdayForm').value;
            var slot = document.getElementById('slotForm').value;

            var dateParts = bday.split('/');
            var formattedDate = '';
            if(dateParts.length === 3) {
                var day = dateParts[1];
                var month = dateParts[0];
                var year = dateParts[2];
                formattedDate = day + '-' + month + '-' + year;
            }

            var dataString = {
                    slot: slot,
                    name: name,
                    gender: gender,
                    birthday: formattedDate,
                    skin: skin
                };

            $.ajax(
            {
                type:"post",
                url: '{{ route('ajax.create_character') }}',
                data: dataString,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response)
                {
                    Swal.fire({
                        title: "Created",
                        text: "Successfully created a new character.",
                        icon: "success"
                    }).then((result) => {
                        window.location.href = "{{ route('user.dashboard') }}";
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON;
                        $('#ajax').empty();
                        $.each(errors, function(key, value) {
                            // If the value is an array, join its elements into a string
                            if(Array.isArray(value)) {
                                value = value.join(' ');
                            }
                            $('#ajax').append('<div class="alert alert-danger">' + value + '</div>');
                        });
                    } else {
                        console.log("An error occurred:", xhr.statusText);
                    }
                }
            });
        });

        $('[data-toggle="datepicker"]').datepicker();
    });
</script>
@endsection