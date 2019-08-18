<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark fixed-top flex-md-nowrap justify-content-start bg-dark p-0" id="navbar-top">
            <a href="" class="navbar-brand col-md-2 col-sm-3 mr-0">weeliez.com</a>
            <input type="text" class="form-control form-control-dark navbar-search col-2 mr-auto" placeholder="Search...">
            <ul class="navbar-nav px-3">
                <li class="nav-item">
                    <a href="" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 d-none d-md-block bg-dark sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Articles</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.motorcycles.index') }}" class="nav-link">Motorcycles</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.brands.index') }}" class="nav-link">Brands</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}" class="nav-link">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.types.index') }}" class="nav-link">Attributes</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">Users</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <main class="col-md-9 col-lg-10 ml-sm-auto">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin/app.js') }}" defer></script>
</body>
</html>
