@extends('CUSTOMER.Customer')
@section('title', 'All Services')
@section('content')

    <div class="container my-4">
        <div class="row g-4 text-center">
            <div class="container justify-content-center mb-4">
                <h1 class="fw-bold">All The Services</h1>
                <p class="text-muted">Choose your desired service</p>
            </div>

            @if($services->isEmpty())
                <p class="text-center text-danger">No services available at the moment.</p>
            @else
                @foreach ($services as $service)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-lg h-100 btn" data-toggle="modal"
                            data-target="#serviceModal{{ $service->service_id }}">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center p-4">
                                <h5 class="fw-bold">{{ $service->service_name }}</h5>
                                <p class="fw-bold text-dark mb-0">৳{{ number_format($service->per_hour_rate, 2) }}/hour</p>
                                <p>Click For View Details</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade m-5" id="serviceModal{{ $service->service_id }}" tabindex="-1" role="dialog"
                        aria-labelledby="serviceModalLabel{{ $service->service_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#081621;">
                                    <h5 class="modal-title text-white" id="serviceModalLabel{{ $service->service_id }}">
                                        {{ $service->service_name }}
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="fw-bold">৳{{ number_format($service->per_hour_rate, 2) }}/hour</h4>
                                            <p class="mt-3"><strong>Description:</strong> {{ $service->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <form action="{{ route('requestservice', $service->service_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn text-white" style="background-color:#081621">
                                            Book Now
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
