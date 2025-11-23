@extends('CUSTOMER.Customer')
@section('title', 'PENDING SERVICES')

@section('content')
    <div class="container mt-3">
        <h2 class="text-center mb-4">Pending Services</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="yourtask" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Service Name</th>
                            <th>Service Provider Name</th>
                            <th>Service Provider Phone </th>
                            <th>Assigned Date</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pss as $service)
                            <tr>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->provider_name ?? 'Not Assigned' }}</td>
                                <td>{{ $service->provider_phone ?? 'N/A' }}</td>
                                <td>{{ $service->created_at }}</td>
                                <td>
                                    <form action="{{ route('cancelpendingservice', $service->request_id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
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
            $('#yourtask').DataTable();
        });
    </script>
@endsection
