@extends('layouts.navbar')
@section('pageTitle', "My Characters")

@section('content')

<div class="container">
<!-- Container -->
    <div class="mt-2 d-flex justify-content-end mb-5">
        <div class="col d-flex justify-content-end align-items-center">
            <!-- Settings -->
            <div class="btn-group btn-group-sm mr-2" role="group">
                <a href="{{ route('user.settings') }}" class="btn btn-dark"><span class="fas fa-cog"></span> Settings</a>
            </div>     
            <!-- Logged History -->
            <div class="btn-group btn-group-sm ml-2" role="group">
                <a href="{{ route('user.logged_history') }}" class="btn btn-dark"><span class="fas fa-shield-alt"></span> Logged History</a>
            </div>   
        </div>
    </div>

    @if(session('login_success'))
        <div class="alert alert-success">
            {{ session('login_success') }}
        </div>
    @endif

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <h1 class="text-center border-bottom mb-4 mt-3">My Characters</h1>

        <div class="row d-flex justify-content-center">
            @for ($i = 1; $i <= 3; $i++)
                @php
                    $character_exists = false;
                @endphp
        
                @foreach ($c as $character)
                    @if ($character->slot == $i)
                        @php
                            $character_exists = true;
                        @endphp
        
                        <div class="col-xs-3 col-sm-2 col-md-3 col-lg-3 text-center">
                            <div class="shadow-lg p-3 mb-5 bg-body rounded">
                                <!-- Make it clickable to user/character.php?id=['id'] -->
                                <a href="{{ route('user.character', ['id' => $character->id]) }}" style="text-decoration: none; color: inherit;">
                                    <div class="card-body bg-white">
                                        <img src="{{ getSkinImage($character->last_skin) }}" alt="{{ $character->charname }}'s skin" height="300" style="filter: drop-shadow(1px 1px 4px);" />
                                        <h4 class="mt-5">{{ $character->charname }}</h4>
                                        <p>
                                            <b>Online Time:</b> {{ $character->hours }}
                                            <p class="text-muted">ID: {{ $character->id }}</p>
                                        </p>
                                    </div>
                                </a>
                                <!-- End of Clickable -->
                            </div>
                        </div>
                        @break
                    @endif
                @endforeach
        
                <!-- Display "Create" card for empty slots -->
                @if (!$character_exists)
                    <div class="col-xs-3 col-sm-2 col-md-3 col-lg-3 text-center">
                        <div class="shadow-lg p-3 mb-5 bg-body rounded">
                            @if ($verified == "Verified")
                                @if ($i == 3)
                                    @if ($vip >= 3)
                                        <a href="{{ route('user.create_character', ['slot' => $i]) }}" style="text-decoration: none; color: inherit;">
                                            <div class="card-body bg-white" style="height: 82%;">
                                                <img src="{{ asset('assets/pictures/skins/undefined.png') }}" alt="Create Character" height="340" />
                                                <h4>Create Character</h4>
                                                <p><b>Slot {{ $i }}</b></p>
                                            </div>
                                        </a>
                                    @else
                                        <a href="#" style="text-decoration: none; color: inherit;">
                                            <div class="card-body bg-white">
                                                <img src="{{ asset('assets/pictures/lock.png') }}" alt="Create Character" height="310" />
                                                <h4>Create Character</h4>
                                                <h5 class="text-danger">for Gold VIP+ only</h5>
                                                <p><b>Slot {{ $i }}</b></p>
                                            </div>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('user.create_character', ['slot' => $i]) }}" style="text-decoration: none; color: inherit;">
                                        <div class="card-body bg-white" style="height: 82%;">
                                            <img src="{{ asset('assets/pictures/skins/undefined.png') }}" alt="Create Character" height="340" />
                                            <h4>Create Character</h4>
                                            <p><b>Slot {{ $i }}</b></p>
                                        </div>
                                    </a>
                                @endif
                            @else
                                <a href="#" style="text-decoration: none; color: inherit;">
                                    <div class="card-body bg-white">
                                        <img src="{{ asset('assets/pictures/lock.png') }}" alt="Create Character" height="310" />
                                        <h4>Create Character</h4>
                                        <h5 class="text-danger">Verify your account first</h5>
                                        <p><b>Slot {{ $i }}</b></p>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            @endfor
        </div>
    <!-- Emulate Card Ends here -->
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <h1 class="text-center border-bottom mb-4 mt-3">Account Information</h1>

        <div class="container">
            <table class="table text-center">
                <tr>
                    <td><b>Master Account Name</b></td>
                    <td>{{ $username }}</td>
                </tr>

                <tr>
                    <td><b>Registration Date</b></td>
                    <td>{{ date('F d, Y h:iA', $registerdate) }}</td>
                </tr>

                <tr>
                    <td><b>Total Hours Online</b></td>
                    <td>{{ $totalhours }}</td>
                </tr>

                <tr>
                    <td><b>Email</b></td>
                    <td>{{ $email }} ({{ $verified  }})</td>
                </tr>

                <tr>
                    <td><b>Donator Status</b></td>
                    <td>{{ $donatorrank }} {{ $vip_expiration }}</td>
                </tr>
            </table>
        </div>
    <!-- Emulate Card Ends here -->
    </div>
<!-- Container Ends here -->
</div>

@endsection
