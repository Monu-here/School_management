@extends('Admin.layout.app')
@section('css')
@endsection
@section('linkbar')
    / <a href="#">Home</a> / Add
@endsection
@section('content')
    <div class="car shadow p-3 mb-3 bg-white">
        <div class="card-body">
            <form action="{{ route('admin.frontdetail.slider') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-2 small">
                        <label for="">Slider Image </label>
                        <input type="file" name="image" id="image" class="form-control photo" accept="image/*">
                    </div>
                    <div class="col-md-8 mb-2">
                        <div>
                            <label for="">Title</label>
                            <input type="text" name="short_desc" id="short_desc" class="form-control">
                        </div>
                        <div class="">
                            <label for="">Short Description</label>
                            <textarea name="long_desc" id="long_desc" cols="x   0" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="py-2 text-end">
                            <button class="btn btn-primary">Save</button>
                            <a href=" " class="btn btn-danger text-white">Cancle</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    Service section
    <div class="car shadow p-3 mb-3 bg-white">
        <div class="card-body">
            <form action="{{ route('admin.frontdetail.serviceAdd') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-2 small">
                        <label for="">Service Image </label>
                        <input type="file" name="image" id="image" class="form-control photo" accept="image/*">
                    </div>
                    <div class="col-md-8 mb-2">
                        <div>
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="">
                            <label for="">Short Description</label>
                            <textarea name="short_desc" id="short_desc" cols="x   0" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="py-2 text-end">
                            <button class="btn btn-primary">Save</button>
                            <a href=" " class="btn btn-danger text-white">Cancle</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.photo').dropify();
        });
    </script>
@endsection
