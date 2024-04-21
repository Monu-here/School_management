<link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">
<style>
    .red {
        color: red;
    }
</style>
<div class="modal" tabindex="-1" id="opendep">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="ms-4">Department Add</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="page-wrapper">
                    <div class="content container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('admin.department.add') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="form-title"><span>Department Information</span></h5>
                                                    <br>
                                                </div>
                                                <br>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group local-forms">
                                                                <label>Department Name <span class="login-danger">*</span></label>
                                                                <input type="text" id="formControlLg" class="form-control"
                                                                    name="name" placeholder="Enter Name of Department" />
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group local-forms">
                                                                <label>Head of Department<span class="login-danger">*</span></label>
                                                                <input type="text" class="form-control" name="hod"
                                                                    placeholder="Enter Head of Department">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group local-forms">
                                                                <label>Department Start Date <span class="login-danger">*</span></label>
                                                                <input type="date" class="form-control" name="date"
                                                                    placeholder="Enter Department Start Date">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-4">
                                                            <div class="form-group local-forms">
                                                                <label>No Of Student <span class="login-danger">*</span></label>
                                                                <input type="number" class="form-control" name="nofst"
                                                                    placeholder="Enter No Of Student">
                                                            </div>
                                                        </div>



                                                        <div class="col-12">
                                                            <div class="student-submit">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  

</script>
