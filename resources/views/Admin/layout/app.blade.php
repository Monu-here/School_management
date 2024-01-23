<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    @php
        $setting = getSetting();
    @endphp
    @if ($setting)
        <title> {{ $setting->titletext ?? 'School' }} | Monu @yield('title') </title>
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





    @php
        $user = Auth::user();
    @endphp

    @include('Admin.layout.sidebar')

    <div class="page-wrapper chiller-theme toggled">
        <main class="page-content">
            <div class="container-fluid">
                <div class="home-content">
                    <div class="card shadow">
                        <div class="card-body">
                            <span class="text">Dashbaord</span>
                        </div>
                    </div>
                </div>
                <div class="home-content">
                    <div class="">
                        @yield('linkbar')
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

     

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
        // let sidebar = document.querySelector(".sidebar");
        // let sidebarBtn = document.querySelector(".sidebarBtn");
        // sidebarBtn.onclick = function() {
        //     sidebar.classList.toggle("active");
        //     if (sidebar.classList.contains("active")) {
        //         sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        //     } else
        //         sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        // }

        function showModal() {
            $('#openmodel').modal('show');
            $('#showteacher').modal('show');
        }

        function showDep() {
            $('#opendep').modal('show');
            $('#showDepartment').modal('show');
        }

        $(".sidebar-dropdown > a").click(function() {
            $(".sidebar-submenu").slideUp(200);
            if (
                $(this)
                .parent()
                .hasClass("active")
            ) {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .parent()
                    .removeClass("active");
            } else {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .next(".sidebar-submenu")
                    .slideDown(200);
                $(this)
                    .parent()
                    .addClass("active");
            }
        });

        $("#close-sidebar").click(function() {
            $(".page-wrapper").removeClass("toggled");
        });
        $("#show-sidebar").click(function() {
            $(".page-wrapper").addClass("toggled");
        });

        // let arrow = document.querySelectorAll(".arrow");
        // for (var i = 0; i < arrow.length; i++) {
        //     arrow[i].addEventListener("click", (e) => {
        //         let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        //         arrowParent.classList.toggle("showMenu");
        //     });
        // }
        // let sidebar = document.querySelector(".s-sidebar");
        // let sidebarBtn = document.querySelector(".bx-menu");
        // console.log(sidebarBtn);
        // sidebarBtn.addEventListener("click", () => {
        //     sidebar.classList.toggle("close");
        // });
    </script>


</body>

</html>
