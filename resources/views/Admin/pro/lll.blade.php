@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students Promotion</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.promotion.list')}}">Student</a></li>
                        <li class="breadcrumb-item active">All Students Promotion</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .content {
            padding: 1.25rem 1.25rem;
            flex-grow: 1;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Select Student Promotion From Class
                </h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.promotion.index') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 col-sm-6">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="from_class" style="font-weight: 700; font-size: 12px">From
                                                Class:</label>
                                            <select name="from_class" id="from_class" class="form-control">
                                                @foreach ($cc as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="from_section" style="font-weight: 700; font-size: 12px">From
                                                Section:</label>
                                            <select name="from_section" id="from_section" class="form-control">
                                                @foreach ($se as $sec)
                                                    <option value="{{ $sec->id }}">{{ $sec->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <div class="text-right mt-1">
                                            <button type="submit" class="btn btn-primary">Manage Promotion</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-2 col-sm-6 mt-4">
                            {{-- <div class="text-right mt-1">
                                <button type="submit" class="btn btn-primary">Manage Promotion</button>
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Student Promotion List
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($students)
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttable">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input d-block " type="checkbox" value="something" />
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Current Class</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($students as $student)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input d-block " type="checkbox"
                                                    value="something" />
                                            </div>
                                        </td>
                                        <td>{{ $i++ }}</td>
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
                                            {{ $student->classes->name }} /
                                            ({{ $sectionName }})
                                        </td>
                                        <td>
                                            <button type="button" onclick="openPromoteForm({{ $student->id }})"
                                                class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Promote</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Student Promotion To Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="promoteForm" style="display: none;">
                        <form method="post" action="{{ route('admin.promotion.p') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 ">
                                    <fieldset>

                                        <div class="form-group">
                                            <input type="hidden" name="student_id" id="student_id">
                                            <label for="to_class">To Class:</label>
                                            <select name="to_class" id="to_class" class="form-control">
                                                @foreach ($cc as $class)
                                                    <option value="{{ $class->id }}">
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="to_section">To Section:</label>
                                            <select name="to_section" id="to_section" class="form-control">
                                                @foreach ($se as $sec)
                                                    <option value="{{ $sec->id }}">
                                                        {{ $sec->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="promotion_status">Promotion Status:</label>
                                            <select name="status" id="promotion_status" class="form-control">
                                                <option value="promote">Promote</option>
                                                <option value="not_promote">Not Promote</option>
                                            </select>


                                    </fieldset>
                                </div>
                                <div class="text-right mt-1">
                                    <button type="submit" class="btn btn-primary  ">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('js')
    <script>
        function openPromoteForm(studentId) {
            document.getElementById('student_id').value = studentId;
            document.getElementById('promoteForm').style.display = 'block';
        }
    </script>
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
