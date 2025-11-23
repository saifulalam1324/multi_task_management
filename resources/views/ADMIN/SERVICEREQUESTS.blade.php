@extends('ADMIN.admin')
@section('title', 'Admin Service Requests')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">All Service Requests</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="serviceRequestsTable" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Request ID</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Service Name</th>
                            <th>Status</th>
                            <th>Requested At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $req)
                            <tr>
                                <td>{{ $req->request_id }}</td>
                                <td>{{ $req->c_id }}</td>
                                <td>{{ $req->name }}</td>
                                <td>{{ $req->service_name }}</td>
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
                                <td class="d-flex">
                                    <form class="" action="{{ route('approveservicerequest', $req->request_id) }}"
                                        method="post">
                                        @csrf
                                        <input type="text" class="w-75 mr-1" name="sp_id" required placeholder="SP ID">
                                        <button type="submit" class="btn btn-sm btn-success mb-1 me-1"><i
                                                class="fa-solid fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('rejectservicerequest', $req->request_id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger mb-1"><i
                                                class="fa-solid fa-delete-left"></i></button>
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
            $('#serviceRequestsTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
