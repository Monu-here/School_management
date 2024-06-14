@extends('Admin.layout.app')
@section('css')
    <style>
        .body-section {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container-section {
            width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #000;
        }

        .tabs {
            margin-bottom: 10rem;
        }

        .main-header-section {
            display: flex;
            justify-content: space-between;
        }

        .header-section-here {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-section-here img {
            width: 150px;
        }

        .header-section-here div {
            text-align: left;
        }

        .header-section-here h1 {
            margin: 0;
            font-size: 20px;
        }

        .header-section-here p {
            margin: 2px 0;
            font-size: 12px;
        }

        .title {
            margin: 20px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .info {
            margin-top: 30px;
        }

        .details {
            display: flex;
        }

        .details-table {
            border: none;
            margin-top: 0px;
        }

        .details-table tr th {
            text-align: left;
            padding: 0px;
            font-weight: 400;
        }

        .info .name {
            font-size: 20px;
            font-weight: 700;
        }

        /* .info course {
                                margin: 20px 0;
                                font-size: 14px;
                            } */

        /* table {
                                border: none;
                            } */
        table,
        th,
        td {
            border: none !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        .second-table .dashed-line {
            border-bottom: 2px dashed;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .notes {
            margin-top: 20px;
            font-size: 14px;
        }

        .notes p {
            margin: 4px;
        }

        .legend {
            margin-top: 20px;
            font-size: 14px;
        }

        .legend p {
            margin: 5px 0;
        }
    </style>
@endsection
@section('content')
    {{-- <span>Date : {{ $date }}</span>
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
                    <td>{{ $mark->grade }}</td>
                    <td> {{ $mark->remark }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total Marks Across All Subjects:</th>
                <td colspan="5">{{ $totalMarks }}
                    <p>Grade: {{ $student->grade }}</p>
               
                    <p>Remark: {{ $student->remark }}</p>
                    Percentage : {{ number_format($percentage, 2) }}
                    <br>
                    Gpa :{{ $percentage / 25 }}
                </td>


            </tr>
        </tfoot>
    </table> --}}



     <div class="body-section">
        <div class="container-section">
            <div class="tabs">
                <div class="main-header-section">
                    <div class="header-section-here">
                        <img src="{{ asset('img/image.png') }}" alt="Nilai University Logo">
                        <div>
                            <p>Nilai University</p>
                            <p>No.1, Persiaran Universiti, Putra Nilai,</p>
                            <p>71800 Nilai, Negeri Sembilan, Malaysia</p>
                            <p>Tel: +66-850-2338 Fax: +66-850-2339</p>
                            <p>Email: enquiry@nilai.edu.my</p>
                        </div>
                    </div>
                    <div class="title">
                        EXAMINATION GRADING REPORT<br>
                        Session: OCT_SHORT (FRANCHISE_PC) 2023
                    </div>
                </div>
                <div class="info">
                    <p class="name">{{ $student->name }}</p>
                    <div class="details">
                        <table class="details-table">
                            <tr>
                                <th style="border: none;">IC: 27017701397</th>
                                <th style="border: none;">ID: {{ $student->idno }}</th>
                            </tr>
                        </table>
                        <table class="details-table">
                            <tr>
                                <th style="border: none;">Semester: {{ $student->class->name }}</th>
                                <th style="border: none;">Date: {{ $date }}</th>
                            </tr>
                        </table>
                    </div>
                    <p class="course"><strong>{{ $student->faculity->name }}</strong></p>
                </div>
                <table class="second-table" style="border-bottom: 2px dashed;">
                    <tr class="dashed-line">
                        <th>NO.</th>
                        <th>CODE</th>
                        <th>SUBJECT TITLE</th>
                        <th>CR</th>
                        <th>GRADE</th>
                        <th>POINTS</th>
                    </tr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($marks as $mark)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $mark->subject->sub_code }}</td>
                            <td>{{ $mark->Subject->name }}</td>
                            <td>{{ $mark->obtained_marks }}</td>
                            <td>{{ $mark->grade }}</td>
                            <td>{{ $mark->point }}</td>
                        </tr>
                    @endforeach
                </table>
                <div class="notes">
                    {{-- <p>Subjects to Resit: {{ is_array($mark->resit) ? implode(', ', $mark->resit) : $mark->resit }}</p> --}}
                    <p>Subjects to Resit: {{ $ci->resit ?? '' }}</p>
                    <p>Subjects to Repeat:</p>
                    <div class="details">
                        <table class="details-table">
                            <tr>
                                <td style="border: none;">Hours Passed: 2</td>
                            </tr>
                            <tr>
                                <td style="border: none;">Hours Calculated: 5</td>
                            </tr>
                        </table>
                        <table class="details-table">
                            <tr>
                                <td style="border: none;">Grade Point Average: 2.26</td>

                            </tr>
                            <tr>
                                <td style="border: none;">Cumulative Grade Point Average: 2.18</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="legend">
                    <div class="details">
                        <table class="details-table">
                            <tr>
                                <th style="border: none;">A+: 90-100</th>
                                <th style="border: none;">A: 80-89</th>
                                <th style="border: none;">A+: 90-100</th>
                                <th style="border: none;">A: 80-89</th>
                                <th style="border: none;">A-: 75-79</th>
                                <th style="border: none;">B+: 70-74</th>
                                <th style="border: none;">B: 65-69</th>
                                <th style="border: none;">B-: 60-64</th>
                                <th style="border: none;">C+: 55-59</th>
                                <th style="border: none;">C: 50-54</th>
                                <th style="border: none;">C-: 45-49</th>
                                <th style="border: none;">D+: 40-44</th>
                                <th style="border: none;">D: 35-39</th>
                                <th style="border: none;">F: 0-34</th>

                            </tr>
                        </table>
                    </div>
                </div>
                <div class="legend">
                    <div class="details">
                        <table class="details-table">
                            <tr>
                                <th style="border: none;">RE: Resit NC: Not Completed</th>
                                <th style="border: none;">SC: Satisfactorily Completed</th>
                                <th style="border: none;">BE: Barred from Examination</th>
                                <th style="border: none;">EX: Exemption</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="legend">
                    <div class="details">
                        <table class="details-table">
                            <tr>
                                <th style="border: none;">R: Retake</th>
                                <th style="border: none;">GP: Grades Pending</th>
                                <th style="border: none;">CR: Credit Transfer</th>
                                <th style="border: none;">NS: Not Satisfactory</th>
                                <th style="border: none;">P: Resit Pass</th>
                            </tr>
                        </table>
                    </div>

                </div>

                <div class="legend">
                    <p>This is a computer generated report and no signature is required.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
