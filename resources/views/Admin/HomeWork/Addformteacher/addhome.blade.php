@extends('Admin.layout.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Homework</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Homework</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
                                    <th>SN</th>
                                    <th>  Title</th>
                                    <th>  Content</th>
                                    <th> Given By</th>
                                    <th> Given to Semester</th>
                                    <th> Given To Semester section</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($views as $view)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $view->title }}</td>
                                        <td style="word-break: break-all;">{!! $view->content !!}</td>
                                        <td>{{ $view->teacher_id }}</td>
                                        <td>{{ $view->classs ? $view->classs->name : 'N/A' }}</td>
                                        <td>{{ $view->section ? $view->section->name : 'N/A' }}</td>
                                        <td><span
                                                class="{{ $view->status == 'submitted' ? 'text-primary' : 'text-danger' }}">
                                                {{ ucfirst($view->status) }}
                                            </span></td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.homework.addHomework') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="teacher_id" value="{{ Auth::user()->name }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="titile">Homework Title</label>
                                                <input type="text" name="title" class="form-control">
                                            </div>


                                            <div class="col-md-6">
                                                <label for="techer">Assigement Given to Faculity</label>
                                                <select name="faculity_id" id="faculity_id" class="form-control" required>
                                                    <option value="">Select Faculity</option>
                                                    @foreach ($assignedFaculityIds as $faculityId)
                                                        @php
                                                            $faculity = App\Models\Faculity::find($faculityId);
                                                        @endphp
                                                        <option value="{{ $faculityId }}"
                                                            {{ isset($faculity_id) ? ($faculity_id == $faculityId ? 'selected' : '') : (request('faculity_id') == $faculityId ? 'selected' : '') }}>
                                                            {{ $faculity ? $faculity->name : 'Class Name Not Found' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="techer">Assigement Given to Semester</label>
                                                <select name="class_id" id="class_id" class="form-control" required>
                                                    <option value="">Select Semester</option>
                                                    @foreach ($assignedClassIds as $classId)
                                                        @php
                                                            $class = App\Models\Classs::find($classId);
                                                        @endphp
                                                        <option value="{{ $classId }}"
                                                            {{ isset($class_id) ? ($class_id == $classId ? 'selected' : '') : (request('class_id') == $classId ? 'selected' : '') }}>
                                                            {{ $class ? $class->name : 'Class Name Not Found' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="techer">Assigement Given To Class's section</label>
                                                <select name="section_id" id="section_id" class="form-control" required>
                                                    <option value="">Select Section</option>
                                                    @foreach ($assignedSectionIds as $sectionId)
                                                        @php
                                                            $section = App\Models\Section::find($sectionId);
                                                        @endphp
                                                        <option value="{{ $sectionId }}"
                                                            {{ isset($section_id) ? ($section_id == $sectionId ? 'selected' : '') : (request('section_id') == $sectionId ? 'selected' : '') }}>
                                                            {{ $section ? $section->name : ' Section Not found' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="label">Homework Content</label>
                                                <textarea id="summernote" cols="" rows="10" name="content" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary"> Submit</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
