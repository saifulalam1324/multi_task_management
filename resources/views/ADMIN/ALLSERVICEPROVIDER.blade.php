@extends('ADMIN.admin')
@section('title', 'All Service Providers')
@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">All Service Providers</h2>

        <div class="card shadow">
            <div class="card-body">
                <table id="usersTable" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Picture</th>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>See More</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($serviceproviders as $user)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $user->image_url) }}" alt="Provider Image"
                                        style="inline-size:70px; block-size:70px; object-fit:cover;">
                                </td>
                                <td>{{ $user->sp_id }}</td>
                                <td>{{ $user->service_type }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td class="d-flex justify-content-between align-items-center">
                                    <form action="{{ route('eachserviceprovider', ['sp_id' => $user->sp_id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            See More..
                                        </button>
                                    </form>
                                     <form action="{{ route('removeserviceprovider', ['sp_id' => $user->sp_id]) }}" method="post">
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
            $('#usersTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
