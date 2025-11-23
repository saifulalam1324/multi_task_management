@extends('CUSTOMER.Customer')
@section('title', 'SERVICEPROVIDER Home')
@section('content')
    <div class="container mt-2">
        <div class="p-4">
            <h3 class="text-center">Your Profile</h3>
            <h5 class="mb-3">Name: {{ Auth::guard('customer')->user()->name }}</h5>
            <h5 class="mb-3">Email: {{ Auth::guard('customer')->user()->email }}</h5>
        </div>
    </div>
    <div class="container mt-3 d-flex">
        <div class="col-md-3 col-sm-6 mb-4" style="block-size: 150px;">
            <a href="{{ route("updateinfo") }}">
                <div class="card shadow-lg h-100 btn">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="fw-bold">Update Info</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-4" style="block-size: 150px;">
            <a href="{{ route("pendingservices") }}">
                <div class="card shadow-lg h-100 btn">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="fw-bold">Pending Services</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-4" style="block-size: 150px;">
            <a href="{{ route("takenservices") }}">
                <div class="card shadow-lg h-100 btn">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="fw-bold">Taken Services</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 mb-4" style="block-size: 150px;">
            <a href="{{ route("updatepasswordc") }}">
                <div class="card shadow-lg h-100 btn">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                        <h5 class="fw-bold">Update Password</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
