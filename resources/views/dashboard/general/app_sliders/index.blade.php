@extends('dashboard.layouts.standard')
@section('title','Mawatery | App Sliders')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.app_sliders')}} <small class="text-secondary">({{ $app_sliders->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.app_sliders')}}</li>
                    </ol>
                </div>
                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.image')}}</th>
                                        <th>{{__('words.section')}}</th>
                                        <th>{{__('words.type')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($app_sliders as $slider)

                                        <tr class="text-center">

                                                @if($slider->files->first())
                                                <td>
                                                    @if($slider->files->first()->type == 'video_home_slider')
                                                        <a style="cursor:pointer;"
                                                           href="{{asset($slider->files->first()->path)}}"
                                                           rel="prettyPhoto" title="Video">
                                                            <iframe src="{{asset($slider->files->first()->path)}}"
                                                                    class="slider_image" frameborder="0" onerror="this.src='{{asset('uploads/default-video.jpg')}}'"></iframe>
                                                        </a>
                                                    @else
                                                        <a href="{{asset($slider->files->first()->path)}}"
                                                           data-toggle="lightbox">
                                                            <img class="slider_image"
                                                                 src="{{asset($slider->files->first()->path)}}"
                                                                 @if($slider->files->first()->type == 'video_home_slider') onerror="this.src='{{asset('uploads/default-video.jpg')}}'"
                                                                 @else onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                                 @endif alt="slider_image">
                                                        </a>
                                                    @endif
                                                </td>
                                                @endif
                                            <td>{{$slider->section ? $slider->section->name : __('words.app_home')}}</td>
                                            <td>
                                                @if($slider->type == 'video_home_slider')
                                                    {{__('words.app_home_video')}}
                                                @elseif($slider->type == 'home_first_slider')
                                                    {{__('words.home_first_slider')}}
                                                @elseif($slider->type == 'home_second_slider')
                                                    {{__('words.home_second_slider')}}
                                                @elseif($slider->type == 'home_third_slider')
                                                    {{__('words.home_third_slider')}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('app-sliders.show',$slider->id)}}">
                                                    <button type="button" class="btn btn-outline-info">
                                                        {{__('words.show')}}
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $("a[rel^='prettyPhoto']").prettyPhoto();
    </script>
@endsection

