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
                <select name="section" id="section" class="form-control">
                    <option value="" {{ empty($selectedSection) ? 'selected' : '' }}>All Sections</option>
                    <option value="A" {{ $selectedSection == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $selectedSection == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $selectedSection == 'C' ? 'selected' : '' }}>C</option>
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
                            <th>Gender</th>
                            <th>Date Of Birth</th>
                            <th>Roll No</th>
                            <th>Class</th>
                            <th>Email</th>
                            <th>Number</th>
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
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->dob }}</td>
                                <td>{{ $student->roll }}</td>
                                <td>{{ $student->class }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->number }}</td>
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
