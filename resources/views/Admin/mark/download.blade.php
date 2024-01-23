<div class="container">
    <h2>Marksheet for {{ $student->name }}</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Exam</th>
                <th>Subject</th>
                <th>Obtained Marks</th>
                <th>Practical Marks</th>
                <th>Total Marks</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marks as $mark)
                <tr>
                    <td>{{ $mark->Exam->name }}</td>
                    <td>{{ $mark->Subject->name }}</td>
                    <td>{{ $mark->obtained_marks }}</td>
                    <td>{{ $mark->practical_marks }}</td>
                    <td>{{ $mark->total_marks }}</td>
                    <td>{{ $mark->grade }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
</table>
