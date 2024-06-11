@extends('Admin.layout.app')

@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Assign</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Subject</a></li>
                        <li class="breadcrumb-item active">All Subject</li>
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
                    <h4 class="ms-4">Assign Subject</h4>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form id="assignSubjectForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="faculity_id" id="faculity_id" class="form-control">
                                            <option value="" selected>select</option>
                                            @foreach ($faculitys as $faculity)
                                                <option value="{{ $faculity->id }}">{{ $faculity->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="semester_id" id="semester_id" class="form-control">
                                            <option value="" selected>select</option>
                                            @foreach ($semesters as $semester)
                                                <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <form action="{{ route('admin.teacher.assign_subject_add') }}" method="POST"
                                enctype="multipart/form-data" id="">
                                @csrf
                                <input type="hidden" name="faculity_id" id="hidden_faculity_id" value="">
                                <input type="hidden" name="semester_id" id="hidden_semester_id" value="">
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <label for="date">Teacher</label>
                                        <select name="user_id" id="" class="form-control">
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($subjects)
                                            <label for="Subject">Subject</label>
                                            <select name="subject[]" id="new" class="form-control">
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            <button type="button" class="btn btn-primary mt-2  " id="addUser">Add Subject
                                            </button>
                                        <input type="text" name="subject" id="hiddenSub" value="">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="" id="selectedSubListContainer">
                                            <label for="">Selected Subjects</label>
                                            <ul id="selectedSubList"></ul>
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary">Submit</button>
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
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">


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
                                    <th>SN</th>

                                    <th>Teacher Name</th>
                                    <th>Subject Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($assigns as $assign)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $assign->teacher->name }}</td>
                                        <td>{!! $assign->subject !!}</td>
                                        <td>
                                            <a
                                                href="{{ route('admin.teacher.assign_subject_del', ['id' => $assign->id]) }}">
                                                <button class="btn btn-danger">del</button></a>
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
        $(document).ready(function() {
            $('#faculity_id, #semester_id').change(function() {
                var faculity_id = $('#faculity_id').val();
                var semester_id = $('#semester_id').val();

                if (faculity_id && semester_id) {
                    $.ajax({
                        url: '{{ route('admin.teacher.assign_subject') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            faculity_id: faculity_id,
                            semester_id: semester_id
                        },
                        success: function(response) {
                            var subjects = response.subjects;
                            $('#new').empty();
                            if (subjects.length > 0) {
                                subjects.forEach(function(subject) {
                                    $('#new').append('<option value="' + subject.name +'">' + subject.name + '</option>');
                                });
                            }
                             else {
                                $('#new').append(
                                    '<option value="">No subjects available</option>');
                            }
                            $('#hidden_faculity_id').val(faculity_id);
                            $('#hidden_semester_id').val(semester_id);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });

            var selectedSubjects = [];

            $('#addUser').on('click', function() {
                var selectedValue = $('#new option:selected').val();
                if (selectedValue && !selectedSubjects.includes(selectedValue)) {
                    selectedSubjects.push(selectedValue);
                    updateSelectedSubjectsList();
                } else {
                    alert('This subject is already selected.');
                }
            });

            function updateSelectedSubjectsList() {
                $('#selectedSubList').empty();
                selectedSubjects.forEach(function(subject) {
                    $('#selectedSubList').append('<li>' + subject + '</li>');
                });

                // Update hidden input field with the array of subjects
                var cleanString = JSON.stringify(selectedSubjects).replace(/["'\\]/g, '');
                $('#hiddenSub').val(cleanString);
            }
        });
    </script>
@endsection
