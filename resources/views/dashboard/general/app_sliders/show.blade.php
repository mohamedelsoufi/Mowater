@extends('dashboard.layouts.standard')
@section('title','Mawatery | App Sliders')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.app_sliders')}} <small
                                class="text-secondary">{{$app_slider->section ? $app_slider->section->name : __('words.app_home')}}</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{route('app-sliders.index')}}">{{__('words.app_sliders')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.'.$app_slider->type)}}</li>
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
                        <form action="{{route('app-sliders.update',$app_slider->id)}}" method="post"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="type" value="{{$app_slider->type}}">
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

                                            <td>{{$app_slider->section ? $app_slider->section->name : __('words.app_home')}}</td>
                                            <td>
                                                @if($app_slider->type == 'video_home_slider')
                                                    {{__('words.app_home_video')}}
                                                @elseif($app_slider->type == 'home_first_slider')
                                                    {{__('words.home_first_slider')}}
                                                @elseif($app_slider->type == 'home_second_slider')
                                                    {{__('words.home_second_slider')}}
                                                @elseif($app_slider->type == 'home_third_slider')
                                                    {{__('words.home_third_slider')}}
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

                                @if($app_slider->files->count() < 6)
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
                                    @foreach($app_slider->files as $file)
                                        <div class="form-row col-md-4">

                                            <div class="rounded border m-1">
                                                @if($app_slider->type == 'video_home_slider')
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
                                                             @if($app_slider->type == 'video_home_slider') onerror="this.src='{{asset('uploads/default-video.jpg')}}'"
                                                             @else onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             @endif alt="slider_image">
                                                    </a>
                                                @endif
                                                <div class="form-check form-check-inline">
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
                                <button type="submit"
                                        class="btn btn-outline-primary">{{__('words.edit')}}</button>
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

