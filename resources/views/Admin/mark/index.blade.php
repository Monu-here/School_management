<!-- resources/views/marks/index.blade.php -->

@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Mark</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Mark</a></li>
                        <li class="breadcrumb-item active">All Marks</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    {{-- <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                             </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{ route('admin.mark.add') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttable">
                            <thead class="student-thread">
                                <tr>
                                    <th>SN</th>
                                    <th>Exam</th>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>Mark Obtained</th>
                                    <th>Practical Obtained</th>
                                    <th>Total Mark</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marks as $mark)
                                    <tr>
                                        <td>{{ $mark->exam->name }}</td>
                                        <td>{{ $mark->student->name ?? '' }}</td>
                                        <td>{{ $mark->subject->name }}</td>
                                        <td>{{ $mark->obtained_marks }}</td>
                                        <td>{{ $mark->practical_marks }}</td>
                                        <td>{{ $mark->total_marks }}</td>
                                        <td>{{ $mark->grade }}</td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <form action="{{ route('admin.mark.index') }}" method="GET">

        <div class="student-group-form">

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" name="exam_type" class="form-control" placeholder="Serach with  &quot; exam_type  &quot;"
                            value="">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{ route('admin.mark.add') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttable">
                            <thead class="student-thread">
                                <tr>
                                    <th>SN</th>
                                    <th>Exam</th>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>CR</th>
                                    <th>Exam Type</th>
                                    {{-- <th>Total Mark</th> --}}
                                 </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                  @foreach ($examTypes as $mark)
                                  <tr>
                                      <td>{{ $i++ }}</td>
                                      <td>{{ $mark->exam->name }}</td>
                                      <td>{{ $mark->student->name ?? '' }} /
                                          {{ $mark->student->faculity->name ?? '' }} /
                                          {{ $mark->student->classes->name ?? '' }} </td>
                                      <td>{{ $mark->subject->name }}</td>
                                      <td>{{ $mark->obtained_marks }}</td>
                                      <td>{{ $mark->exam_type ?? '' }}  {{ $mark->resit }}</td>
                                      {{-- <td>{{ $mark->total_marks }}</td> --}}

                                  </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!$examTypes)
    @else
       
    @endif

@endsection
@section('js')
    <script>
        $(function() {
            $('#clienttable').DataTable({
                "responsive": true,

                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
