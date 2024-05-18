@extends('Admin.layout.app')

@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Student</a></li>
                        <li class="breadcrumb-item active">All Students</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.reg.regSub') }}" method="POST" enctype="multipart/form-data"
                                id="">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="user_id" id="name" class="form-control"
                                        value="{{ Auth::user()->id }}">

                                    <div class="col-md-5">
                                        <label for="student_code">Symbool No / Roll No / Student Code</label>
                                        <input type="text" name="student_code" id="student_code" class="form-control">
                                    </div>

                                    <div class="col-md-5">
                                        <label for="date">Subject</label>
                                        <select name="subject[]" id="new" class="form-control">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <button type="button" class="btn btn-success" id="addUser">Add
                                            SubJect
                                        </button>
                                        <button class="btn btn-primary">Submit</button>
                                    </div>


                                </div>

                                <label for="">Selected Subjects</label>
                                <ul id="selectedSubList"></ul>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Students</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                        class="feather-list"></i></a>
                                <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                        class="feather-grid"></i></a>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="fas fa-plus"></i></a>
                                </button>
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
                                    <th>Student Name</th>
                                    <th>Student Roll no / Symbool No / Student code</th>
                                    <th>Regester Subject</th>

                                    <th class="text-end ">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($subject_regs as $subject_reg)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            nn
                                            {{-- <h2 class="table-avatar">
                                                <a href="" class="avatar avatar-sm me-2"><img
                                                        class="avatar-img rounded-circle" src="{{ asset($student->image) }}"
                                                        alt="User Image" /></a>
                                                <a href="">{{ $student->name }}</a>
                                            </h2> --}}
                                        </td>
                                        <td>
                                            {{ $subject_reg->student_code }}

                                        </td>
                                        <td>
                                            {{ $subject_reg->subject }}
                                        </td>




                                        <td>
                                            <span
                                                class="{{ $subject_reg->status == 'Verified' ? 'text-primary' : 'text-danger' }}">
                                                {{ ucfirst($subject_reg->status) }}
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
    <script>
        // $(document).ready(function() {
        //     $('.photo').dropify();
        // });

        $(document).ready(function() {
            $('#addUser').on('click', function() {
                var selectedValue = $('#new option:selected').val();
                if (selectedValue) {
                    $('#selectedSubList').append('<li>' + selectedValue + '</li>');
                }
            });
        });
        $(document).ready(function() {
            var selectedSubjects = [];

            $('#addUser').on('click', function() {
                var selectedValue = $('#new option:selected').val();
                if (selectedValue) {
                    selectedSubjects.push(selectedValue);
                    updateSelectedSubjectsList();
                }
            });

            function updateSelectedSubjectsList() {
                $('#selectedSubList').empty();
                selectedSubjects.forEach(function(subject) {
                    $('#selectedSubList').append('<li>' + subject + '</li>');
                });

                // Update hidden input field with the array of subjects
                var cleanString = JSON.parse(JSON.stringify(selectedSubjects)).join(',');
                cleanString = cleanString.replace(/["'\\]/g,
                    ''); // Remove double quotes, single quotes, and backslashes
                $('#hiddenSub').val(cleanString);
            }
        });
    </script>
@endsection
