@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students Promotion</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.promotion.list') }}">Student</a></li>
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
    <div class="">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Select Student Promotion From Class</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.promotion.index') }}" id="formSubmit">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 col-sm-6">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="from_faculity" style="font-weight: 700; font-size: 12px">Choose Faculty:</label>
                                            <select name="from_faculity" id="from_faculity" class="form-control">
                                                <option value="" selected disabled>Select Faculty</option>
                                                @foreach ($facu as $f)
                                                    <option value="{{ $f->id }}" {{ request('from_faculity') == $f->id ? 'selected' : '' }}>{{ $f->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="from_class" style="font-weight: 700; font-size: 12px">Choose Semester:</label>
                                            <select name="from_class" id="from_class" class="form-control">
                                                <option value="" selected disabled>Select Semester</option>
                                                @foreach ($cc as $class)
                                                    <option value="{{ $class->id }}" {{ request('from_class') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="from_section" style="font-weight: 700; font-size: 12px">Choose Section:</label>
                                            <select name="from_section" id="from_section" class="form-control">
                                                <option value="" selected disabled>Select Section</option>
                                                @foreach ($se as $sec)
                                                    <option value="{{ $sec->id }}" {{ request('from_section') == $sec->id ? 'selected' : '' }}>{{ $sec->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <div class="text-right mt-1">
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Manage Promotion</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Student Promotion List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (!Empty($students))
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped" id="clienttable">
                            <thead class="student-thread">
                                <tr>
                                    <th>SN</th>
                                    <th class="d-flex justify-content-center "><input type="checkbox" class="d-block me-3" id="selectAll" /> Select All</th>
                                    <th>Student Name</th>
                                    <th>Current Faculty</th>
                                    <th>Current Semester</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><input type="checkbox" class="student-checkbox d-flex justify-content-between"  value="{{ $student->id }}"></td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{ asset($student->image) }}" alt="User Image" /></a>
                                                <a href="">{{ $student->name }}</a>
                                            </h2>
                                        </td>
                                        <td>{{ $student->faculity->name }}</td>
                                        <td>
                                            {{ $student->classes->name }} /
                                            ({{ $sections->where('id', $student->section_id)->pluck('name')->first() }})
                                        </td>
                                        <td>
                                            <button type="button" onclick="openPromoteForm([{{ $student->id }}])" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Promote</button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        <button type="button" class="btn btn-primary" onclick="promoteSelectedStudents()" data-bs-toggle="modal" data-bs-target="#exampleModal">Promote All</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <tr>
                            <td colspan="6">No Student Found</td>
                        </tr>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Promotion Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Student Promotion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="promoteForm" style="display: none;">
                        <form method="post" action="{{ route('admin.promotion.p') }}">
                            @csrf
                            <input type="hidden" name="student_ids" id="student_ids">
                            <div class="form-group">
                                <label for="to_class">Choose Semester:</label>
                                <select name="to_class" id="to_class" class="form-control">
                                    @foreach ($cc as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="to_section">Choose Section:</label>
                                <select name="to_section" id="to_section" class="form-control">
                                    @foreach ($se as $sec)
                                        <option value="{{ $sec->id }}">{{ $sec->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-right mt-1">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.student-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        function openPromoteForm(studentIds) {
            document.getElementById('student_ids').value = studentIds.join(',');
            document.getElementById('promoteForm').style.display = 'block';
        }

        function promoteSelectedStudents() {
            const selectedIds = Array.from(document.querySelectorAll('.student-checkbox:checked')).map(cb => cb.value);
            if (selectedIds.length > 0) {
                openPromoteForm(selectedIds);
            } else {
                alert('Please select at least one student.');
            }
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

        document.getElementById('formSubmit').addEventListener('submit', function(event) {
            event.preventDefault();
            var saveBtn = document.getElementById('saveBtn');
            saveBtn.disabled = true;
            saveBtn.innerHTML = 'Please wait...';
            setTimeout(function() {
                event.target.submit();
            }, 2000);
        });
    </script>
@endsection
