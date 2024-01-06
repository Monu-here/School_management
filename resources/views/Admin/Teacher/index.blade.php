@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">


                    <h3 class="page-title " style="display: flex; justify-content: space-between"> Teacher <button
                            type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#openmodel">
                            Add Teacher
                        </button>
                </div>
            </div>
        </div>
        <!-- Add this inside your form -->
        <form action="{{ route('admin.student.teacherIndex') }}" method="GET">
            <div class="form-group filter mb-4"
                style="display: flex; justify-content: space-around; width: 250px; margin-top: 10px">
                <input type="text" name="name" class="form-control" placeholder="Enter Teacher Name"
                    value="{{ $selectedName }}">
 
                <button type="submit" class="btn btn-success" style="margin-left: 10px"><i
                        class="fa-solid fa-filter"></i></button>
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
                            <th>Image</th>

                            <th>Name</th>
                            {{-- <th>Gender</th>
                            <th>Number</th>
                            <th>Address</th> --}}
                            <th>
                                Action
                            </th>
                            <th class="d-none">Created day</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><img src="{{ asset($teacher->image) }}" alt="" width="60"></td>
                                <td>{{ $teacher->name }}</td>
                                {{-- <td>{{ $teacher->gender }}</td>
                                <td>{{ $teacher->number }}</td>
                                <td>{{ $teacher->address }}</td> --}}

                                <td>
                                    <a href="{{ route('admin.student.teacherShow', ['teacher' => $teacher->id]) }}"
                                        class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a>
                                    <a href="" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                <td>
                                    {{ getAgo($teacher->created_at) }}

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
