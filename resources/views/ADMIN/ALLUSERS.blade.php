@extends('ADMIN.admin')
@section('title', 'Admin Add Service')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">All Users</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="usersTable" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->c_id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td class="d-flex justify-content-center justify-content-end">
                                    <form action="{{ route('eachuser', ['id' => $user->c_id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            See More..
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
            $('#usersTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
