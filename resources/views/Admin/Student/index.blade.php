@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title " style="display: flex; justify-content: space-between"> Student <a
                            href="{{ route('admin.student.add') }}" class="btn btn-primary">Add Student </a></h3>
                </div>
            </div>
        </div>
        <form action="{{ route('admin.student.index') }}" method="GET">
            <div class="form-group filter mb-4"
                style="display: flex; justify-content: space-around; width: 250px; margin-top: 10px">
                <select name="section_id" id="section_id" class="form-control">

                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach

                </select>
                <button type="submit" class="btn btn-success " style="margin-left: 10px"><i
                        class="fa-solid fa-filter"></i></button>
            </div>
        </form>
    @endsection
    @section('content')
        <div class="card-body">
            <div class="table-responsive">
                <table id="clienttable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID No</th>
                            <th>Image</th>
                            <th>Section</th>
                            <th>Name</th>

                            <th>Action</th>
                            <th>jhgh</th>
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

                                <td>
                                    <a href="{{ route('admin.student.studentShow', ['student' => $student->id]) }}"
                                        class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                </td>
                                <td><a href="{{ route('admin.mark.admin.marksheet', $student->id) }}" class="btn btn-primary">Show Marksheet</a></td>
                                <td>
                                    {{ getAgo($student->created_at) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
