<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/newDesign/plugins/datatables/datatables.min.css')}}">

    @yield('css')
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                @include('Admin.layout.header')
                @yield('title')
                @include('Admin.layout.sidebar')
                @yield('content')
                {{-- @include('AdminNew.layout.footer') --}}
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/newDesign/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/newDesign/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/newDesign/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/newDesign/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/newDesign/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/newDesign/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('assets/newDesign/js/script.js') }}"></script>
    <script src="{{asset('assets/newDesign/plugins/datatables/datatables.min.js')}}"></script>

    @yield('js')
</body>

</html>
