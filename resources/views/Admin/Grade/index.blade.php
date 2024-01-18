@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title " style="display: flex; justify-content: space-between"> Grade <a
                            href="{{ route('admin.grade.add') }}" class="btn btn-primary">Add Grade </a></h3>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="card-body">
            <div class="table-responsive">
                <table id="clienttable" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Range</th>
                            <th>Remark</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($grades as $grade)
                            <tr>
                                 <td>{{ $i++ }}</td>
                                <td>{{ $grade->name }}</td>
                                <td>{{ $grade->mark_from . ' - ' . $grade->mark_to }}</td>
                                <td>{{ $grade->remark }}</td>
                                <td>
                                    nn
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
