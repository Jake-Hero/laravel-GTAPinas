@extends('layouts.app')
@section('pageTitle', "About")

@section('content')
<div class="container">

    <div class="row d-flex justify-content-center align-items-center">
                
        <div class="shadow-lg p-3 mb-5 bg-light rounded">
            <div class="container">
                <h3>What is <b class="text-danger">Project Renegade?</b>?</h3>

<p>
<center>
<img src="{{ asset('assets/pictures/screenshots/miners.jpg') }}" alt="playermining" class="img-fluid mb-5" />
</center>

A roleplay server established in 2020, Formerly known as <b>GTA Pinas</b>, founded by <b>Cipher</b>, <b>Dizeuce</b> and <b>aezakmi</b>.

Set in the map of fictional state San Andreas, Project Renegade is a game server for San Andreas Multiplayer (SA-MP), a third-party modification 
for Grand Theft Auto: San Andreas, offering a fun roleplaying experience for everyone.

<center>
<img src="{{ asset('assets/pictures/screenshots/playerbase.png') }}" alt="playercount" class="img-fluid mt-5 mb-5" />
</center>

With more than 2,600 registered accounts when it was still named 'GTA Pinas' and a daily player count of over 100 when it was still active.

The first server script used was developed by <b>Cipher</b> and <b>aezakmi</b>.

<b>GTA Pinas Roleplay</b> became a branch of Renegade Community and later renamed into <b>Project Renegade</b>, after it was founded in August 2023.
</p>

            </div>
        </div>
        
    </div>

</div>
@endsection