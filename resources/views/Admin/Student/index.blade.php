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
                         <input type="text" name="name" class="form-control" placeholder="Student Search"
                             value="{{ $selectedName }}">
                     </div>
                 </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="number" name="idno" class="form-control" placeholder="Search by ID ..."
                            value="{{ $selectedIdno }}" />
                    </div>
                </div>
                 {{-- <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <select name="section_id" id="section_id" class="form-control">
                            <option value="">Select section</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ old('section_id', $selectedSection) == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
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
                                <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                        class="feather-list"></i></a>
                                <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                        class="feather-grid"></i></a>
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                    Download</a>
                                <a href="{{route('admin.student.add')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                    <th>Section</th>
                                    <th>Class</th>
                                    <th>Parent Name</th>
                                    <th>Mobile Number</th>
                                    <th>Address</th>
                                    <th class="text-end ">Action</th>
                                    <th class="text-end d-none">Marksheet Show</th>
                                    <th class="text-end d-none">Marksheet send To Parent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
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
                                            <a href="{{ route('admin.student.studentShow', ['student' => $student->id]) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-eye text-white"></i></a>
                                            <a href="{{ route('admin.student.del', ['student' => $student->id]) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash text-white"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.mark.admin.marksheet', $student->id) }}"
                                                class="btn btn-primary text-white">Show
                                                Marksheet</a>
                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('admin.mark.admin.mark.email', ['sendMail' => $student->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Send Marksheet to
                                                    Parent</button>
                                            </form>
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
