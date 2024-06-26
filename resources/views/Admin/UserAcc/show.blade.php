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
    <form method="POST" action="{{ route('admin.user.show', ['userId' => $user->id]) }}" enctype="multipart/form-data">
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
                                placeholder="Enter Name" value="{{ $user->name }}" readonly />
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group local-forms">
                            <label>Phone Number <span class="login-danger">*</span></label>
                            <input type="number" class="form-control" name="number" placeholder="Enter Number"
                                value="{{ $user->number }}" readonly>

                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group local-forms">
                            <label>Email <span class="login-danger">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Email"
                                value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <!-- ... (other form fields) ... -->
                    
                    <!-- ... (other form fields) ... -->

                     

                    <div class="col-12">
                        <div class="student-submit mt-3">
                            <a href="{{ route('admin.user.index') }}" type="submit" class="btn btn-danger">Cancle</a>
                        </div>
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
