<link rel="stylesheet" href="{{ asset('assets/css/teacher.css') }}">
<style>
    .red {
        color: red;
    }
</style>
<div class="modal" tabindex="-1" id="openmodel">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="ms-4">Teacher Add</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="mahi_holder">
                    <div class="container">
                        <form action="{{ route('admin.student.teacheradd') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row bg_1">
                                <h3 class="teacherh3"><i>Basic Information </i></h3>
                                <div class="col-md-2">
                                    <label for="Image">Image <span class="red">*</span></label>
                                    <input class="effect-1 photo" type="file" placeholder="Enter Image "
                                        name="image">
                                    <span class="focus-border"></span>
                                    <br>
                                    <label for="Image">CV <span class="red">*</span></label>
                                    <input class="effect-1 photo" type="file" placeholder="Enter Image "
                                        name="cv">
                                    <span class="focus-border"></span>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">

                                        <div class="col-3">
                                            <label for="">Name <span class="red">*</span></label>
                                            <input class="effect-3" type="text" placeholder="Enter Name "
                                                name="name">
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for="gender">Gender<span class="red">*</span></label>
                                            <select name="gender" id="gender" class="form-control effect-3">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <span class="focus-border"></span>
                                        </div>

                                        <div class="col-3">
                                            <label for=""> Date Of Birth <span class="red">*</span></label>
                                            <input class="effect-3" type="date" placeholder="Enter Date of Birth"
                                                name="dob">
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for=""> Phone Number<span class="red">*</span></label>
                                            <input class="effect-3" type="text" placeholder="Enter Phone Number"
                                                name="number">
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Address <span class="red">*</span></label>

                                            <input class="effect-3" type="text" placeholder="Enter Address"
                                                name="address">
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Joining Date <span class="red">*</span></label>
                                            <input class="effect-3" type="date" placeholder="Enter Joining date"
                                                name="jd">
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for=""> Experience <span class="red">*</span></label>

                                            <input class="effect-3" type="text" placeholder="Enter Experience"
                                                name="exp">
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Email <span class="red">*</span></label>

                                            <input class="effect-3" type="text" placeholder="Enter Email"
                                                name="email">
                                            <span class="focus-border"></span>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Qualification <span class="red">*</span></label>

                                            <input class="effect-3" type="text" placeholder="Enter Qualification "
                                                name="qual">
                                            <span class="focus-border">
                                                <i></i>
                                            </span>
                                        </div>
                                        <div class="col-3 " id="userFieldsContainer">
                                            <label for="">Subject <span class="red">*</span></label>
                                            <select name="sub[]" class="form-control" id="new">
                                                <option value="math" class="search">Math</option>
                                                <option value="science" class="search">Science</option>
                                                <option value="english" class="search">English</option>
                                            </select>
                                            <span class="focus-border"> </span>
                                            <br>
                                            <button type="button" class="btn btn-success" id="addUser">Add
                                                SubJect</button>
                                                <button class="btn btn-primary ms-4">Save</button>
                                        </div>
                                    </div>
                                    <div class="col-3" id="selectedSubListContainer">
                                        <label for="">Selected Subjects</label>
                                        <ul id="selectedSubList"></ul>
                                    </div>

                                    <input type="hidden" name="sub" id="hiddenSub" value="">
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //     $('.photo').dropify();
    // });

    $(document).ready(function() {
        $('#addUser').on('click', function() {
            var selectedValue = $('#new option:selected').val();
            if (selectedValue) {
                $('#selectedSubList').append('<li>' + selectedValue + '</li>');
            }
        });
    });
    $(document).ready(function() {
        var selectedSubjects = [];

        $('#addUser').on('click', function() {
            var selectedValue = $('#new option:selected').val();
            if (selectedValue) {
                selectedSubjects.push(selectedValue);
                updateSelectedSubjectsList();
            }
        });

        function updateSelectedSubjectsList() {
            $('#selectedSubList').empty();
            selectedSubjects.forEach(function(subject) {
                $('#selectedSubList').append('<li>' + subject + '</li>');
            });

            // Update hidden input field with the array of subjects
            var cleanString = JSON.parse(JSON.stringify(selectedSubjects)).join(',');
            cleanString = cleanString.replace(/["'\\]/g,
                ''); // Remove double quotes, single quotes, and backslashes
            $('#hiddenSub').val(cleanString);
        }
    });
</script>
