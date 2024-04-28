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
                        <li class="breadcrumb-item active">List</li>
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
                                {{-- <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                        class="feather-list"></i></a>
                                <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                        class="feather-grid"></i></a>
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                    Download</a> --}}
                                <abbr title="Submit Homework"> <a href="{{ route('admin.homework.submit') }}"
                                        class="btn btn-primary"><i class="fas fa-plus"></i></a></abbr>
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
                                    <th>Submit To</th>
                                    <th>Content</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($homeworks as $homework)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>
                                        {{-- <td>{{ $homework->idno }}</td> --}}
                                        <td>hey</td>
                                        <td>
                                            {{ $homework->title }}
                                        </td>
                                        <td>
                                            {{ $homework->teacher->name }}

                                        </td>
                                        <td>

                                            <div class="con">
                                                {!! $homework->content !!}
                                            </div>

                                        </td>

                                        <td>
                                            <a href="{{ route('admin.homework.show', ['viewId' => $homework->id]) }}"
                                                class="btn btn-primary">Show</a>
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
