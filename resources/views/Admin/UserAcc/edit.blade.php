@extends('Admin.layout.app')
@section('css')
    <style>
        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .login-danger {
            color: red;
        }
    </style>
@endsection
@section('content')
    <form method="POST" action="{{ route('admin.user.edit', ['user' => $user->id]) }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <h5 class="form-title"><span>Basic Details</span></h5>
            </div>
            <div class="col-md-3">
                <div class="form-group local-forms">
                    <label>Image <span class="login-danger">*</span></label>
                    <input type="file" class="form-control photo" name="image" placeholder="Enter Image"
                        data-default-file={{ asset($user->image) }}>
                </div>

            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="form-group local-forms">
                            <label>Name <span class="login-danger">*</span></label>
                            <input type="text" id="formControlLg" class="form-control" name="name"
                                placeholder="Enter Name" value="{{ $user->name }}" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group local-forms">
                            <label>Phone Number <span class="login-danger">*</span></label>
                            <input type="number" class="form-control" name="number" placeholder="Enter Number"
                                value="{{ $user->number }}">

                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group local-forms">
                            <label>Email <span class="login-danger">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email"
                                value="{{ $user->email }}">
                        </div>
                    </div>
                    <!-- ... (other form fields) ... -->
                    <div class="col-12 col-sm-4">
                        <div class="form-group local-forms">
                            <label>Role <span class="login-danger">*</span></label>
                            <select class="form-control" name="role_name">
                                <option disabled>Select Role</option>
                                <option value="Admin"
                                    {{ old('role_name', $user->role_name) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Teacher"
                                    {{ old('role_name', $user->role_name) == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="Student"
                                    {{ old('role_name', $user->role_name) == 'Student' ? 'selected' : '' }}>Student</option>
                            </select>
                        </div>
                    </div>
                    <!-- ... (other form fields) ... -->

                    <div class="col-12 col-sm-4">
                        <div class="form-group local-forms">
                            <label>Password <span class="login-danger">*</span></label>
                            <div class="password-container">
                                <input type="password" class="form-control" name="password" id="password-input"
                                    placeholder="Enter Password" value="{{ $user->password }}">
                                <i class="fas fa-eye password-toggle" id="password-toggle"
                                    onclick="togglePasswordVisibility()"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="student-submit mt-3">
                            <a href="{{ route('admin.user.index') }}" type="submit" class="btn btn-danger">Cancle</a>
                        </div>
                        <button type="submit" class="btn btn-primary">save </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.photo').dropify();
        });

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password-input');
            var passwordToggle = document.getElementById('password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }
    </script>
@endsection
