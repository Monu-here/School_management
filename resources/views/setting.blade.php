@extends('Admin.layout.app')
@section('content')
    <div class="card">
        <div class="card-body">
            @role('Student')
                <h1>Welcome to Your Dashboard</h1>
                @if (isset($student))
                    <p>Name: {{ $student->name }}</p>
                    <p>Email: {{ $student->email }}</p>
                    <p>Faculity: {{ $student->faculity->name }}</p>
                    <p>Semester: {{ $student->class->name }}</p>
 
                @endif
            @endrole()
        </div>
    </div>
@endsection
