@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students Promotion</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Student</a></li>
                        <li class="breadcrumb-item active">All Students Promotion</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">


                    <h3 class="page-title " style="display: flex; justify-content: space-between"> Student Promotion <a
                            href="{{ route('admin.promotion.index') }}" class="btn btn-primary">
                            Manage
                            Promotion
                        </a>
                </div>
            </div>
        </div> --}}
    <!-- Add this inside your form -->
@endsection
@section('content')
    {{-- <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Students</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-list"></i></a>
                                    <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                            class="feather-grid"></i></a>
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                    <abbr title="Manage Promotion">
                                        <a href="{{ route('admin.promotion.index') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </abbr>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="clienttable" class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Image</th>
                                        <th>Student Name</th>
                                        <th>From Class</th>
                                        <th>To Class</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($pros as $pro)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                @if ($pro->student)
                                                     <img src="{{ asset($pro->student->image) }}" alt="Student Image"
                                                        width="50">
                                                @else
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png"
                                                        alt="" width="60">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pro->student)
                                                     {{ $pro->student->name }}
                                                @else
                                                    No Name
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pro->fromClass)
                                                    {{ $pro->fromClass->name }}
                                                    @php
                                                        $sectionName = $sections
                                                            ->where('id', $pro->section_id)
                                                            ->pluck('name')
                                                            ->first();
                                                    @endphp
                                                    ({{ $sectionName }})
                                                @else
                                                    No class
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pro->toClass)
                                                    {{ $pro->toClass->name }} ({{ $pro->to_section }})
                                                @else
                                                    No class
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <strong
                                                        style="color:
                                            @if ($pro->status === 'promote') green;
                                            @elseif ($pro->status === 'not_promote') red; @endif">
                                                        {{ $pro->status }}
                                                    </strong>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}
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
                                <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                        class="feather-list"></i></a>
                                <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                        class="feather-grid"></i></a>
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                    Download</a>
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
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something" />
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>From Class</th>
                                    <th>To Class</th>
                                    <th>Msg</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($pros as $pro)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                @if ($pro->student)
                                                <a href="" class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle" src="{{ asset($pro->student->image) }}" alt="User Image" /></a>
                                                    {{ $pro->student->name }}
                                                    @else
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png"
                                                        alt="" width="60">
                                                @endif
                                            </h2>
                                        </td>
                                        <td>
                                            @if ($pro->fromClass)
                                                {{ $pro->fromClass->name }}
                                                @php
                                                    $sectionName = $sections
                                                        ->where('id', $pro->section_id)
                                                        ->pluck('name')
                                                        ->first();
                                                @endphp
                                                ({{ $sectionName }})
                                            @else
                                                No class
                                            @endif

                                        </td>
                                        <td>
                                            @if ($pro->toClass)
                                                {{ $pro->toClass->name }} ({{ $pro->to_section }})
                                            @else
                                                No class
                                            @endif
                                        </td>


                                        <td>
                                            jhg
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
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
