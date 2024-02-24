@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students Payment</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Student Wise Payment</a></li>
                        <li class="breadcrumb-item active">All Students Payment</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <form action="{{ route('admin.payment.studentPayment') }}" method="GET">
        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="number" name="idno" class="form-control" placeholder="Search by ID ..."
                            value="{{ $selectedIdno }}" />

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Student Search"
                            value="{{ $selectedName }}">

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <select name="class_id" id="class_id" class="form-control">
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ $class->id == $selectedClass ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
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
    {{-- <div class="card-body">
        <div class="table-responsive">
            <table id="clienttable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID No</th>
                        <th>Imasssge</th>
                        <th>Section</th>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Class</th>
                        <th>Number</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th class="d-none">Created day</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $student->idno }}</td>
                            <td><img src="{{ asset($student->image) }}" alt="" width="60"></td>
                            <td>{{ $student->section }}</td>
                            <td>{{ $student->name }}</td>

                            <td>{{ $student->roll }}</td>
                            <td>{{ $student->class }}</td>

                            <td>{{ $student->number }}</td>
                            <td>
                                @foreach ($payment_records as $payment_record)
                                    @if ($payment_record->student_id == $student->id)
                                        <strong
                                            class="btn
                                            @if ($payment_record->status === 'Pending') btn-danger
                                            @elseif ($payment_record->status === 'Half paid')
                                                btn-warning
                                            @elseif ($payment_record->status === 'Full paid')
                                                btn-success @endif
                                        ">
                                            {{ $payment_record->status }}

                                        </strong>
                                    @endif
                                @endforeach

                            </td>
                            <td>
                                <form
                                    action="{{ route('admin.payment.studentPaymentAdd', ['student_id' => $student->id]) }}"
                                    method="GET" style="display:inline;">
                                    <button type="submit" class="btn btn-success">Payment</button>
                                </form>
                            </td>


                            <td>
                                {{ getAgo($student->created_at) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                                <a href="{{ route('admin.payment.add') }}" class="btn btn-primary"><i
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
                                    <th>#</th>
                                    <th>ID No</th>
                                    <th>Image</th>
                                    <th>Section</th>
                                    <th>Roll No</th>
                                    <th>Class</th>
                                    <th>Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th class="d-none">Created day</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp

                                @foreach ($students as $student)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>
                                        <td>{{ $i++ }}</td>
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
                                        <td>{{ $student->roll }}</td>
                                        <td>
                                            @php
                                                $className = $classes
                                                    ->where('id', $student->class_id)
                                                    ->pluck('name')
                                                    ->first();
                                            @endphp
                                            {{ $className ?? 'N/A' }}
                                        </td>


                                        <td>{{ $student->number }}</td>
                                        <td>
                                            @foreach ($payment_records as $payment_record)
                                            @endforeach
                                            @if ($payment_record->student_id == $student->id)
                                                <span class="badge font-size-12 ms-2">
                                                    <strong
                                                        class="btn
                                                    @if ($payment_record->status === 'Pending') btn-danger
                                                    @elseif ($payment_record->status === 'Half paid') btn-warning
                                                    @elseif ($payment_record->status === 'Full paid') btn-success @endif">
                                                        {{ $payment_record->status }}
                                                    </strong>
                                                </span>
                                            @endif

                                        </td>
                                        <td>
                                            <form
                                                action="{{ route('admin.payment.studentPaymentAdd', ['student_id' => $student->id]) }}"
                                                method="GET" style="display:inline;">
                                                <button type="submit" class="btn btn-success">Payment</button>
                                            </form>
                                        </td>


                                        <td>
                                            {{ getAgo($student->created_at) }}
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
    {{-- <script>
        $(function() {
            $('#clienttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
    </script> --}}
@endsection
