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
                            <th>Action</th>
                            <th class="d-none">Created day</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td><img src="{{ asset($user->image) }}" alt="" width="60"></td>

                                {{-- <td><img src="{{ asset($user->image) }}" alt=""></td> --}}
                                <td>{{ $user->name }}</td>
                                <td> {{ $user->email }}</td>
                                <td> {{ $user->role_name }}</td>
                                <td>
                                     <a href="{{ route('admin.user.show', ['userId' => $user->id]) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                     {{-- <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a> --}}
                                     <a href="{{ route('admin.user.del', ['user' => $user->id]) }}"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <td>
                                    {{ getAgo($user->created_at) }}
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

            // function showModal() {
            //     $('#openmodel').modal('show');
            // }
        </script>
    @endsection
