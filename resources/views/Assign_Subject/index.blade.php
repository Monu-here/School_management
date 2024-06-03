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
                            <form action="{{ route('admin.teacher.assign_subject_add') }}" method="POST"
                                enctype="multipart/form-data" id="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="subject[]" id="new" class="form-control">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-success" id="addUser">AddSubJect
                                        </button>
                                    </div>
                                </div>
                                <div class="col-3" id="selectedSubListContainer">
                                    <label for="">Selected Subjects</label>
                                    <ul id="selectedSubList"></ul>
                                </div>
                                <input type="hidden" name="subject" id="hiddenSub" value="">
                                <div class="col-md-6">
                                    <label for="date">Teacher</label>
                                    <select name="user_id" id="" class="form-control">
                                        @foreach ($users as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <br>
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
                                <h3 class="page-title">Subject</h3>
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
                                        <td>{{ $assign->user->name }}</td>
                                        <td>{{ $assign->subject }}</td>
                                        <td>
                                            <a href="{{ route('admin.teacher.assign_subject_del', ['id'=> $assign->id]) }}"> <button class="btn btn-danger">del</button></a>
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
                var cleanString = JSON.parse(JSON.stringify(selectedSubjects)).join(',');
                cleanString = cleanString.replace(/["'\\]/g,
                    ''); // Remove double quotes, single quotes, and backslashes
                $('#hiddenSub').val(cleanString);
            }
        });
    </script>
@endsection
