@extends('ADMIN.admin')
@section('title', 'Service Provider Requests')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Service Providers Requests</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="SPRequests" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service Type</th>
                            <th>Address</th>
                            <th>Requested At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($serviceproviderrequests as $request)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $request->image_url) }}"
                                         alt="Provider Image"
                                         style="inline-size:70px; block-size:70px; object-fit:cover;">
                                </td>

                                <td>{{ $request->name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->phone }}</td>
                                <td>{{ $request->service_type }}</td>
                                <td>{{ $request->address }}</td>
                                <td>{{ $request->created_at }}</td>

                                <td class="d-flex justify-content-between align-items-center">
                                    <form action="{{ route('approveserviceproviderrequest', $request->sp_id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success me-1">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('rejectserviceproviderrequest', $request->sp_id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-delete-left"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#SPRequests').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
