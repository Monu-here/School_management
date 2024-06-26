@php
    $user = Auth::user();
    $setting = getSetting();

@endphp
@if (Auth::user()->role_name)

    <div class="header">

        <div class="header-left">
                 @if ($setting)
                  <span>
                      
                      {{ $setting->webistename }}
                </span> 
                 @endif
             
        </div>
        <div class="menu-toggle">
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>
        </div>

        {{-- <div class="top-nav-search">
            <form>
                <input type="text" class="form-control" placeholder="Search here">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div> --}}
        <a class="mobile_btn" id="mobile_btn">
            <i class="fas fa-bars"></i>
        </a>

        <ul class="nav user-menu">
            {{-- <li class="nav-item dropdown noti-dropdown language-drop me-2">
                <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/newDesign/img/icons/header-icon-01.svg') }}" alt="">
                </a>
                <div class="dropdown-menu ">
                    <div class="noti-content">
                        <div>
                            <a class="dropdown-item" href="javascript:;"><i class="flag flag-lr me-2"></i>English</a>
                            <a class="dropdown-item" href="javascript:;"><i class="flag flag-bl me-2"></i>Francais</a>
                            <a class="dropdown-item" href="javascript:;"><i class="flag flag-cn me-2"></i>Turkce</a>
                        </div>
                    </div>
                </div>
            </li> --}}

            <li class="nav-item dropdown noti-dropdown me-2">
                <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/newDesign/img/icons/header-icon-05.svg') }}" alt="">
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="#">
                                    <div class="media d-flex">
                                        {{-- <span class="avatar avatar-sm flex-shrink-0">
                                            <img class="avatar-img rounded-circle" alt="User Image"
                                                src="{{ asset('assets/newDesign/img/profiles/avatar-02.jpg') }}">
                                        </span> --}}
                                        <div class="media-body flex-grow-1">
                                            {{-- <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                                approved <span class="noti-title">your estimate</span></p>
                                            <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                            </p> --}}
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="#">View all Notifications</a>
                    </div>
                </div>
            </li>

            <li class="nav-item zoom-screen me-2">
                <a href="#" class="nav-link header-nav-list win-maximize">
                    <img src="{{ asset('assets/newDesign/img/icons/header-icon-04.svg') }}" alt="">
                </a>
            </li>

            <li class="nav-item dropdown has-arrow new-user-menus">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle" src="{{asset($user->image ?? 'https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png')}}" width="31" alt="">
                        <div class="user-text">
                            <h6>{{ $user->name }}</h6>
                            <p class="text-muted mb-0">{{ $user->role_name }}</p>
                        </div>
                    </span>
                </a>
                <div class="dropdown-menu">
                    <div class="user-header">
                        <div class="avatar avatar-sm">
                            <img src="{{asset($user->image ?? 'https://icons.veryicon.com/png/o/internet--web/prejudice/user-128.png')}}" alt="User Image" class="avatar-img rounded-circle">
                        </div>
                        <div class="user-text">
                            <h6>{{ $user->name }}</h6>
                            <p class="text-muted mb-0">{{ $user->role_name }}</p>
                        </div>
                    </div>
                    @role('Student')
                    <a class="dropdown-item" href="{{route('admin.setting')}}">Profile</a>

                    @endrole()
                    <a class="dropdown-item" href="{{ route('admin.user.edit',['user'=>$user->id]) }}">Setting</a>
                    <a class="dropdown-item" href="{{ route('adminLogin.logout') }}">Logout</a>
                </div>
            </li>

        </ul>

    </div>
@endif
