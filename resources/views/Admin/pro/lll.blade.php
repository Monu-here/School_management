@extends('Admin.layout.app')

@section('content')
    <form method="post" action="{{ route('admin.promotion.index') }}">
        @csrf
        <label for="from_class">Select Class:</label>
        <select name="from_class" id="from_class" class="form-control">
            @foreach ($cc as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>

        <label for="from_section">Select Section:</label>
        <select name="from_section" id="from_section" class="form-control">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
        </select>

        <button type="submit" style="display: flex; justify-content: center">Filter</button>
    </form>

    @if ($students)
        <h2>Filtered Students</h2>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->classes->name }}</td>
                        <td>
                            <button type="button" onclick="openPromoteForm({{ $student->id }})">Promote</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Promote Form -->
    <div id="promoteForm" style="display: none;">
        <form method="post" action="{{ route('admin.promotion.p') }}">
            @csrf
            <input type="hidden" name="student_id" id="student_id">

            <label for="to_class">To Class:</label>
            <label for="to_class">To Class:</label>
            <select name="to_class" id="to_class" class="form-control">
                @foreach ($cc as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>


            <label for="to_section">To Section:</label>
            <select name="to_section" id="to_section" class="form-control">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>

            <label for="promotion_status">Promotion Status:</label>
            <select name="status" id="promotion_status" class="form-control">
                <option value="promote">Promote</option>
                <option value="not_promote">Not Promote</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function openPromoteForm(studentId) {
            document.getElementById('student_id').value = studentId;
            document.getElementById('promoteForm').style.display = 'block';
        }
    </script>
@endsection
