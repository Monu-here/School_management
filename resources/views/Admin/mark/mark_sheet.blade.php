@extends('Admin.layout.app')
@section('css')
    <style>
        .marksheet-content {
            display: flex;
            justify-content: space-around;
        }

        .mm {
            text-align: center;
        }

        .school-smae {
            text-align: center;
            align-items: center;
        }

        .acc-s {
            text-align: center;
            padding: 20px 0px 10px 0px;
        }

        .student-name {
            margin-left: 100px;
        }

        /* .grade-list {
                                                        margin: 20px auto;

                                                        padding: 15px;
                                                        color: #ffffff;
                                                    } */
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="marksheet-content">
            <div class="imga">
                <img src="https://png.pngtree.com/png-vector/20230415/ourmid/pngtree-school-logo-design-template-vector-png-image_6705854.png"
                    alt="" width="100">
            </div>
            <div class="headername">
                <h5>Your School Name</h5>
                <div class="school-smae">
                    <small>Your Affiliated</small>
                    <br>
                    <small>Your Address</small>
                    <br>
                    <small>Your phone and email</small>
                </div>
            </div>
            <span>Date : {{ $date }}</span>
        </div>
        <div class="acc-s">
            <h4>Academic Session / Exam Name: 000/00/00</h4>
            <span>Report card</span>
        </div>
        <div class="student-name">

        </div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Subject</th>
                            <th>Full Marks</th>
                            <th>Pass Marks</th>
                            <th>Obtained Marks</th>
                            <th>Practical Marks</th>
                            <th>Total Marks</th>
                            <th>Final Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 5; $i++)
                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>(Subject) {{ $i }} </td>
                                <td>{{ 100 }}</td>
                                <td>{{ 35 }}</td>
                                <td>{{ 40 }}</td>
                                <td>{{ 20 }}</td>
                                <td>{{ 40 + 20 }}</td>
                                <td>Monu</td>
                            </tr>
                        @endfor
                    </tbody>
                    <th colspan="2" style="text-align: center; ">
                        total
                    </th>
                    <td>{{ 100 * 5 }}</td>
                    <td>{{ 35 * 5 }}</td>
                    <td>{{ 40 * 5 }}</td>
                    <td>{{ 20 * 5 }}</td>
                    <td>Total : {{ 60 * 5 }}</td>
                    <td>Total</td>
                </table>
                {{-- {{ $percentage }} --}}
                {{-- {{ round($percentage, 2) }} --}}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="grade-list">
                    <table id="" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Letter Grading</th>
                                <th>Range</th>
                                <th>Remark</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->mark_from . ' and above ' . $grade->mark_to }}</td>
                                    <td>{{ $grade->remark }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <h1>Mark Sheet for {{ $student->name }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>SN</th>
                <th>Subject</th>
                <th>Obtained Marks</th>
                <th>Practical Marks</th>
                <th>Total Marks</th>
                <th>Grade</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>

            @php
                $i = 1;
            @endphp
            @foreach ($marks as $mark)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $mark->Subject->name }}</td>
                    <td>{{ $mark->obtained_marks }}</td>
                    <td>{{ $mark->practical_marks }}</td>
                    <td>{{ $mark->total_marks }}</td>
                    {{-- <td>{{ $mark->grade->name }}</td> --}}
                    {{-- <td>{{ $mark->Grade->remark }}</td> --}}
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total Marks Across All Subjects:</th>
                <td colspan="5">{{ $totalMarks }}
                    <p>Grade: {{ $student->grade }}</p>
                    <p>Remark: {{ $student->remark }}</p>
                </td>
                {{ number_format($percentage, 2) }}

            </tr>
        </tfoot>
    </table>
@endsection
