@extends('ADMIN.admin')
@section('title', 'Admin Service Requests')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Completed Services</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="serviceRequestsTable" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Request ID</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Service Name</th>
                            <th>Servicr Provider Id</th>
                            <th>Requested At</th>
                            <th>Completed At</th>
                            <th>Payment Status</th>
                            <th>Paid Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($completedservices as $req)
                            <tr>
                                <td>{{ $req->request_id }}</td>
                                <td>{{ $req->c_id }}</td>
                                <td>{{ $req->name }}</td>
                                <td>{{ $req->service_name }}</td>
                                <td>{{ $req->sp_id }}</td>
                                <td>{{ $req->created_at }}</td>
                                <td>{{ $req->work_completed_at }}</td>
                                <td><span class="text-success">{{ $req->payment_status }}</span></td>
                                <td>{{ $req->total_payment }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                            <tr>
                                <th colspan="8" style="text-align:end;">Total Earnings:</th>
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
            $('#serviceRequestsTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
