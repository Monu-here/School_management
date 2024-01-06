@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">


                    <h3 class="page-title " style="display: flex; justify-content: space-between"> Department <button
                            type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#opendep">
                            Add Department
                        </button>
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
                            <th>Name Of Department</th>
                            <th>Head Of Department</th>
                            <th>Department Start Date</th>
                            <th>No. Of Student</th>
                            <th class="d-none">Created day</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($deps as $dep)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $dep->name }}</td>
                                <td>{{ $dep->hod }}</td>
                                <td>{{ $dep->date }}</td>
                                <td>{{ $dep->nofst }}</td>
                                <td>
                                    {{ getAgo($dep->created_at) }}

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
