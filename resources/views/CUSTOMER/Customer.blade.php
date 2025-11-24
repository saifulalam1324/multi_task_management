<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('ASSATS/CSS/STYLE.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #081621;">
        <div class="container-fluid d-flex justify-content-between">
            <div class="d-flex align-items-center justify-content-start">
                <a class="navbar-brand text-white font-weight-bold" href="{{ route('Userhome') }}">
                    Service লাগবে ?
                </a>
            </div>
            <div class="d-flex justify-content-center align-items-center text-center">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="navbar-nav mr-auto">
                        <a class="nav-link text-white" href="{{ route('userprofile') }}">Profile</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                @if (Auth::guard('customer')->check())
                    <div class="dropdown text-center">
                        <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i> {{ Auth::guard('customer')->user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-transparent border-0">
                            <div class="d-flex justify-content-center ml-5">
                                <form id="logoutForm" action="{{ route('UserLogout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" title="Logout">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    </button>
                                </form>
                                <script>
                                    document.getElementById('logoutForm').addEventListener('submit', function (event) {
                                        event.preventDefault();
                                        if (confirm("Are you sure you want to logout?")) {
                                            this.submit();
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                @else
                    <a class="btn btn-outline-light ml-2" href="{{ route('loginsignup') }}">Sign In</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        @yield('content')
    </div>
    <footer class="text-white pt-4 pb-3 mt-5" style="background-color:#081621;">
        <div class="container">
            <div class="row text-center text-md-left">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Service লাগবে?</h5>
                    <p>Your trusted online platform for professional services—fast, reliable, and tailored to your needs. Quality service delivery, every time.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('Userhome') }}" class="text-white text-decoration-none">Home</a>
                        </li>
                        <li><a href="{{ route('services') }}" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="{{ route('userprofile') }}" class="text-white text-decoration-none">Profile</a>
                        </li>
                        <li><a href="{{ route('loginsignup') }}" class="text-white text-decoration-none">Sign In</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Contact Us</h5>
                    <p><i class="fa-solid fa-location-dot"></i> Chittagong, Bangladesh</p>
                    <p><i class="fa-solid fa-envelope"></i> support@serviceলাগবে?.com</p>
                    <p><i class="fa-solid fa-phone"></i> +880 1625 933020</p>
                    <div class="mt-2">
                        <a href="#" class="text-white mr-2"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white mr-2"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white mr-2"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
            </div>

            <hr class="bg-light">

            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Service লাগবে?. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('ASSATS/JS/LOGINSIGNUP.js') }}"></script>
    <script src="{{ asset('ASSATS/JS/SCRIPT.js') }}"></script>
    @yield('scripts')
</body>

</html>
