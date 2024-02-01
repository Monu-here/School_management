@extends('Admin.layout.app')
@section('css')
    <style>
        .here {
            display: flex;
            justify-content: space-between;
        }

        .here p {
            text-transform: capitalize;
        }
    </style>
@endsection
@section('linkbar')
@endsection
@section('content')
    {{-- this is slider section START --}}
    <div class="here">
        <p>add new Slider</p>
        <p>
            <a href="{{ route('admin.frontdetail.slider') }}" class="btn btn-primary">Add Slider</a>
        </p>
    </div>
    <div class="card shadow  mb-3">

        <div class="card-body" id="">
            @foreach ($sliders as $slider)
                <form action="{{ route('admin.frontdetail.sliderEdit', ['slider' => $slider->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <strong> Slider Image</strong> <br>
                            <div>
                                @if (Route::currentRouteName() == 'admin.frontdetail.index')
                                    <img src="{{ asset($slider->image) }}" style="width: 50%" alt="">
                                @else
                                    <input type="file" class="photo" data-default-file={{ asset($slider->image) }}>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <strong>Short Description</strong> <br>
                                <div>
                                    <p>
                                        @if (Route::currentRouteName() == 'admin.frontdetail.index')
                                            {{ $slider->short_desc }}
                                        @else
                                            <input type="text" name="short_desc" value="{{ $slider->short_desc }}"
                                                class="no-outline form-control" style="border: none">
                                        @endif
                                    </p>
                                </div>
                                <hr>
                                <div>
                                    <strong>Long Description</strong> <br>
                                    <div>
                                        <p>
                                            @if (Route::currentRouteName() == 'admin.frontdetail.index')
                                                {{ $slider->long_desc }}
                                            @else
                                                <input type="text" name="long_desc" value="{{ $slider->long_desc }}"
                                                    class="no-outline form-control" style="border: none">
                                            @endif

                                        </p>
                                    </div>
                                </div>
                                <hr>
                                @if (Route::currentRouteName() == 'admin.frontdetail.index')
                                    <a href="{{ route('admin.frontdetail.sliderEdit', ['slider' => $slider->id]) }}"
                                        class="btn btn-primary">Edit</a>
                                @else
                                    <button type="submit" class="btn btn-primary">Save</button>
                                @endif

                                <a href="{{ route('admin.frontdetail.sliderDel', ['slider' => $slider->id]) }}"
                                    class="btn btn-danger" onclick="return confirm('Would You like to Delete ')}">Del</a>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
    {{-- this is slider section END --}}

    {{-- this is Service section START --}}
    <div class="here">
        <p>add new Service</p>
        <p>
            <a href="{{ route('admin.frontdetail.serviceAdd') }}" class="btn btn-primary">Add Service</a>
        </p>
    </div>
    <div class="card shadow  mb-3">
        <div class="card-body" id="">
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-md-3">
                        <strong> Service Image</strong> <br>
                        <div>
                            <img src="{{ asset($service->image) }}" style="width:40% " alt="">
                        </div>
                        <div>
                            <strong>Name</strong> <br>
                            <div>
                                <p>{{ $service->name }}</p>
                            </div>
                            <hr>
                            <div>
                                <strong>Short Description</strong> <br>
                                <div>
                                    <p>{{ $service->short_desc }} </p>
                                </div>
                            </div>
                            <hr>
                            <a href="#" class="btn btn-primary">Edit</a>
                            <a href="{{ route('admin.frontdetail.serviceDel', ['service' => $service->id]) }}"
                                class="btn btn-danger" onclick="return confirm('Would You like to Delete ')}">Del</a>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
    {{-- this is Service section END  --}}
    {{-- this is about section START --}}
    <div class="here">
        <p>add new About</p>
        <p>
            <a href="{{ route('admin.frontdetail.aboutUsAdd') }}" class="btn btn-primary">Add About Us</a>
        </p>
    </div>
    <div class="card shadow  mb-3">
        <div class="card-body" id="">
            <div class="row">
                @foreach ($abouts as $about)
                    <div class="col-md-6    ">
                        <strong> Av Image</strong> <br>
                        <div>
                            <img src="{{ asset($about->image) }}" style="width:40% " alt="">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div>
                            <strong>Name</strong> <br>
                            <div>
                                <p>{{ $about->name }}</p>
                            </div>
                            <hr>
                            <div>
                                <strong>Short Description</strong> <br>
                                <div>
                                    <p>{{ $about->short_desc }} </p>
                                </div>
                            </div>
                            <hr>
                            <a href="#" class="btn btn-primary">Edit</a>
                            {{-- <a href="{{ route('admin.frontdetail.serviceDel', ['service' => $service->id]) }}"
                            class="btn btn-danger" onclick="return confirm('Would You like to Delete ')}">Del</a> --}}
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    {{-- this is about section END  --}}
@endsection
@section('js')
@endsection
