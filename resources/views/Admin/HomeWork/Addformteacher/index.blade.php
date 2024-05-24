@extends('Admin.layout.app')
{{-- @section('css') --}}
<style>
    .con img {
        max-width: 100%;
        height: auto;
    }
</style>
{{-- @endsection --}}
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Homework</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Homework</a></li>
                        <li class="breadcrumb-item active">View from Teacher</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Homework</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttable">
                            <thead class="student-thread">
                                <tr>

                                    <th>ID</th>
                                    <th>Assigement Title</th>
                                    <th>Assigement Content</th>
                                    <th>Assigement Given By</th>
                                    <th>Assigement Given to Semester</th>
                                    <th>Assigement Given To Semester section</th>
                                    <th>Action</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($view_homework_from_teachers as $addHomework)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $addHomework->title }}</td>
                                        <td style="word-break: break-all;">{!! $addHomework->content !!}</td>
                                        <td>{{ $addHomework->teacher_id }}</td>
                                        {{-- <td>{{ $addHomework->faculity_id}}</td> --}}
                                        <td>{{ $addHomework->classs->name }}</td>
                                        <td>{{ $addHomework->section->name }}</td>
                                        <td><a href="{{ route('admin.homework.nn', ['id' => $addHomework->id]) }}"
                                                class="btn btn-primary text-white">Submit Assignment</a></td>
                                        <td>
                                            <span
                                                class="{{ $addHomework->status == 'submitted' ? 'text-primary' : 'text-danger' }}">
                                                {{ ucfirst($addHomework->status) }}
                                            </span>
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
