@extends('layouts.navbar')
@section('pageTitle', 'Expired Link')

@section('content')

<div class="container vh-100">
<!-- Container -->

    <div class="row mt-2 mb-5">
        <div class="col">
            <a href="/index.php" class="btn btn-dark"><i class="fas fa-arrow-left"></i> Go Back</a>
        </div>
    </div>

    <div class='alert alert-danger'>
        <i class="fas fa-exclamation-circle"></i>
        <strong class="mx-2">Error!</strong> 

        <strong>{{ $message }}</strong> 
    </div>
</div>

@endsection