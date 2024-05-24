@extends('Admin.layout.app')

@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Student</a></li>
                        <li class="breadcrumb-item active">All Students</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <form action="{{ route('admin.student.index') }}" method="GET">

        <div class="student-group-form">

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Search By Name ..."
                            value="{{ $selectedName }}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="number" name="idno" class="form-control" placeholder="Search by Symbol No ..."
                            value="{{ $selectedIdno }}" />
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Students</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{ route('admin.student.add') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttable">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        SN
                                    </th>
                                    <th>Symbol No</th>
                                    <th>Name</th>
                                    <th>Section</th>
                                    <th>Class</th>
                                    <th>Parent Name</th>
                                    <th>Mobile Number</th>
                                    <th>Address</th>
                                    <th class="text-end ">Action</th>
                                    <th class="text-end ">Created at</th>

                                </tr>
                            </thead>
                            @role('SuperAdmin')
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                {{ $i++ }}
                                            </td>
                                            <td>{{ $student->idno }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="" class="avatar avatar-sm me-2"><img
                                                            class="avatar-img rounded-circle" src="{{ asset($student->image) }}"
                                                            alt="User Image" /></a>
                                                    <a href="">{{ $student->name }}</a>
                                                </h2>
                                            </td>
                                            <td>
                                                @php
                                                    $sectionName = $sections
                                                        ->where('id', $student->section_id)
                                                        ->pluck('name')
                                                        ->first();
                                                @endphp
                                                {{ $sectionName ?? 'N/A' }}

                                            </td>
                                            <td>
                                                @php
                                                    $className = $cls
                                                        ->where('id', $student->class_id)
                                                        ->pluck('name')
                                                        ->first();
                                                @endphp
                                                {{ $className ?? 'N/A' }}
                                            </td>


                                            <td>{{ $student->f_name }}</td>
                                            <td>{{ $student->f_no }}</td>
                                            <td>{{ $student->address }}</td>
                                            <td>
                                                <a href="{{ route('admin.student.edit', ['student' => $student->id]) }}"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-pen text-white"></i></a>
                                                <a href="{{ route('admin.student.studentShow', ['student' => $student->id]) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-eye text-white"></i></a>
                                                <a href="{{ route('admin.student.del', ['student' => $student->id]) }}"
                                                    class="btn btn-sm btn-danger" onclick="return yes()"><i
                                                        class="fa fa-trash text-white"></i></a>



                                            </td>
                                            <td> {{ getAgo($student->created_at) }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            @endrole()
                            @role('Teacher')
                                @php
                                    $i = 1;
                                    $user = Auth::user();
                                    $teacher = $user->teacher;
                                    $assignedClassIds = explode(',', $teacher->class_id);
                                    $assignedFaculityIds = explode(',', $teacher->faculity_id);
                                    $assignedSectionIds = explode(',', $teacher->section_id);
                                    $assignedClassIds = array_map('intval', $assignedClassIds);
                                    $assignedFaculityIds = array_map('intval', $assignedFaculityIds);
                                    $assignedSectionIds = array_map('intval', $assignedSectionIds);
                                    $students = DB::table('students')
                                        ->whereIn('faculity_id', $assignedFaculityIds)
                                        ->whereIn('class_id', $assignedClassIds)
                                        ->whereIn('section_id', $assignedSectionIds)
                                        ->get();
                                @endphp


                                <tbody>
                                    @if ($students->isEmpty())
                                        <p>No class and section are assign</p>
                                    @else
                                        @foreach ($students as $ss)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $ss->idno }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle" src="{{ asset($ss->image) }}"
                                                                alt="User Image" /></a>
                                                        <a href="">{{ $ss->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    @php
                                                        $sectionName = $sections
                                                            ->where('id', $ss->section_id)
                                                            ->pluck('name')
                                                            ->first();
                                                    @endphp
                                                    {{ $sectionName ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    @php
                                                        $className = $cls
                                                            ->where('id', $ss->class_id)
                                                            ->pluck('name')
                                                            ->first();
                                                    @endphp
                                                    {{ $className ?? 'N/A' }}
                                                </td>
                                                <td>{{ $ss->f_name }}</td>
                                                <td>{{ $ss->f_no }}</td>
                                                <td>{{ $ss->address }}</td>
                                                <td>
                                                    <a href="{{ route('admin.student.edit', ['student' => $ss->id]) }}"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-pen text-white"></i></a>
                                                    <a href="{{ route('admin.student.studentShow', ['student' => $ss->id]) }}"
                                                        class="btn btn-sm btn-success"><i class="fa fa-eye text-white"></i></a>
                                                    <a href="{{ route('admin.student.del', ['student' => $ss->id]) }}"
                                                        class="btn btn-sm btn-danger" onclick="return yes()"><i
                                                            class="fa fa-trash text-white"></i></a>
                                                </td>
                                                <td> {{ getAgo($ss->created_at) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif



                                </tbody>
                            @endrole()
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            $('#clienttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
