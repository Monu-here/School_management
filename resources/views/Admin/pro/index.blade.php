@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">


                    <h3 class="page-title " style="display: flex; justify-content: space-between"> Student Promotion <a
                            href="{{ route('admin.promotion.index') }}" class="btn btn-primary">
                            Manage
                            Promotion
                        </a>
                </div>
            </div>
        </div>
        <!-- Add this inside your form -->
    @endsection
    @section('content')
        <div class="card-body">
            <div class="table-responsive">
                <table id="clienttable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Image</th>
                            <th>Student Name</th>
                            <th>From Class</th>
                            <th>To Class</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pros as $pro)
                            <tr>
                                @php $i = 1; @endphp
                                <td>{{ $i++ }}</td>
                                <td>
                                    @if ($pro->student)
                                        {{-- Check if the student relationship exists --}}
                                        <img src="{{ asset($pro->student->image) }}" alt="Student Image" width="50">
                                    @else
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png"
                                            alt="" width="60">
                                    @endif
                                </td>
                                <td>
                                    @if ($pro->student)
                                        {{-- Check if the student relationship exists --}}
                                        {{ $pro->student->name }}
                                    @else
                                        No Name
                                    @endif
                                </td>
                                <td>
                                    @if ($pro->fromClass)
                                        {{ $pro->fromClass->name }} ({{ $pro->from_section }})
                                    @else
                                        No class
                                    @endif
                                </td>
                                <td>
                                    @if ($pro->toClass)
                                        {{ $pro->toClass->name }} ({{ $pro->to_section }})
                                    @else
                                        No class
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong
                                            style="color:
                                            @if ($pro->status === 'promote') green;
                                            @elseif ($pro->status === 'not_promote') red; @endif">
                                            {{ $pro->status }}
                                        </strong>
                                    </div>

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
