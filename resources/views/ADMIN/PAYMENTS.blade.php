@extends('ADMIN.admin')
@section('title', 'Admin Work Done')
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Payments</h2>

    <div class="card shadow">
        <div class="card-body">
            <table id="Workdone" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Request ID</th>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Service Name</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $req)
                    <tr>
                        <td>{{ $req->request_id }}</td>
                        <td>{{ $req->c_id }}</td>
                        <td>{{ $req->name }}</td>
                        <td>{{ $req->service_name }}</td>
                        <td><span class="text-danger">{{ $req->payment_status }}</span></td>
                        <td class="d-flex justify-content-center align-content-center">
                            <form class="" action="{{ route('markaspaid', $req->request_id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success mb-1 me-1">Mark as Paid</button>
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
        $('#Workdone').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>
@endsection
