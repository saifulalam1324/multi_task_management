<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('ASSATS/CSS/STYLE1.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color: #081621;">
        <h2 class="text-white text-center">Admin Dashboard</h2>
    </div>

    <div class="container-fluid overflow-hidden">
        <div class="row">
            <div class="col-1 p-0">
                <nav class="navbar navbar-light flex-column vh-100 p-0 position-fixed shadow-lg"
                    style="inline-size:180px; background-color:#081621;">
                    <div class="container-fluid p-0 d-flex flex-column h-100 ">
                        <ul class="navbar-nav flex-column w-100 pt-3 mt-5">
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('adminhome') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('adminhome') }}">Home</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('addservicepage') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('addservicepage') }}">Add Service</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('servicerequests') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('servicerequests') }}">Service Requests</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('activesp') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('activesp') }}">Active SP</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('doneservices') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('doneservices') }}">Work Done</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('payments') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('payments') }}">Payments</a>
                            </li>

                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('completedservices') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('completedservices') }}">Completed Services</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('serviceproviderrequests') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('serviceproviderrequests') }}">SP Requests</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('allusers') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('allusers') }}">All Users</a>
                            </li>
                            <li class="nav-item d-flex justify-content-center">
                                <a class="text-center btn w-100 ml-1 mr-1 mb-1 {{ request()->routeIs('allserviceproviders') ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    href="{{ route('allserviceproviders') }}">All Service Providers</a>
                            </li>
                            <li class="nav-item mb-2">
                                <div class="dropdown ml-1" style="inline-size: 170px;">
                                    <button class="btn btn-outline-light w-100 text-start dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                        <p>Your Market</p>
                                        {{ Auth::guard('admin')->user()->name }}
                                    </button>
                                    <div class="w-100 dropdown-menu dropdown-menu-center custom-dropdown bg-transparent"
                                        style="inline-size: 170px; overflow-y: auto;"
                                        aria-labelledby="dropdownMenuButton">
                                        <form id="logoutForm" action="{{ route('AdminLogout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-11 offset-1 p-0">
                <div class="container-fluid overflow-hidden mt-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    @yield('scripts')
</body>

</html>
