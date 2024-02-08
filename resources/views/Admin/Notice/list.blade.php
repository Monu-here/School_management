@extends('Admin.layout.app')
@section('linkbar')
    {{-- <section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.notice_board')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.communicate')</a>
                <a href="#">@lang('lang.notice_board')</a>
            </div>
        </div>
    </div> --}}
    </section>
@endsection
@section('css')
    <style>
        .collapsible {
            background-color: rgba(0, 0, 0, .03) color: rgb(145, 41, 41);
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }

        .active,
        .collapsible:hover {
            /* background-color: #555; */
        }

        .content {
            padding: 0 18px;
            display: none;
            overflow: hidden;
            /* background-color: #f1f1f1; */
        }
    </style>
@endsection
@section('content')
    <section class="mb-40">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">Notice</h3>
                    </div>
                </div>
                <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                    <a href="{{ route('admin.notice.add') }}" class="btn btn-primary small fix-gr-bg">
                        + Add Notice
                    </a>
                </div>
            </div>
            <div class="row ">
                @foreach ($notices as $notice)
                    <div class="col-lg-12 ">
                        <br>
                        <button type="button" class="collapsible" style="color: #415094">
                            <span style="display: flex; justify-content: space-between">
                                {{ $notice->notice_title }}
                                <div class="">
                                    <a href="{{route('admin.notice.edit',['notice'=>$notice->id])}}"  class="btn btn-primary btn-sm text-white">Edit</a>
                                     <a href="{{route('admin.notice.del',['notice'=>$notice->id  ])}}"  class="btn btn-danger btn-sm text-white">Del</a>
                                </div>
                            </span>
                        </button>
                        <div class="content card shadow">
                            <div id class="card-body">
                                <div class="">
                                    <div class="row" style="color: #828bb2;">
                                        <div class="col-lg-8" style="color: #828bb2">
                                            {{ $notice->notice_message }}
                                        </div>
                                        <div class="col-lg-4">
                                            <p class="mb-0" style="font-size: 12px">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                Publish Date :
                                                {{ $notice->publish_on }}
                                            </p>
                                            <p class="mb-0"style="font-size: 12px">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                Notice Date :
                                                {{ $notice->notice_date }}
                                            </p>
                                            <p style="font-size: 12px">
                                                <i class="fa-solid fa-user me-2"></i>
                                                Created By :
                                                {{ $notice->user->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>
@endsection
