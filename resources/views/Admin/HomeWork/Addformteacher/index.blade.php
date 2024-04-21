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
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something" />
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Given By</th>
                                    <th>Content</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addHomeworks as $addHomework)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>
                                        {{-- <td>{{ $addHomework->idno }}</td> --}}
                                        <td>hey</td>
                                        <td>
                                            {{ $addHomework->title }}
                                        </td>
                                        <td>
                                            {{ $addHomework->teacher->name }}

                                        </td>
                                        <td >

                                            <div class="con">
                                                {!! $addHomework->content !!}
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
