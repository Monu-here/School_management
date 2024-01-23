@extends('Admin.layout.app')
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
                        <table id="clienttable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Image</th>
                                    <th>Student Name</th>
                                    <th>Current Class</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($students as $student)
                                    @php
                                        $i = 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <img src="{{ asset($student->image) }}" alt="" srcset=""
                                                width="50">
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>

                                            @php
                                            $sectionName = $sections
                                            ->where('id', $student->section_id)
                                            ->pluck('name')
                                            ->first();
                                            @endphp
                                        {{ $student->classes->name }}
                                       ( {{$sectionName}})
                                        </td>
                                        <td>
                                            <button type="button" onclick="openPromoteForm({{ $student->id }})"
                                                class="btn btn-success">Promote</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                </div>

                @if ($students)
                    <table>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->classes->name }}</td>
                                    <td>
                                        <button type="button"
                                            onclick="openPromoteForm({{ $student->id }})">Promote</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Select Student Promotion To Class
                </h5>
            </div>
            <div class="card-body">
                <div id="promoteForm" style="display: none;">
                    <form method="post" action="{{ route('admin.promotion.p') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-10 col-sm-6">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="student_id" id="student_id">
                                                <label for="to_class">To Class:</label>
                                                <select name="to_class" id="to_class" class="form-control">
                                                    @foreach ($cc as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="to_section">To Section:</label>
                                                <select name="to_section" id="to_section" class="form-control">
                                                    @foreach ($se as $sec)
                                                        <option value="{{ $sec->id }}" >{{ $sec->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="promotion_status">Promotion Status:</label>
                                                <select name="status" id="promotion_status" class="form-control">
                                                    <option value="promote">Promote</option>
                                                    <option value="not_promote">Not Promote</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-2 mt-4">
                                <div class="text-right mt-1">
                                    <button type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Promote Form -->
    {{-- <div id="promoteForm" style="display: none;">
        <form method="post" action="{{ route('admin.promotion.p') }}">
            @csrf
            <input type="hidden" name="student_id" id="student_id">

            <label for="to_class">To Class:</label>
            <select name="to_class" id="to_class" class="form-control">
                @foreach ($cc as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>


            <label for="to_section">To Section:</label>
            <select name="to_section" id="to_section" class="form-control">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>

            <label for="promotion_status">Promotion Status:</label>
            <select name="status" id="promotion_status" class="form-control">
                <option value="promote">Promote</option>
                <option value="not_promote">Not Promote</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div> --}}

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
