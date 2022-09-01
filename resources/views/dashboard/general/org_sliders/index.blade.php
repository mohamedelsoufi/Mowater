@extends('dashboard.layouts.standard')
@section('title','Mawatery | Sliders')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.org_sliders')}} <small class="text-secondary">({{ $sliders->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.org_sliders')}}</li>
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
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($sliders as $slider)

                                        <tr class="text-center">
                                                <td>
                                                    @if (pathinfo($slider->one_image , PATHINFO_EXTENSION) == 'mp4' || pathinfo($slider->one_image , PATHINFO_EXTENSION) =='flv'|| pathinfo($slider->one_image , PATHINFO_EXTENSION) =='m3u8' || pathinfo($slider->one_image , PATHINFO_EXTENSION) =='3gp'|| pathinfo($slider->one_image , PATHINFO_EXTENSION) =='mov'|| pathinfo($slider->one_image , PATHINFO_EXTENSION) =='avi'|| pathinfo($slider->one_image , PATHINFO_EXTENSION) =='wmv')

                                                        <a style="cursor:pointer;"
                                                           href="{{asset($slider->one_image)}}"
                                                           rel="prettyPhoto" title="Video">
                                                            <iframe src="{{$slider->one_image}}"
                                                                    class="slider_image" frameborder="0"></iframe>
                                                        </a>
                                                    @else
                                                        <a href="{{asset($slider->one_image)}}"
                                                           data-toggle="lightbox">
                                                            <img class="slider_image"
                                                                 src="{{$slider->one_image}}"
                                                                 onerror="this.src='{{asset('uploads/default-image.jpg')}}'"
                                                                 alt="slider_image">
                                                        </a>
                                                    @endif
                                                </td>
                                            <td>{{$slider->section->name}}</td>

                                            <td>
                                                <a href="{{route('organization-sliders.show',$slider->id)}}">
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

