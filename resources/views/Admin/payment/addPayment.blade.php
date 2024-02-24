@extends('Admin.layout.app')
@section('title')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col ms-4">
                    <h3 class="page-title">Payment</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Payment</a></li>
                        <li class="breadcrumb-item active">Add Payment</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('admin.payment.add') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Title <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="title" value="" type="text" class="form-control"
                                            placeholder="Eg. School Fees">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="class_id" class="col-lg-3 col-form-label font-weight-semibold">Class
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control select-search" name="class_id" id="my_class_id">
                                            <option value="">All Classes</option>
                                            @foreach ($classes as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Year <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="date" name="year" id="" class="form-control">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-lg-3 col-form-label font-weight-semibold">Amount
                                        (<span>रु</span>) <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input class="form-control" value="{{ old('amount') }}" required name="amount"
                                            id="amount" type="number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description"
                                        class="col-lg-3 col-form-label font-weight-semibold">Description
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input class="form-control" value="{{ old('description') }}" name="description"
                                            id="description" type="text" placeholder="Enter Description">
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save<i
                                            class="icon-paperplane ml-2"></i></button>
                                    <a href="#" class="btn btn-danger">Cancle<i class="icon-paperplane ml-2"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            {{-- <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Students</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-list"></i></a>
                                    <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                            class="feather-grid"></i></a>
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                    <a href="{{route('admin.student.add')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div> --}}

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                                    id="clienttable">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something" />
                                                </div>
                                            </th>
                                            <th>SN</th>
                                            <th>Payemnt Title</th>
                                            <th>Amount</th>
                                            <th>Class</th>
                                            <th>Description</th>
                                            <th>Year</th>
                                            <th>Ref No</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>
                                                    <div class="form-check check-tables">
                                                        <input class="form-check-input" type="checkbox" value="something" />
                                                    </div>
                                                </td>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        {{ $payment->title }}
                                                    </h2>
                                                </td>
                                                <td>
                                                    {{ $payment->amount }}

                                                </td>
                                                <td>
                                                    @php
                                                        $className = $classes
                                                            ->where('id', $payment->class_id)
                                                            ->pluck('name')
                                                            ->first();
                                                    @endphp
                                                    {{ $className ?? 'N/A' }}
                                                </td>


                                                <td>{{ $payment->description }}</td>
                                                <td>{{ $payment->year }}</td>
                                                <td>{{ $payment->ref_no }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
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
