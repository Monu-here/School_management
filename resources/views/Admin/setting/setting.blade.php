@extends('Admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">

@endsection

@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Settings</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">General Settings</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="settings-menu-links">
            <ul class="nav nav-tabs menu-tabs">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.setting.add') }}">General Settings</a>
                </li>

            </ul>
        </div>
 
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Website Basic Details</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('admin.setting.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="settings-form">
                                <div class="form-group">
                                    <label>Website Name <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Website Name"
                                        name="webistename" id="webistename" value="{{ $setting->webistename ?? 'admin' }}">
                                </div>
                                <div class="form-group">
                                    <label>Session <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Website Name"
                                        name="despc" id="despc" value="{{ $setting->despc ?? 'admin' }}">
                                </div>
                                <div class="form-group">
                                    <label>Website Title <span class="star-red">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter Website Title"
                                        name="titletext" id="titletext" value="{{ $setting->titletext ?? 'admin' }}">
                                </div>
                                <div class="form-group">
                                    <p class="settings-label">Logo <span class="star-red">*</span></p>
                                    <div class="settings-btn">
                                        <input type="file" accept="image/*" name="websiteimage" id="websiteimage"
                                            onchange="loadFile(event)" class="hide-input">
                                        <label for="file" class="upload">
                                            <i class="fa-solid fa-upload"></i>
                                        </label>
                                    </div>
                                    <h6 class="settings-size">Recommended image size is <span>150px x
                                            150px</span></h6>
                                    <div class="upload-images">
                                        <img src="{{ asset($setting->websiteimage ?? 'uploads/setting/6jr43UIkw6N22q7iQy2Qw7gUZcXlimWOa5Lp06Bh.png') }}"
                                            alt="Image">
                                        <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                            <i class="feather-x-circle"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="settings-label">Favicon <span class="star-red">*</span></p>
                                    <div class="settings-btn">
                                        <input type="file" accept="image/*" name="favicon" id="favicon"
                                            onchange="loadFile(event)" class="hide-input">
                                        <label for="file" class="upload">
                                            <i class="fa-solid fa-upload"></i> </label>
                                    </div>
                                    <h6 class="settings-size">
                                        Recommended image size is <span>16px x 16px or 32px x 32px</span>
                                    </h6>
                                    <h6 class="settings-size mt-1">Accepted formats: only png and ico</h6>
                                    <div class="upload-images upload-size">
                                        <img src="{{ asset($setting->favicon ?? 'uploads/setting/6jr43UIkw6N22q7iQy2Qw7gUZcXlimWOa5Lp06Bh.png') }}"
                                            alt="Image">
                                        <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                            <i class="feather-x-circle"></i>
                                        </a>
                                    </div>
                                </div>
                                 
                                <br>

                                <div class="form-group mb-0">
                                    <div class="settings-btns">
                                        <button type="submit" class="btn btn-orange">Update</button>
                                        <button type="submit" class="btn btn-grey">Cancel</button>
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
@endsection

