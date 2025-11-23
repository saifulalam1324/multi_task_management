@extends('SERVICEPROVIDER.serviceprovider')
@section('title', 'SERVICEPROVIDER Tasks')
@section('content')
    <div class="container mt-3">
        <h2 class="text-center mb-4">Tasks</h2>
        <div class="card shadow">
            <div class="card-body">
                <table id="yourtask" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Assaigned date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $req)
                            <tr>
                                <td>{{ $req->name }}</td>
                                <td>{{ $req->address }}</td>
                                <td>{{ $req->updated_at }}</td>
                                <td class="d-flex justify-content-center allgin-items-center">
                                    @if ($req->status == 'approved')
                                        <form action="{{ route('workstarted', $req->request_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Start Work
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('workdone', $req->request_id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Done
                                            </button>
                                        </form>
                                    @endif
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
            $('#yourtask').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
@endsection
