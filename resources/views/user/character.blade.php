@extends('layouts.navbar')
@section('pageTitle')
    {{ $character->charname }}
@endsection

@section('content')

<div class="container">
<!-- Container -->

    <div class="row mb-5">
        <!-- Back to My Characters -->
        <div class="col">
            <a href="{{ route('user.index') }}" class="btn btn-dark"><i class="fas fa-arrow-left"></i> My Characters</a>
        </div>

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

    @if($admin > 0)
        <div class='alert alert-success'>
            <i class="fas fa-check-circle"></i>
            <strong class="mx-2">Notice</strong> 
            <hr>
            <p><strong>This character has administrator privileges in-game.</strong> </p>
        </div>
    @endif

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <h1 class="text-center mb-4 mt-3">{{ $character->charname }}</h1>
    <!-- Emulate Card Ends here -->
    </div>

    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->
        <div class="container mb-3">
        <!-- Initiate container -->
            <div class="row d-flex justify-content-center">
            <!-- Initialize row -->

                <!-- Character's Skin -->
                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12 text-center">
                    <img src="{{ getSkinImage($character->last_skin) }}" alt="{{ $character->charname }}'s skin" height="300" style="filter: drop-shadow(1px 1px 4px);" />
                </div>

                <!-- Character's Info -->
                <div class="col">
                    <div class="row py-4">
                        <div class="col">
                            <b>ID:</b> {{ number_format($userid) }}<br/>
                            <b>Level:</b> {{ $character->level }}<br/>
                            <b>EXP Points:</b> {{ $character->exp }}<br/>
                            <b>Online Time:</b> {{ $character->hours }}<br/>
                            <b>Last Played:</b> {{ date('M d, Y h:iA', $character->last_login) }} 
                        </div>
                    </div>

                    <br/>

                    <div class="row">
                        <div class="col">
                            <b>Creation:</b> {{ date('M d, Y h:i:A', strtotime($character->creation)) }}<br/>
                            <b>Date of Birth:</b> {{ $character->birthday }} (<b>{{ calculateCharacterAge($character->birthday) }} years old</b>)<br/>
                            <b>Bank:</b> ${{ number_format($character->bank) }}<br/>
                            <b>Pocket Money:</b> ${{ number_format($character->cash) }}<br/>
                        </div>
                    </div>

                    <br />

                    <div class="row">
                        <div class="col">
                            <b>Phone:</b> {{ $number }}<br/>
                            <b>Battery:</b> {{ $battery }}<br/>
                            <b>Load Credit/s:</b> {{ $load_credits }}<br/>
                        </div>
                    </div>

                    <br />

                    <div class="row">
                        <div class="col">
                            @if(isset($faction))

                                <b>Faction:</b> {{ $faction }}<br/>
                                <b>Rank:</b> {{ $factionRankName }} ({{ $rank }})<br/>
                                
                            @elseif($gang)

                                <b>Gang:</b> {{ $gang }}<br/>
                                <b>Rank:</b> {{ $gangRankName }} ({{ $rank }})<br/>
                                
                            @else

                                <b>Faction:</b> None<br />
                                <b>Rank:</b> None (0)<br />

                            @endif
                        </div>
                    </div>
                </div>
            <!-- row ends here -->
            </div>

            <!-- Other Choices -->
            <div class="shadow-lg p-3 mt-5 mb-5 bg-light rounded">
                <div class="container mb-3">
                <!-- Initiate container -->
                    <div class="row d-flex justify-content-center">
                    <!-- Initialize row -->
                    
                        <!-- Houses -->
                        <div class="col-xs-12 col-md-4 col-lg-3 col-xl-3 text-center" href="#">
                            <a href="{{ route('user.house', ['id' => $character->id]) }}" style="text-decoration: none; color: inherit;">
                                <div>
                                    <i class="fas fa-home fa-10x" style="color: #33AA33"></i>
                                    <h1>Houses</h1>
                                </div>
                            </a>
                        </div>

                        <!-- Businesses -->
                        <div class="col-xs-12 col-md-4 col-lg-3 col-xl-3 text-center" href="#">
                            <a href="{{ route('user.business', ['id' => $character->id]) }}" style="text-decoration: none; color: inherit;">
                                <div>
                                    <i class="fas fa-building fa-10x"></i>
                                    <h1>Businesses</h1>
                                </div>
                            </a>
                        </div>

                        <!-- Vehicles -->
                        <div class="col-xs-12 col-md-4 col-lg-3 col-xl-3 text-center" href="#">
                            <a href="{{ route('user.vehicle', ['id' => $character->id]) }}" style="text-decoration: none; color: inherit;">
                                <div>
                                    <i class="fas fa-car fa-10x" style="color: #FF0000"></i>
                                    <h1>Vehicles</h1>
                                </div>
                            </a>
                        </div>

                    <!-- row ends here -->
                    </div>
                <!-- Container ends here -->
                </div>
            </div>

        <!-- Container ends here -->
        </div>
    <!-- Emulate Card Ends here -->
    </div>
</div>

@endsection