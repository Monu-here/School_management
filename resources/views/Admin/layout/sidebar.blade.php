@php
    $setting = getSetting();
    $role = getRole();
    // dd($role);
@endphp
@php
    $user = Auth::user();
    $role = DB::table('roles')->first();
@endphp

</div>


<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">

        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="feather-grid"></i> <span> Dashboard</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li class=""><a href="{{ route('admin.index') }}"
                                class="{{ Route::currentRouteNamed('admin.index') ? 'active' : '' }}">Dashboard</a></li>
                        @role('SuperAdmin', 'Admin')
                            <li><a href="{{ route('admin.setting.add') }}"
                                    class="{{ Route::currentRouteNamed('admin.setting.add') ? 'active' : '' }}">Setting</a>
                            </li>
                        @endrole()
                    </ul>
                </li>
                @role('SuperAdmin')
                    <li class="submenu">
                        <a href="#"><i class="feather-grid"></i> <span> Role Manage</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li class=""><a href="{{ route('admin.role-permission.addRole') }}"
                                    class="{{ Route::currentRouteNamed('admin.role-permission.addRole') ? 'active' : '' }}">Role
                                    &
                                    Permission Mange</a>
                            </li>

                            <li><a href="{{ route('admin.role-permission.giveRole') }}"
                                    class="{{ Route::currentRouteNamed('admin.role-permission.giveRole') ? 'active' : '' }}">User
                                    Wise
                                    Role and Permission Manage</a>
                            </li>
                            <li><a href="{{ route('admin.role-permission.assignPerRole') }}"
                                    class="{{ Route::currentRouteNamed('admin.role-permission.assignPerRole') ? 'active' : '' }}">Permission
                                    To Role</a>
                            </li>
                        </ul>
                    </li>
                @endrole()
                @role('SuperAdmin', 'Admin')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span> Admin Section</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li>
                                <a href="{{ route('admin.user.index') }}"
                                    class="{{ Route::currentRouteNamed('admin.user.index') ? 'active' : '' }}">Admin
                                    <span class="badge badge-pill badge-success">{{ $user->count() }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.roleTeacher') }}"
                                    class="{{ Route::currentRouteNamed('admin.user.roleTeacher') ? 'active' : '' }}">Teacher
                                    <span
                                        class="badge badge-pill badge-success">{{ $user->where('role_name', 'Teacher')->count() }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole()
                <li class="submenu">
                    <a href="#"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.student.index') }}"
                                class="{{ Route::currentRouteNamed('admin.student.index') ? 'active' : '' }}">Student
                                List</a></li>
                        <li><a href="{{ route('admin.atten.index') }}"
                                class="{{ Route::currentRouteNamed('admin.atten.index') ? 'active' : '' }}">Student
                                Attendence</a></li>
                        <li><a href="{{ route('admin.atten.report') }}"
                                class="{{ Route::currentRouteNamed('admin.atten.report') ? 'active' : '' }}">Student
                                Attendence Report</a></li>
                        <li><a href="{{ route('admin.promotion.list') }}"
                                class="{{ Route::currentRouteNamed('admin.promotion.list') ? 'active' : '' }}">Student
                                Promote</a></li>
                    </ul>
                </li>
                @role('SuperAdmin', 'Admin')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Staff</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.student.teacherIndex') }}"
                                    class="{{ Route::currentRouteNamed('admin.student.teacherIndex') ? 'active' : '' }}">Teacher
                                    List</a></li>

                        </ul>
                    </li>
                @endrole()
                @role('SuperAdmin', 'Admin')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-building"></i> <span> Fee Collection</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.payment.add') }}"
                                    class="{{ Route::currentRouteNamed('admin.payment.add') ? 'active' : '' }}">Payment
                                    Add</a></li>
                            <li><a href="{{ route('admin.payment.studentPayment') }}"
                                    class="{{ Route::currentRouteNamed('admin.payment.studentPayment') ? 'active' : '' }}">Student
                                    Wise Payment</a></li>
                            <li><a href="{{ route('admin.payment.index') }}"
                                    class="{{ Route::currentRouteNamed('admin.payment.index') ? 'active' : '' }}">Student
                                    Wise Payment List</a></li>
                        </ul>
                    </li>
                @endrole()
                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i> <span> Examination</span> <span
                            class="menu-arrow"></span></a>

                    <ul>
                        <li>
                            <a href="{{ route('admin.exam.index') }}"
                                class="{{ Route::currentRouteNamed('admin.exam.index') ? 'active' : '' }}"> Exam
                                List</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.grade.index') }}"
                                class="{{ Route::currentRouteNamed('admin.grade.index') ? 'active' : '' }}">Grade</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.mark.index') }}"
                                class="{{ Route::currentRouteNamed('admin.mark.index') ? 'active' : '' }}">Mark</a>
                        </li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Teacher</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.teacher.index') }}"
                                class="{{ Route::currentRouteNamed('admin.teacher.index') ? 'active' : '' }}"> Teacher
                                DailyLog</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.time-tabletime') }}"
                                class="{{ Route::currentRouteNamed('admin.time-tabletime') ? 'active' : '' }}">Time
                                Table</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.department.index') }}"
                                class="{{ Route::currentRouteNamed('admin.department.index') ? 'active' : '' }}">Department
                        </li>
                    </ul>
                </li>
                @role('Admin')
                    <li class="submenu">
                        <a href="#"><i class="fas fa-clipboard"></i> <span> Front</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li>

                                <a href="{{ route('admin.frontdetail.index') }}"
                                    class="{{ Route::currentRouteNamed('admin.frontdetail.list') ? 'active' : '' }}">Home
                                    (index)</a>
                            </li>
                            <li>
                                <a href="#">About Us</a>
                            </li>

                        </ul>
                    </li>
                @endrole()
                <li class="menu-title">
                    <span>Management</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Commnunication</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        @role('SuperAdmin', 'Admin')
                            <li>
                                <a href="{{ route('admin.notice.index') }}"
                                    class="{{ Route::currentRouteNamed('admin.notice.list') ? 'active' : '' }}"> Notice
                                    List</a>
                            </li>
                        @endrole()

                        <li>
                            <a href="{{ route('admin.mark.index') }}"
                                class="{{ Route::currentRouteNamed('admin.mark.list') ? 'active' : '' }}">Mark</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.department.index') }}"
                                class="{{ Route::currentRouteNamed('admin.department.index') ? 'active' : '' }}">Department
                        </li>
                    </ul>
                </li>



                <li class="submenu d-none">
                    <a href="javascript:void(0);"><i class="fas fa-code"></i> <span>Multi Level</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                <li class="submenu">
                                    <a href="javascript:void(0);"> <span> Level 2</span> <span
                                            class="menu-arrow"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> <span>Level 1</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
