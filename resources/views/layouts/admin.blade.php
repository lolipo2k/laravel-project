<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Admin Panel</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    {{-- Scripts --}}
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!--  Font Awesome  -->
    <script src="https://kit.fontawesome.com/eda584e63d.js"></script>
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('admin.index') }}">Admin panel</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ route('logout') }}">Sign out</a>
            </li>
        </ul>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin')) active @endif" href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/vacancies')) active @endif" href="{{ route('admin.vacancies') }}">Vacancies</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/users*')) active @endif" href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/service*')) active @endif" href="{{ route('admin.service.index') }}">Service</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/additional*')) active @endif" href="{{ route('admin.additional.index') }}">Additional</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/furniture*')) active @endif" href="{{ route('admin.furniture.index') }}">Furniture</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/sub*')) active @endif" href="{{ route('admin.sub.index') }}">Cleaning frequency</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/promocode*')) active @endif" href="{{ route('admin.promocode.index') }}">Promocode</a></li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Orders</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/orders')) active @endif" href="{{ route('admin.orders') }}">Cleaning</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/office')) active @endif" href="{{ route('admin.office') }}">Office</a></li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>F.A.Q.</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/category*')) active @endif" href="{{ route('admin.category.index') }}">Category</a></li>
                        <li class="nav-item"><a class="nav-link @if(Request::is('admin/faq*')) active @endif" href="{{ route('admin.faq.index') }}">F.A.Q.</a></li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3 pb-2 mb-3">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
