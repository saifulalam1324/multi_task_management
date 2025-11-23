@extends('ADMIN.admin')
@section('title', 'Admin Service Requests')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Approved Services</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="serviceRequestsTable" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Request ID</th>
                            <th>Customer Name</th>
                            <th>Service Name</th>
                            <th>Service Provider Name</th>
                            <th>Requested At</th>
                            <th>Approved At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvedServices as $req)
                            <tr>
                                <td>{{ $req->request_id }}</td>
                                <td>{{ $req->name }}</td>
                                <td>{{ $req->service_name }}</td>
                                <td>{{ $req->sp_name }}</td>
                                <td>
                                    @if($req->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($req->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $req->created_at }}</td>
                                <td>{{ $req->approved_at }}</td>
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
            $('#serviceRequestsTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
