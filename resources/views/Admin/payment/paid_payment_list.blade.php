@extends('Admin.layout.app')

@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students Wise Payment</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Students Wise Payment List</a></li>
                        <li class="breadcrumb-item active">All Students Wise Payment List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.payment.index') }}" method="GET">
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
                        <select name="class_id" id="class_id" class="form-control">
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ $class->id == $selectedClass ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <select name="section_id" class="form-control">
                    <option value="">Select Section</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>

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
                                    <th>#</th>
                                    <th>ID No</th>
                                    <th>Payment Id</th>
                                    <th>Student Id</th>
                                    <th>ref_no</th>
                                    <th>Amount Paid</th>
                                    <th>Balance</th>
                                    <th>Paid</th>
                                    <th>Year</th>
                                    <th>Status</th>
                                    <th>Print Bill</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($payment_records as $payment_record)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $payment_record->id }}</td>
                                        <td>{{ $payment_record->payment_id }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                @php
                                                    $studentName = $students
                                                        ->where('id', $payment_record->student_id)
                                                        ->pluck('name')
                                                        ->first();
                                                @endphp
                                                @php
                                                    $studentImage = $students
                                                        ->where('id', $payment_record->student_id)
                                                        ->pluck('image')
                                                        ->first();
                                                @endphp
                                                <a href="" class="avatar avatar-sm me-2"><img
                                                        class="avatar-img rounded-circle" src="{{ asset($studentImage) }}"
                                                        alt="User Image" /></a>
                                                {{ $studentName ?? 'N/A' }}
                                                {{-- <a href="">{{ $payment_record->student->name }}</a> --}}
                                            </h2>
                                        </td>

                                        <td>
                                            {{ $payment_record->ref_no }}
                                        </td>
                                        <td>
                                            {{ $payment_record->amt_paid }}
                                        </td>
                                        <td>
                                            {{ $payment_record->balance }}
                                        </td>
                                        <td>
                                            {{ $payment_record->paid }}
                                        </td>
                                        <td>
                                            {{ $payment_record->year }}
                                        </td>
                                        <td>
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
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.payment.printBill', ['student_id' => $payment_record->student_id]) }}"
                                                class="btn btn-secondary" target="_blank">
                                                Print Bill
                                            </a>
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
