@extends('ADMIN.admin')
@section('title', 'Admin Add Service')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg mt-5">
            <div class="card-header text-white" style="background-color:#081621">
                <h3 class="text-center">Add New Service</h3>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('AddService') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="service_name">Service Name</label>
                            <select name="service_name" id="service_name" class="form-control">
                                <option value="">-- Select Service --</option>
                                <option value="Plumbing">Plumbing</option>
                                <option value="Electrical Repair">Electrical Repair</option>
                                <option value="Home Cleaning">Home Cleaning</option>
                                <option value="AC Installation">AC Installation</option>
                                <option value="Painting">Painting</option>
                                <option value="Carpentry">Carpentry</option>
                                <option value="Pest Control">Pest Control</option>
                                <option value="Gardening">Gardening</option>
                                <option value="CCTV Installation">CCTV Installation</option>
                                <option value="Appliance Repair">Appliance Repair</option>
                                <option value="Interior Design">Interior Design</option>
                                <option value="Moving & Shifting">Moving & Shifting</option>
                            </select>
                            <span class="text-danger">
                                @error('service_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Per_hour_price">Per Hour Price</label>
                            <input type="number" step="0.01" name="per_hour_rate" id="per_hour_rate" class="form-control"
                                value="{{ old('per_hour_rate') }}">
                            <span class="text-danger">
                                @error('per_hour_rate')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control"
                            style="block-size: 100px; resize: none;">{{ old('description') }}</textarea>
                        <span class="text-danger">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn text-white" style="background-color:#081621">
                            Add Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
