@extends('layouts.app')
@section('pageTitle', "Download")

@section('content')

<div class="container">
<!-- Container -->
    <div class="shadow-lg p-3 mb-5 bg-light rounded">
    <!-- Emulate Card -->

    <h3 class="text-center">Download Links</h3>

    <div class="mb-5">
        <div class="d-flex flex-column align-items-center">
            <label class="py-2">GTA San Andreas</label>
            <a href="https://icedrive.net/s/yRRSDz19gCF2C2h1h11zbVwa6j4f" target="_blank" class="btn btn-dark">Click here (Icedrive)</a>
        </div>

        <div class="d-flex flex-column align-items-center">
            <label class="py-2">Open.MP (SA-MP)</label>
            <a href="https://github.com/openmultiplayer/launcher/releases/latest" target="_blank" class="btn btn-dark">Click here (Github)</a>
        </div>

        <div class="d-flex flex-column align-items-center">
            <label class="py-2">SA-MP Mobile APK (Alyn's)</label>
            <a href="https://alynsampmobile.pro/game/app-game-release.apk" target="_blank" class="btn btn-dark">Click here</a>
        </div>
    </div>

    <hr/>

    <h3 class="text-center">What is Open.MP?</h3>

    <div class="container">
        <p class="text-wrap">
            open.mp (Open Multiplayer, OMP) is a substitute multiplayer mod for San Andreas, initiated in response to the unfortunate increase in problems with updates and management of SA:MP. 
            The initial release is a drop-in replacement for the server only. Existing SA:MP clients are able to connect to this server. In the future, a new open.mp client will become available, 
            allowing more interesting updates to be released.
        </p> 
    </div>

    <hr/>

    <h3 class="text-center">How to download Open.MP?</h3>

    <div class="text-center mt-5">
        <img src="{{ asset('assets/pictures/screenshots/downloads/1.png') }}" class="img-fluid mb-5" alt="1">

        <p><strong>Step 1.</strong></p>
        <p>Head over to <a href="open.mp" target="_blank">open.mp</a></p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/2.png') }}" class="img-fluid mb-5 mt-5" alt="2">

        <p><strong>Step 2.</strong></p>
        <p>Click "<b>Download open.mp launcher</b>" button</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/3.png') }}" class="img-fluid mb-5 mt-5" alt="3">

        <p><strong>Step 3.</strong></p>
        <p>You'll be redirected to Github, scroll until you see the Assets section. Click "<b>omp-launcher-setup.exe</b>"</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/5.png') }}" class="img-fluid mb-5 mt-5" alt="5">

        <p><strong>Step 4. (Optional)</strong></p>
        <p>If this pops up in your screen, Simply click "<b>More info</b>" then click "<b>Run anyway</b>"</p>

        <p><strong>Step 5.</strong></p>
        <p>Once done downloading, head over to Download folder or to wherever you saved the launcher installer and open it.</p>
    
        <img src="{{ asset('assets/pictures/screenshots/downloads/6.png') }}" class="img-fluid mb-5 mt-5" alt="6">

        <p><strong>Step 6.</strong></p>
        <p>Upon launching the launcher installer, Click "<b>Next</b>" as shown in the picture.</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/7.png') }}" class="img-fluid mb-5 mt-5" alt="7">

        <p><strong>Step 7.</strong></p>
        <p>The installer will ask for your GTA San Andreas file destination. Locate the file by clicking "<b>Browse</b>" and click "<b>Next</b>" once you are done.</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/8.png') }}" class="img-fluid mb-5 mt-5" alt="8">

        <p><strong>Step 8.</strong></p>
        <p>You have the option to choose not to create a shortcut at "<b>Start Menu</b>", otherwise click "<b>Next</b>".</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/9.png') }}" class="img-fluid mb-5 mt-5" alt="9">

        <p><strong>Step 9.</strong></p>
        <p>Installation will proceed, once done just click "<b>Next</b>".</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/10.png') }}" class="img-fluid mb-5 mt-5" alt="10">

        <p><strong>Step 10.</strong></p>
        <p>Installation is finished. You'll be asked to create a shortcut and run the launcher. Click "<b>Finish</b>" once you are done.</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/11.png') }}" class="img-fluid mb-5 mt-5" alt="11">

        <p><strong>Step 11.</strong></p>
        <p>Run and launch "<b>Open.MP</b>" and click the "+" green button to add new server to your favorite list.</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/12.png') }}" class="img-fluid mb-5 mt-5" alt="12">

        <p><strong>Step 12.</strong></p>
        <p>You will be asked to input a server IP. Type "<b>server.renegadecommunity.xyz</b>".</p>

        <img src="{{ asset('assets/pictures/screenshots/downloads/13.png') }}" class="img-fluid mb-5 mt-5" alt="13">

        <p><strong>Step 13.</strong></p>
        <p>When connecting to the server, You'll be asked to set your username. Choose an appropriate username and select the <b>0.3.7-R4</b> or <b>0.3DL version. (Recommended!)</b></p>

        <p><strong>Step 14.</strong></p>
        <p>You are done. If you need assistance from creating a character, You may join our <a href="https://renegadecommunity.xyz/discord" target="_blank">Discord</a> for assistance.</p>

    </div>

    <!-- Emulate Card Ends here -->
    </div>
<!-- Container Ends here -->
</div>
@endsection