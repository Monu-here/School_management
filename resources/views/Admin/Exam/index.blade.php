@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title " style="display: flex; justify-content: space-between"> Student <a
                            href="{{ route('admin.student.add') }}" class="btn btn-primary">Add Student </a></h3>
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
                            <th>Name</th>
                            <th>Term</th>
                            <th>Year</th>
                            <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($exams as $exam)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $exam->name }}</td>
                                 <td>{{ $exam->term }}</td>
                                <td>{{ $exam->year }}</td>
                                <td>
                                    xxx
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
