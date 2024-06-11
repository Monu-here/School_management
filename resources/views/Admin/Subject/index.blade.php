@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.subject-add.index') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="faculity_id">Select Faculty:</label>
                            <select name="faculity_id" id="faculity_id" class="form-control  ">
                                @foreach ($faculitys as $faculity)
                                    <option value="{{ $faculity->id }}"
                                        {{ isset($faculity_id) ? ($faculity_id == $faculity->id ? 'selected' : '') : (request('faculity_id') == $faculity->id ? 'selected' : '') }}>
                                        {{ $faculity->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="faculity_id">Select Semester:</label>

                            <select name="semester_id" id="" class="form-control ">
                                <option value="" selected disabled>Select Semester
                                </option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}"
                                        {{ isset($semester_id) ? ($semester_id == $classe->id ? 'selected' : '') : (request('semester_id') == $classe->id ? 'selected' : '') }}>
                                        {{ $classe->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="submit" class="btn btn-primary">Select</button>
                        @role('SuperAdmin')
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Add New Subject</a>
                            </button>
                        @endrole()
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class=" mx-auto p-4">
                    <div class="bg-blue-700 text-white p-4 rounded-t-lg">
                        @if ($selecterdFaculity)
                            <h2></h2>
                            <h1 class="text-lg font-bold text-white">
                                Programme: {{ $selecterdFaculity->name }} /
                                @if ($selectedSemester == null)
                                    no data fount
                                @else
                                    {{ $selectedSemester->name }}
                            </h1>
                        @endif
                        @endif
                    </div>
                    <div class="bg-zinc-100 p-4 rounded-b-lg">
                        {{-- <p class="mb-4">Minimum credit Requirement: 126</p> --}}
                        @if ($subjects)
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
                                    @php
                                        $currentSubDesc = '';
                                    @endphp
                                    @foreach ($subjects as $subject)
                                        @if ($currentSubDesc != $subject->sub_desc)
                                            @php
                                                $currentSubDesc = $subject->sub_desc;
                                                $rowSpanCount = $subjects->where('sub_desc', $currentSubDesc)->count();
                                            @endphp
                                            <tr>
                                                <td colspan="5" class="border p-2 font-bold">{{ $subject->sub_desc }}
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="border p-2">{{ $subject->name }}</td>
                                                <td class="border p-2">{{ $subject->sub_code }}</td>
                                                <td class="border p-2">{{ $subject->credit }}</td>
                                                <td class="border p-2">{{ $subject->level }}</td>
                                                <td class="border p-2">{{ $subject->pre_requsisites }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>






    {{-- @foreach ($subjects as $subject)
        <div class="max-w-7xl mx-auto p-4">
            <div class="bg-blue-600 text-white p-4 rounded-t-lg">
                <h1 class="text-xl font-bold">
                    @php
                        $fact = DB::table('subjects')->where('faculity_id', '!=', '')->distinct()->pluck('faculity_id');
                    @endphp
                    @foreach ($fact as $fact)
                        <div>{{ $fact }}</div>
                    @endforeach
                    Programme: Bachelor of Information Technology (Hons)
                </h1>
            </div>
            <div class="bg-white shadow-md rounded-b-lg overflow-hidden">
                <div class="p-4">
                    <p class="font-semibold">Minimum credit Requirement: 126</p>
                </div>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="w-full bg-zinc-200 text-left text-sm uppercase text-zinc-600">
                            <th class="py-3 px-4">Course Code</th>
                            <th class="py-3 px-4">Course Title</th>
                            <th class="py-3 px-4">Level</th>
                            <th class="py-3 px-4">Credits</th>
                            <th class="py-3 px-4">Pre-requisites</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-700">
                        <td colspan="5" class="py-3 px-4 font-semibold">
                            @php
                                $ss = DB::table('subjects')->where('sub_desc', '!=', '')->distinct()->pluck('sub_desc');
                            @endphp
                            @foreach ($ss as $desc)
                                <div>{{ $desc }}</div>
                            @endforeach
                            <tr class="bg-zinc-100">
                        </td>

                        </tr>
                        <tr>
                            <td class="py-3 px-4">EC3105</td>
                            <td class="py-3 px-4">C-Programming</td>
                            <td class="py-3 px-4">Basic</td>
                            <td class="py-3 px-4">3</td>
                            <td class="py-3 px-4">None</td>
                        </tr>


                    </tbody>
                </table>
    @endforeach --}}








































    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="" style="font-size: 1.5rem">Add Subject</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action ="{{ route('admin.subject-add.add') }}" method="POST" enctype="multipart/form-data"
                    id="add_name">
                    @csrf
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="faculity_id">Faculity <span class="login-danger">*</span>
                                        </label>
                                        <select name="faculity_id" id="new" class="form-control">
                                            <option value="" selected disabled>Select Faculity
                                            </option>
                                            @foreach ($faculitys as $faculity)
                                                <option value="{{ $faculity->id }}">{{ $faculity->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="semester_id">Semester <span class="login-danger">*</span>
                                        </label>
                                        <select name="semester_id" id="" class="form-control ">
                                            <option value="" selected disabled>Select Semester
                                            </option>
                                            @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}">{{ $classe->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sub_desc">Subject Description <span
                                                class="login-danger">*</span></label>
                                        <input type="text" name="sub_desc" id="sub_desc" class="form-control"
                                            placeholder="Enter Subject Description">
                                    </div>
                                </div>
                                <div class="" id="dynamic_field">
                                    <div class="row">
                                        <div class="col-md-4">

                                            <label for="qq">Subject Code <span class="login-danger">*</span></label>

                                            <input type="text" name="sub_code[]" placeholder="Enter Subject Code"
                                                class="form-control " />
                                        </div>
                                        <div class="col-md-8">

                                            <label for="qq">Subject Name <span class="login-danger">*</span></label>

                                            <input type="text" name="name[]" placeholder="Enter Subject Name"
                                                class="form-control " />
                                        </div>

                                        <div class="col-md-4">

                                            <label for="qq">Level</label>
                                            <input type="text" name="level[]" placeholder="Enter Level, eg:Basic "
                                                class="form-control " />
                                        </div>
                                        <div class="col-md-4">

                                            <label for="qq">Credits <span class="login-danger">*</span></label>
                                            <input type="text" name="credit[]" placeholder="Enter Credits Hours "
                                                class="form-control " />
                                        </div>
                                        <div class="col-md-4">

                                            <label for="qq">Pre-requisites</label>

                                            <input type="text" name="pre_requsisites[]"
                                                placeholder="Enter Subject Pre-requisites" class="form-control " />
                                        </div>
                                    </div>
                                    <br>



                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="add" id="add" class="btn btn-primary">Add
                            More Subject</button>
                        <button class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        $(function() {
            $('#clienttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
        $(document).ready(function() {
            $('.select2').select2();
        });
        // $(document).ready(function() {

        //     var i = 1;
        //     var length;
        //     //var x = 0;
        //     var x = 1
        //     $("#add").click(function() {



        //         x += 1;
        //         console.log('amount: ' + x);
        //         i++;
        //         // $('#dynamic_field').append('<tr id="row' + i +'"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control "/></td><td><input type="text" name="sub_code[]" placeholder="Enter your Email" class="form-control "/></td><td><input type="text" name="level[]" value="700" placeholder="Enter your Money" class="form-control "/></td>	<td><input type="text" name="level[]" value="700" placeholder="Enter your Money" class="form-control "/></td><td>	<td><input type="text" name="pre_requsisites[]" value="700" placeholder="Enter your Money" class="form-control "/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        //         $('#dynamic_field').append('<div class="row" id="row'+ i +'"><div class="col-md-4"><label for="qq">Subject Code <span class="login-danger">*</span></label><input type="text" name="sub_code[]" placeholder="Enter your Email" class="form-control " /></div><div class="col-md-8"><label for="qq">Subject Name <span class="login-danger">*</span></label><input type="text" name="name[]" placeholder="Enter your Name" class="form-control " /> </div><div class="col-md-4"><label for="qq">Level</label><input type="text" name="level[]" value=""  placeholder="Enter your Money" class="form-control " /></div><div class="col-md-4"> <label for="qq">Credits <span class="login-danger">*</span></label><input type="text" name="credit[]" value=""  placeholder="Enter your Money" class="form-control " /></div><div class="col-md-4"><label for="qq">Pre-requisites</label><input type="text" name="pre_requsisites[]" value="700" placeholder="Enter your Money" class="form-control " /></div><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></div>');















        //     });

        //     $(document).on('click', '.btn_remove', function() {
        //         x -= 1;
        //         console.log('amount: ' + x);



        //         var button_id = $(this).attr("id");
        //         $('#row' + button_id + '').remove();
        //     });



        //     $("#submit").on('click', function(event) {
        //         var formdata = $("#add_name").serialize();
        //         console.log(formdata);

        //         event.preventDefault()



        //     });
        // });
        $(document).ready(function() {
            var i = 1;
            var x = 1;

            $("#add").click(function() {
                x += 1;
                console.log('amount: ' + x);
                i++;
                $('#dynamic_field').append(' <div class="row" id="row' + i + '">'
                    // +'<h4>More Subject</h4>'
                    +
                    '<hr>' +
                    ' <div class="col-md-4">' +
                    '<label for="qq">Subject Code <span class="login-danger">*</span></label>' +
                    '<input type="text" name="sub_code[]" placeholder="Enter Subject Code" class="form-control " />' +
                    '</div>' +
                    '<div class="col-md-8">' +
                    '<label for="qq">Subject Name <span class="login-danger">*</span></label>' +
                    '<input type="text" name="name[]" placeholder="Enter Subject Name" class="form-control " />' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<label for="qq">Level</label>' +
                    '<input type="text" name="level[]" placeholder="Enter Level, eg:Basic" class="form-control " />' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<label for="qq">Credits <span class="login-danger">*</span></label>' +
                    '<input type="text" name="credit[]" placeholder="Enter  Credits Hours" class="form-control " />' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<label for="qq">Pre-requisites</label>' +
                    '<input type="text" name="pre_requsisites[]" placeholder="Enter Subject Pre-requisites" class="form-control " />' +
                    '<div class="d-flex m-3 justify-content-end"><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn_remove">X</button></div></div>' +
                    '</div> ' +
                    '</div>');
            });

            $(document).on('click', '.btn_remove', function() {
                x -= 1;
                console.log('amount: ' + x);
                var button_id = $(this).attr("id");
                $('#row' + button_id).remove();
            });

            $("#submit").on('click', function(event) {
                var formdata = $("#add_name").serialize();
                console.log(formdata);
                event.preventDefault();
            });
        });
    </script>
@endsection
