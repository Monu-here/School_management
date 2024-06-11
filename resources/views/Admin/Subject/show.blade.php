@extends('Admin.layout.app')
@section('content')
<div class="container mx-auto p-4 mt-4">
    <div class="bg-blue-700 text-white p-4 rounded-t-lg">
        <h2 class="text-lg font-bold">{{ $subject->faculity->name }}</h2>
    </div>
    <div class="bg-zinc-100 p-4 rounded-b-lg">
        <p class="mb-4">Minimum credit Requirement: 126</p>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-zinc-200">
                    <th class="border p-2 text-left">Course Code</th>
                    <th class="border p-2 text-left">Course Title</th>
                    <th class="border p-2 text-left">Level</th>
                    <th class="border p-2 text-left">Credits</th>
                    <th class="border p-2 text-left">Pre-requisites</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-zinc-300">
                    <td colspan="5" class="border p-2 font-bold">{{ $subject->sub_desc }}</td>
                </tr>
                <tr>
                    <td class="border p-2">{{ $subject->sub_code }}</td>
                    <td class="border p-2">{{ $subject->name }}</td>
                    <td class="border p-2">{{ $subject->level }}</td>
                    <td class="border p-2">{{ $subject->credit }}</td>
                    <td class="border p-2">{{ $subject->pre_requsisites }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection
