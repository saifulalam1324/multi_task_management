@extends('CUSTOMER.Customer')
@section('title', 'TAKEN SERVICES')

@section('content')
    <div class="container mt-3">
        <h2 class="text-center mb-4">Taken Services</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="yourtask" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Service Name</th>
                            <th>Service Provider Name</th>
                            <th>Service Provider Phone </th>
                            <th>Assigned Date</th>
                            <th>Total Payment</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($ps as $service)
                            <tr>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->provider_name }}</td>
                                <td>{{ $service->phone }}</td>
                                <td>{{ $service->created_at }}</td>
                                <td>{{ $service->total_payment }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align:end;">Total Paid:</th>
                            <th>{{ $total_payment }}</th>
                        </tr>
                    </tfoot>
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
