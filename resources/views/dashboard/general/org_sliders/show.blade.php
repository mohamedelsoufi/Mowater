@extends('dashboard.layouts.standard')
@section('title','Mawatery | Sliders')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.org_sliders')}} <small
                                class="text-secondary">{{$slider->section ? $slider->section->name : __('words.app_home')}}</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('organization-sliders.index')}}">{{__('words.org_sliders')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{$slider->section ? $slider->section->name : __('words.app_home')}}</li>
                    </ol>
                </div>
                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">

                        </div>
                        {{-- create modal end --}}
                        <form action="{{route('organization-sliders.update',$slider->id)}}" method="post"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="type" value="{{$slider->type}}">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" style="min-width: 845px">
                                        <thead>
                                        <tr class="text-center">
                                            <th>{{__('words.section')}}</th>
                                            <th>{{__('words.type')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="display_data">
                                        <tr class="text-center text-dark">

                                            <td>{{$slider->section ? $slider->section->name : __('words.app_home')}}</td>
                                            <td>
                                                @if($slider->type == 'videos_home')
                                                    {{__('words.app_home_video')}}
                                                @elseif($slider->type == 'images_home')
                                                    {{__('words.app_home_image')}}
                                                @else
                                                    {{__('words.for_section')}}
                                                @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-row">
                                    <div class="col-12">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($slider->files->count() < 12)
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>{{__('words.choose_image')}}</label>
                                            <input type="file" name="slider_file[]" multiple
                                                   class="form-control image @error('slider_file[]') is-invalid @enderror"
                                                   placeholder="{{__('words.Slider_image_Video')}}">

                                        </div>
                                    </div>
                                @endif
                                <div class="form-row">
                                    @foreach($slider->files as $file)
                                        <div class="form-row col-md-4">

                                            <div class="rounded border m-1">
                                                @if (pathinfo($file->path, PATHINFO_EXTENSION) == 'mp4' || pathinfo($file->path, PATHINFO_EXTENSION) =='flv'|| pathinfo($file->path, PATHINFO_EXTENSION) =='m3u8' || pathinfo($file->path, PATHINFO_EXTENSION) =='3gp'|| pathinfo($file->path, PATHINFO_EXTENSION) =='mov'|| pathinfo($file->path, PATHINFO_EXTENSION) =='avi'|| pathinfo($file->path, PATHINFO_EXTENSION) =='wmv')
                                                    <a style="cursor:pointer;"
                                                       href="{{asset($file->path)}}"
                                                       rel="prettyPhoto" title="Video">
                                                        <iframe src="{{asset($file->path)}}"
                                                                class="img-thumbnail w-100" frameborder="0"></iframe>
                                                    </a>
                                                @else
                                                    <a href="{{asset($file->path)}}"
                                                       data-toggle="lightbox">
                                                        <img class="img-thumbnail w-100" style="height: 200px;"
                                                             src="{{asset($file->path)}}"
                                                             @if($slider->type == 'videos_home') onerror="this.src='{{asset('uploads/default-video.jpg')}}'"
                                                             @else onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             @endif alt="slider_image">
                                                    </a>
                                                @endif
                                                <div class="form-check form-check-inline slider-checkbox">
                                                    <input
                                                        class="form-check-input checkImage @error('checkImage') is-invalid @enderror"
                                                        type="checkbox" id="image-{{$file->id}}">
                                                    <label class="form-check-label"
                                                           for="image-{{$file->id}}">{{__('words.delete')}}</label>

                                                    @error('checkImage')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                    <div id="deleted_images"></div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary">{{__('words.edit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">

        function getDeletedImages() {
            $('#deleted_images').empty();

            $('input[type="checkbox"].checkImage:checked').each(function () {
                $('#deleted_images').append('<input type="hidden" name="deleted_images[]" value="' + $(this).attr("id").replace('image-', '') + '">');

            });
        }


        $(".checkImage").change(function () {
            getDeletedImages();
            if (this.checked) {
                $(this).parent().find("img").addClass("delete");
            } else {
                $(this).parent().find("img").removeClass("delete");
            }

        });
    </script>
@endsection

