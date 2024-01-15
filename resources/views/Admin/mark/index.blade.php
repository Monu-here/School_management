<!-- resources/views/marks/index.blade.php -->

@extends('Admin.layout.app')

@section('content')
    <h2>Marks</h2>

    <a href="{{ route('admin.mark.marks.create') }}" class="btn btn-primary">Add New Mark</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Subject</th>
                  <th>Exam</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marks as $mark)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $mark->student->name }}</td>
                    <td>{{ $mark->subject->name }}</td>
                    {{-- <td>{{ $mark->class->classes->name }}</td> --}}
                     <td>{{ $mark->exam->name }}</td>
                    <td>{{ $mark->t1 + $mark->t2 + $mark->t3 + $mark->t4 + $mark->tca + $mark->exm + $mark->tex1 + $mark->tex2 + $mark->tex3 }}</td>
                    <td>
                        {{-- <a href="{{ route('marks.edit', $mark->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                        {{-- <form action="{{ route('marks.destroy', $mark->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form> --}}
                        ihugy
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
