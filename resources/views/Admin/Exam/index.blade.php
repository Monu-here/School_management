@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Exam</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Exam</a></li>
                        <li class="breadcrumb-item active">All Exam</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    {{-- <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="clienttable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Term</th>
                            <th>Year</th>
                            <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($exams as $exam)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $exam->name }}</td>
                                 <td>{{ $exam->term }}</td>
                                <td>{{ $exam->year }}</td>
                                <td>
                                    xxx
                                 </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{ route('admin.exam.add') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttable">
                            <thead class="student-thread">
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Term</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($exams as $exam)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $exam->name }}</td>
                                        <td>{{ $exam->term }}</td>
                                        <td>{{ $exam->year }}</td>
                                        <td>
                                            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
