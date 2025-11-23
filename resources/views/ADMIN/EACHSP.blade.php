@extends('ADMIN.admin')
@section('title', 'EACH SERVICE PROVIDER Profile')
@section('content')
    <div class="container mt-5 justify-content-center align-items-center d-flex">
        <div class="card p-4 d-flex justify-content-center" style="inline-size: 500px; block-size: 380px; border-radius: 15px;">
            <h5>Name: {{ $serviceprovider->name }}</h5>
            <p>Email: {{ $serviceprovider->email }}</p>
            <p>Phone: {{ $serviceprovider->phone }}</p>
            <p>Total Earning: {{ $total_payment }}</p>
            <p>Total Services: {{ $total_services }}</p>
        </div>
    </div>
@endsection
