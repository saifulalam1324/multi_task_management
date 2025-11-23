@extends('SERVICEPROVIDER.serviceprovider')
@section('title', 'SERVICEPROVIDER Completed Tasks')
@section('content')
    <div class="container mt-3">
        <h2 class="text-center mb-4">Completed Tasks</h2>
        <div class="card shadow">
            <div class="card-body">
                <table id="yourtask" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Assaigned date</th>
                            <th>Completed date</th>
                            <th>Paid Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $req)
                            <tr>
                                <td>{{ $req->name }}</td>
                                <td>{{ $req->address }}</td>
                                <td>{{ $req->updated_at }}</td>
                                <td>{{ $req->work_completed_at }}</td>
                                <td>{{ $req->payment_sp }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <h5 class="text-end">Total Earnings: {{ $total_earnings }}</h5>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#yourtask').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
