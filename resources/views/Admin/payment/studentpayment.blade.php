@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <form action="{{ route('admin.payment.studentPayment') }}" method="GET">
            <div class="form-group filter mb-4"
                style="display: flex; justify-content: space-around; width: 250px; margin-top: 10px">
                <select name="class_id" id="class_id" class="form-control">
                    <option value="sssss">Select Class</option>
                    @foreach ($classes as $class)
                        <option value="" {{ empty($selectedClassId) ? 'selected' : '' }}>All Sections</option>

                        <option value="{{ $class->id }}" {{ $class->id == $selectedClassId ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-success " style="margin-left: 10px"><i
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
                            <th>ID No</th>
                            <th>Image</th>
                            <th>Section</th>
                            <th>Name</th>
                            <th>Roll No</th>
                            <th>Class</th>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th class="d-none">Created day</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $student->idno }}</td>
                                <td><img src="{{ asset($student->image) }}" alt="" width="60"></td>
                                <td>{{ $student->section }}</td>
                                <td>{{ $student->name }}</td>

                                <td>{{ $student->roll }}</td>
                                <td>{{ $student->class }}</td>

                                <td>{{ $student->number }}</td>
                                <td>
                                    @foreach ($payment_records as $payment_record)
                                        @if ($payment_record->student_id == $student->id )
                                            <strong
                                                class="btn
                                            @if ($payment_record->status === 'Pending') btn-danger
                                            @elseif ($payment_record->status === 'Half paid')
                                                btn-warning
                                            @elseif ($payment_record->status === 'Full paid' )
                                                btn-success @endif
                                        ">
                                                {{ $payment_record->status }}

                                            </strong>
                                        @endif
                                    @endforeach

                                </td>
                                <td>
                                    <form
                                        action="{{ route('admin.payment.studentPaymentAdd', ['student_id' => $student->id]) }}"
                                        method="GET" style="display:inline;">
                                        <button type="submit" class="btn btn-success">Payment</button>
                                    </form>
                                </td>


                                <td>
                                    {{ getAgo($student->created_at) }}
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
