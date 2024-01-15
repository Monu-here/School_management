@extends('Admin.layout.app')
@section('content')
<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Edit Exam</h6>
     </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Name <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="name"   required type="text" class="form-control" placeholder="Name of Exam">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="term" class="col-lg-3 col-form-label font-weight-semibold">Term</label>
                        <div class="col-lg-9">
                            <select data-placeholder="Select Teacher" class="form-control select-search" name="term" id="term">
                                <option   value="1">First Term</option>
                                <option   value="2">Second Term</option>
                                <option   value="3">Third Term</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="">Year</label>
                        <input type="text" name="year">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
