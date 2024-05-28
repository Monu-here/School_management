<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $setting = getsetting();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    @if ($setting)
        <title>{{ $setting->titletext }}</title>
    @endif
    <link rel="shortcut icon" href="{{ asset($setting->favicon ?? 'monu') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/newDesign/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    @yield('css')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    @include('Admin.layout.sidebar')
    @include('Admin.layout.header')
    <div class="main-wrapper" style="">
        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('title')
                @yield('content')
                @include('Admin.layout.footer')
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
    <script src="{{ asset('assets/newDesign/plugins/datatables/datatables.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @include('Admin.tostar.index')
    @include('Admin.layout.jshelper')
    {{-- @include('Admin.Teacher.add') --}}
    {{-- @include('Admin.Role_Permission_Manage.editRole') --}}
    @yield('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // $('.photo').dropify();
            ShowTost();
        });
    </script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

</html>
