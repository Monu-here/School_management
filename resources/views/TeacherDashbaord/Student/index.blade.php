@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">

                    <h3 class="page-title " style="display: flex; justify-content: space-between;  margin-left: 25px"> Student
                        <a href="{{ route('admin.student.add') }}" class="btn btn-primary">Add Student </a>
                    </h3>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.student.index') }}" method="GET">
            <div class="row">
                <div class="col-md-8">
                    <div class="col-3">
                        <div class="form-group filter mb-4">
                            <input type="text" name="name" class="form-control" placeholder="Student Search"
                                value="{{ $selectedName }}">
                        </div>
                    </div>
                    <div class="col-3">
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
                    <div class="mt-4">
                         <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                     </div>
                </div>

            </div>






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
                        <th>Marksheet</th>
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
                            <td>
                                @php
                                    $sectionName = $sections
                                        ->where('id', $student->section_id)
                                        ->pluck('name')
                                        ->first();
                                @endphp
                                {{ $sectionName ?? 'N/A' }}
                            </td>
                            <td>{{ $student->name }}</td>

                            <td>
                                <a href="{{ route('admin.student.studentShow', ['student' => $student->id]) }}"
                                    class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.student.del', ['student' => $student->id]) }}"
                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.mark.admin.marksheet', $student->id) }}"
                                            class="btn btn-primary">Show
                                            Marksheet</a>
                                    </div>
                                    <div class="col-md-6">
                                        <form
                                            action="{{ route('admin.mark.admin.mark.email', ['sendMail' => $student->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Send Marksheet to
                                                Parent</button>
                                        </form>
                                    </div>
                                </div>
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
