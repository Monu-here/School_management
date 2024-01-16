<!-- resources/views/marks/index.blade.php -->

@extends('Admin.layout.app')

@section('content')
    <h2>Marks</h2>

    <a href="{{ route('admin.mark.add') }}" class="btn btn-primary">Add New Mark</a>


@endsection
