@extends('layouts.app')
@section('pageTitle', "Index")

@section('content')
<div class="container-fluid">
    <div class="row d-flex vh-100 justify-content-center align-items-center">
                
        <div class="col-lg-4 col-md-8 col-xs-12">
            <center>
                <h1 style="font-size: 60px; color: white;">
                    Renegade Community
                </h1>
            </center>
            <center><h5 style="font-size: 24px; color: white;">Begin your journey with us</h5></center>
        
            <center>
                <a href="http://renegadecommunity.xyz/discord" class="btn border text-white" style="width: 100%;">Join Now!</a>

                <div class="mt-5">
                    <p class="text-white" style="font-size: 18px;">IP Address: {{ $ip }}</p>
                    <p class="text-white" style="font-size: 18px;">Players Online: {{ $players }}/{{ $maxPlayers }}</p>
                    <p class="text-white" style="font-size: 18px;">Statistics Updated: {{ $minutes }} minute/s and {{ $seconds }} second/s ago</p>
                </div>
            </center>


        </div>
        
    </div>

</div>
@endsection