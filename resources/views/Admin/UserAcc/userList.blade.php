@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title " style="display: flex; justify-content: space-between">User Account <a
                            href="{{ route('admin.user.add') }}" class="btn btn-primary">Add User </a></h3>
                </div>
            </div>
        </div>
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
                            <th>Email</th>
                            <th>Role</th>
                             <th class="d-none">Created day</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($user->where('role_name', 'Teacher') as $teacher)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    <img src="{{asset($teacher->image)}}" alt="" width="50">
                                </td>
                                <td>
                                    {{ $teacher->name }}
                                </td>
                                <td>
                                    {{ $teacher->email }}
                                </td>
                                <td>
                                    {{ $teacher->role_name }}
                                </td>
                                <td>
                                    {{ getAgo($teacher->created_at) }}
                                </td>
                            </tr>
                            <span class="badge badge-pill badge-success">{{ $teacher->name }}</span>
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

            // function showModal() {
            //     $('#openmodel').modal('show');
            // }
        </script>
    @endsection
