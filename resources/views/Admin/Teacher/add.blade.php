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
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.student.teacheradd') }}" method="POST"
                                enctype="multipart/form-data" id="form3">
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
                                                <label for=""> Date Of Birth <span
                                                        class="red">*</span></label>
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
                                                <label for="">Qualification <span
                                                        class="red">*</span></label>

                                                <input class="effect-3" type="text"
                                                    placeholder="Enter Qualification " name="qual">
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

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.user.add') }}" id="form4" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Teacher Login Details</span></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Image <span class="login-danger">*</span></label>
                                            <input type="file" class="form-control photo" name="image"
                                                placeholder="Enter Image" accept="image/*">
                                        </div>

                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Name <span class="login-danger">*</span></label>
                                                    <input type="text" id="formControlLg" class="form-control"
                                                        name="name" placeholder="Enter Name" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Phone Number <span class="login-danger">*</span></label>
                                                    <input type="number" class="form-control" name="number"
                                                        placeholder="Enter Number">

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Email <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Role <span class="login-danger">*</span></label>
                                                    <select class="form-control" name="role_name">
                                                        <option selected disabled>Select Role</option>
                                                        {{-- @role('SuperAdmin') --}}
                                                        <option value="Admin">Admin</option>
                                                        {{-- @endrole() --}}
                                                        <option value="Teacher">Teacher
                                                        </option>
                                                        <option value="Student">
                                                            Student</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Password <span class="login-danger">*</span></label>
                                                    <div class="password-container">
                                                        <input type="password" class="form-control" name="password"
                                                            id="password-input" placeholder="Enter Password">
                                                        <i class="fas fa-eye password-toggle" id="password-toggle"
                                                            onclick="togglePasswordVisibility()"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="student-submit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("submitBtn").addEventListener("click", function(event) {
        event.preventDefault();

        // Submit both forms
        var form3 = document.getElementById("form3");
        var form4 = document.getElementById("form4");

        // Submit Form 1
        var formData1 = new FormData(form3);
        fetch(form3.action, {
                method: 'POST',
                body: formData1
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log("Form 1 submitted successfully");
                return response.text();
            })
            .catch(error => {
                console.error("Error submitting Form 1:", error);
            });

        // Submit Form 2
        var formData2 = new FormData(form4);
        fetch(form4.action, {
                method: 'POST',
                body: formData2
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                console.log("Form 2 submitted successfully");
                return response.text();
            })
            .then(data => {
                console.log("Form 2 submission response:", data);
                alert("Forms submitted successfully");

                location.reload(); // Reload the page
            })
            .catch(error => {
                console.error("Error submitting Form 2:", error);
            });
    });
</script>
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
