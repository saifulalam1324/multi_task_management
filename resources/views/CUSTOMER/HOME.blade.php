@extends('CUSTOMER.Customer')
@section('title', 'HOME')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"
                            style="background-color:#081621; inline-size: 60px;"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"
                            style="background-color:#081621 ;inline-size: 60px;"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"
                            style="background-color:#081621 ;inline-size: 60px;"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('ASSATS/PICTURE/banner.png') }}" class="d-block w-100" style="inline-size: 100%;max-inline-size: 1280px;block-size: 500px;" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('ASSATS/PICTURE/banner2.png') }}" class="d-block w-100" style="inline-size: 100%;max-inline-size: 1280px;block-size: 500px;" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('ASSATS/PICTURE/banner3.png') }}" class="d-block w-100" style="inline-size: 100%;max-inline-size: 1280px;block-size: 500px;" alt="...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 align-content-center" style="background-color:#081621 ;border-radius: 10px;">
                <h5 class="text-white text-center typing">Service লাগবে?</h5>
                <p class="text-center text-white typing" style="animation-delay: 1s; font-size: 14px;">Your Trusted Marketplace for</p>
                <p class="text-center text-white typing" style="animation-delay: 1s; font-size: 14px;">Professional Services</p>
            </div>
        </div>
    </div>
@endsection
