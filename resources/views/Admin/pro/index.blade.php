@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students Promotion</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Student</a></li>
                        <li class="breadcrumb-item active">All Students Promotion</li>
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
                                 
                                <a href="{{ route('admin.promotion.index') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
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
                                            <input class="form-check-input d-block " type="checkbox" value="something" />
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>From Class</th>
                                    <th>To Class</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($pros as $pro)
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
                                                @if ($pro->student)
                                                    <a href="" class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle"
                                                            src="{{ asset($pro->student->image) }}" alt="User Image" /></a>
                                                    {{ $pro->student->name }}
                                                @else
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png"
                                                        alt="" width="60">
                                                @endif
                                            </h2>
                                        </td>
                                        <td>
                                            @if ($pro->fromClass)
                                                {{ $pro->fromClass->name }}
                                            @endif
                                            @if ($pro->fromSection)
                                                ({{ $pro->fromSection->name }})
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pro->toClass)
                                                {{ $pro->toClass->name }}
                                            @endif
                                            @if ($pro->toSection)
                                                ({{ $pro->toSection->name }})
                                            @endif
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
@endsection
