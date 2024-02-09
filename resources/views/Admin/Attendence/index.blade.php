@extends('Admin.layout.app')

@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col ms-4">
                    <h3 class="page-title">Attendence</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Add Attendence</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .content {
            padding: 1.25rem 1.25rem;
            flex-grow: 1;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Select Class And Section From Attendence</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.atten.index') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 col-sm-6">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="class_id" style="font-weight: 700; font-size: 12px">
                                            Class:</label>
                                        <select name="class_id" id="class_id" class="form-control">
                                            @foreach ($cc as $class)
                                                <option value="{{ $class->id }} ">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="section_id" style="font-weight: 700; font-size: 12px">
                                            Section:</label>
                                        <select name="section_id" id="section_id" class="form-control">
                                            @foreach ($se as $sec)
                                                <option value="{{ $sec->id }}">{{ $sec->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <textarea name="" id="" cols="30" rows="10"></textarea>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Date">Date</label>
                                        <input type="date" name="attendance_date" class="form-control" value="{{ isset($date) ? $date : date('Y-m-d') }}">
                                    </div>

                                </div> --}}
                            </div>

                        </div>
                        <div class="col-md-2 mt-4">
                            <div class="text-right mt-1">
                                <button type="submit" class="btn btn-primary">Select</button>
                            </div>
                        </div>
                    </div>
                </form>


                @if (session('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
    @if ($students !== null)
        @if ($students->isEmpty())
            <div class="alert alert-danger mt-3" role="alert">
                No students found for the selected class and section.
            </div>
        @else
            @include('Admin.Attendence.add')
        @endif
    @endif
    <tbody>
        {{-- @foreach ($attendanceData as $data)
            <tr>
                <td>{{ $data['day'] }}</td>
                <td>{{ $data['date']->format('Y-m-d') }}</td>
                <td>
                    @foreach ($data['studentNames'] as $studentId => $studentName)
                        {{ $studentName }} ({{ $data['attendanceType'] }})
                        <br>
                    @endforeach
                </td>
            </tr>
        @endforeach --}}
    </tbody>
@endsection

@section('js')
@endsection
