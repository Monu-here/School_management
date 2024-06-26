@extends('Admin.layout.app')

@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Bill Payment</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.payment.studentPayment') }}">Student Payment</a>
                        </li>
                        <li class="breadcrumb-item active">Payment</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('admin.payment.studentPaymentAdd', ['student_id' => $student->id]) }}" method="POST">
            @csrf

            <p>Class ID: {{$class_id}}</p>
            {{-- <p>Section ID: {{ $section->first()->id }}</p> --}}
            <div class="invoice-title">
                <h4 class="float-end font-size-15">Invoice
                    @foreach ($payment_records as $payment_record)
                        @if ($payment_record->student_id == $student->id)

                        @endif
                        @endforeach
                        {{ $payment_records->last()->ref_no ?? 'N/A' }}
                        {{-- <span class="badge font-size-12 ms-2">
                            <strong
                            class="btn
                            @if ($payment_record->status === 'Pending') btn-danger
                            @elseif ($payment_record->status === 'Half paid') btn-warning
                            @elseif ($payment_record->status === 'Full paid') btn-success @endif">
                            {{ $payment_record->status }}
                        </strong> --}}
                     </span>

                </h4>
                <div class="mb-4">
                    @php
                        $getSettings = getSetting();
                    @endphp
                    @if ($getSettings)
                        <h3 class="mb-1 text-muted">{{ $getSettings->webistename }}</h3>
                    @endif
                </div>
                <div class="text-muted">
                    <p class="mb-1">Biratnagar-03, Morang, Nepal</p>
                    <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>school@management.com</p>
                    <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                </div>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-sm-6">
                    <div class="text-muted">
                        <h5 class="font-size-16 mb-3">Billed To:</h5>
                        <h5 class="font-size-15 mb-2">{{ $student->name }}</h5>
                        <p class="mb-1">{{ $student->address }}</p>
                        <p class="mb-1">{{ $student->email }}</p>
                        <a href="mailto: {{ $student->email }}">Send Email</a>
                        <p>{{ $student->number }}</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="text-muted text-sm-end">
                        <div>
                            <h5 class="font-size-15 mb-1">Invoice No:</h5>
                            <p>
                                {{ $payment_records->last()->ref_no ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="mt-4">
                            <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                            <p>
                                {{ $payment_records->last()->updated_at ?? 'N/A' }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            @if ($student)
                <div class="py-2">
                    <h5 class="font-size-15">Bill Summary</h5>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Student Name</th>
                                    <th>Amount of that class</th>
                                    <th>Total Class Amount</th>
                                    <th>Status</th>
                                    <th class="text-end" style="width: 120px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $j = 1; @endphp
                                <tr>
                                    <th scope="row">{{ $j++ }}</th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14 mb-1">{{ $student->name }}</h5>
                                            <p class="text-muted mb-0"></p>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($payments as $payment)
                                            Rs. {{ $payment->amount }}- {{ $payment->title }}<br>
                                        @endforeach
                                    </td>
                                    <td>Rs: {{ $totalOwed }}</td>
                                    <td>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Half paid">Half paid</option>
                                            <option value="Full paid">Full paid</option>
                                        </select>
                                    </td>

                                    <td class="text-end">
                                        {{-- @if ($payment_records->last()->balance == 0)
                                        amount paid all
                                        @endif --}}
                                        Rs. {{ $payment_records->last()->balance ?? '0' }}
                                        @if ($payment_records->sum('amt_paid') > $totalOwed)
                                            (Return Money)
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row" colspan="5" class="text-end">Amount pay</th>
                                    <td class="text-end">
                                        <input type="number" name="amt_paid" id="amt_paid" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="5" class="border-0 text-end">Year</th>
                                    <td class="border-0 text-end">
                                        <input type="text" name="year" id="year" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="5" class="border-0 text-end">Amount left</th>
                                    <td class="border-0 text-end">
                                        Rs. {{ $payment_records->last()->balance ?? '0' }}
                                        @if ($payment_records->sum('amt_paid') > $totalOwed)
                                            (Return Money)
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="5" class="border-0 text-end">Amount Paid</th>
                                    <td class="border-0 text-end">
                                        Rs. {{ $payment_records->last()->amt_paid ?? '0' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="text" name="title" id="">
                    <div class="d-print-none mt-4">
                        <div class="float-end">
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <input type="hidden" name="class_id" value="{{$class_id}}">
                            <input type="hidden" name="section_id" value="{{$section_id}}">
                            <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                            <button type="submit" class="btn btn-primary w-md">Send</button>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="clienttable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID No</th>
                        <th>Payment Id</th>
                        <th>Student Id</th>
                        <th>ref_no</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Paid</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Print Bill</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($payment_records as $payment_record)
                        @if ($payment_record->student_id == $student->id)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $payment_record->id }}</td>
                                <td>{{ $payment_record->payment_id }}</td>
                                <td>{{ $payment_record->student->name }}
                                </td>
                                <td>{{ $payment_record->ref_no }}</td>
                                <td>{{ $payment_record->amt_paid }}</td>
                                <td>{{ $payment_record->balance }}</td>
                                <td>{{ $payment_record->paid }}</td>
                                <td>{{ $payment_record->year }}</td>
                                <td>
                                    <div>

                                        <strong
                                            class="btn
                                            @if ($payment_record->status === 'Pending') btn-danger
                                            @elseif ($payment_record->status === 'Half paid')
                                                btn-warning
                                            @elseif ($payment_record->status === 'Full paid')
                                                btn-success @endif
                                        ">
                                            {{ $payment_record->status }}

                                        </strong>


                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route('admin.payment.printBill', ['student_id' => $student->id]) }}"
                                        class="btn btn-secondary" target="_blank">
                                        Print Bill
                                    </a>
                                </td>
                            </tr>
                        @endif
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
