@extends('ADMIN.admin')
@section('title', 'Admin Active Service Providers')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Active Service Providers</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="usersTable" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activesp as $user)
                            <tr>
                                <td>{{ $user->sp_id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->service_type }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
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
            $('#usersTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
