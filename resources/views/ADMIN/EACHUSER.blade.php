@extends('ADMIN.admin')
@section('title', 'Each USER Profile')
@section('content')
    <div class="container mt-5 justify-content-center align-items-center d-flex">
        <div class="card p-4 d-flex justify-content-center" style="inline-size: 500px; block-size: 380px; border-radius: 15px;">
            <h5>Name: {{ $user->name }}</h5>
            <p>Email: {{ $user->email }}</p>
            <p>Phone: {{ $user->phone }}</p>
            <p>Total paid: {{ $total_payment }}</p>
            <p>Total Services: {{ $total_services }}</p>
            <p>Taken Services: {{ implode(', ', $distinct_services->toArray()) }}</p>
        </div>
    </div>
@endsection
