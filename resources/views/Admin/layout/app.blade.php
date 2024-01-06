<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    @php
        $setting = getSetting();
    @endphp
    @if ($setting)
        <title> {{ $setting->titletext ?? "School"}} | Monu @yield('title') </title>
    @endif
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="icon" href="{{ asset($setting->favicon ?? asset('default-favicon.ico')) }}" type="image/x-icon">
    @yield('css')
</head>

<body>


    <div class="sidebar">
        <div class="logo-details">
            @php
                $setting = getSetting();
            @endphp
            @if ($setting)
                <img src="{{ asset($setting->websiteimage) }}" alt="" srcset="">
            @endif
            @php
                $setting = getSetting();
            @endphp
            @if ($setting)
                <span class="logo_name">{{ $setting->webistename ?? 'admin' }}</span>
            @endif
        </div>






        <ul class="nav-links p-0">
            <li>
                <a href="{{ route('admin.setting.add') }}" class="active">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.index') }}" class="">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>

            </li>
            <li>
                <a href="{{ route('admin.user.index') }}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">User Account</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.student.index') }}">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Student</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.student.teacherIndex') }}">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Teacher</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.department.index') }}">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Department</span>
                </a>
            </li>


            <li class="log_out">
                <a href="{{ route('adminLogin.logout') }}">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <i class='bx bx-search'></i>
            </div>


            <div class="profile-details">
                <img src="{{ asset('uploads/setting/6jr43UIkw6N22q7iQy2Qw7gUZcXlimWOa5Lp06Bh.png') }}" alt="">
                @php
                    $user = Auth::user();
                    // dd($user);
                @endphp

                @if ($user && $user->role_name == 'Admin')
                    <span class="admin_name">
                        {{ $user->name }}
                        <span style="font-size: 10px">{{ $user->role_name }}</span>
                    </span>
                @endif

                <i class="bx bx-chevron-down"></i>
            </div>
        </nav>

        <div class="home-content">


            <div class="overview-boxes">
                @yield('linkbar')
                @yield('content')

            </div>


        </div>


    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-responsive-bs4/2.5.0/responsive.bootstrap4.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.8/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.8/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
    @include('Admin.tostar.index')
    @include('Admin.Teacher.add')
    @include('Admin.Dep.add')
    @yield('js')
    <script>
        showToastr();
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }

        function showModal() {
            $('#openmodel').modal('show');
            $('#showteacher').modal('show');
        }
        function showDep() {
            $('#opendep').modal('show');
            $('#showDepartment').modal('show');
        }
    </script>

</body>

</html>
