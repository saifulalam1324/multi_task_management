@extends('SERVICEPROVIDER.serviceprovider')
@section('title', 'SERVICEPROVIDER Home')
@section('content')
    <div class="container mt-5">
        <h3 class="text-center">Service Provider</h3>
    </div>
    <div class="container mt-5 d-flex">
        <div class="col-md-3 col-sm-6 mb-4" style="block-size: 150px;">
            <a href="{{ route("tasks") }}">
                <div class="card shadow-lg h-100 btn">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="fw-bold">Tasks</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-4" style="block-size: 150px;">
            <a href="{{ route("serviceproviderprofile") }}">
                <div class="card shadow-lg h-100 btn">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="fw-bold">Profile</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-4" style="block-size: 150px;">
            <a href="{{ route("completedtasks") }}">
                <div class="card shadow-lg h-100 btn">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="fw-bold">Completed Tasks</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-4" style="block-size: 150px;">
            <a href="{{ route("updatepassword") }}">
                <div class="card shadow-lg h-100 btn">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="fw-bold">Update Password</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
