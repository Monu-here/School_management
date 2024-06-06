 
@extends('Admin.layout.app')

@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Notice</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Notice</a></li>
                        <li class="breadcrumb-item active">All Notice</li>
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
                             </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{ route('admin.notice.add') }}" class="btn btn-primary"><i
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
                                        SN
                                    </th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Publish On</th>
                                    <th>Notice Date</th>
                                     <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($notices as $notice)
                                    <tr>
                                        <td>
                                            {{ $i++ }}
                                        </td>
                                        <td> {{ $notice->notice_title }}</td>
                                        <td>
                                            {!! $notice->notice_message !!} </td>
                                        <td>
                                            {{ $notice->publish_on }}


                                        </td>
                                        <td>
                                            {{ $notice->notice_date }}

                                        </td>


                                        {{-- <td> {{ $notice->user->name }}</td> --}}

                                        <td>
                                            <a href="{{ route('admin.notice.edit', ['notice' => $notice->id]) }}"
                                                class="btn btn-primary btn-sm text-white">Edit</a>
                                            <a href="{{ route('admin.notice.del', ['notice' => $notice->id]) }}"
                                                class="btn btn-danger btn-sm text-white">Del</a>
                                        </td>
                                        {{-- <td> {{ getAgo($student->created_at) }}
                                            </td> --}}

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
