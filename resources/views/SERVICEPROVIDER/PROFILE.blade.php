@extends('SERVICEPROVIDER.serviceprovider')
@section('title', 'SERVICEPROVIDER Profile')
@section('content')
    <div class="container mt-5 justify-content-center align-items-center d-flex">
        <div class="card p-4" style="inline-size: 500px; block-size: 380px;">
            @if (Auth::guard('serviceprovider')->user()->status=="active")
                <h6 class="text-success">{{ Auth::guard('serviceprovider')->user()->status }}</h6>
            @else
                <h6 class="text-danger">{{ Auth::guard('serviceprovider')->user()->status }}</h6>
            @endif
            <img src="{{ asset('storage/' . Auth::guard('serviceprovider')->user()->image_url) }}" alt="Provider Image"
                style="inline-size:90px; block-size:90px; object-fit:cover;border-radius:50%; display:block; margin-inline-start:auto; margin-inline-end:auto;">
            <h3 class="text-center">Your Profile</h3>
            <h2 class="mb-3 text-center">{{ Auth::guard('serviceprovider')->user()->name }}</h2>
            <p class="text-center">{{ Auth::guard('serviceprovider')->user()->email }}</p>
            <form action="{{ route('statusactive') }}" method="post">@csrf
                <button type="submit" class="btn btn-success mt-1 w-100">Active</button>
            </form>
            <form action="{{ route('statusinactive') }}" method="post">@csrf
                <button type="submit" class="btn btn-danger mt-1 w-100">In Active</button>
            </form>
        </div>
    </div>
@endsection
