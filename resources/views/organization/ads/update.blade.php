@extends('organization.layouts.app')
@section('title','Mawatery | ads')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.ads')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.ads')}}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            <div class="col-sm-6 p-md-0">
                                <div class="welcome-text">
                                    <h4>{{__('words.new_ad')}}</h4>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{$show_ad->id}}">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.title_ar')}}</label>
                                                <input type="text" name="title_ar" value="{{$show_ad->title_ar}}"
                                                       class="form-control @error('title_ar') is-invalid @enderror"
                                                       placeholder="{{__('words.title_ar')}}">
                                                @error('title_ar')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror                                </div>

                                            <div class="form-group col-md-6">
                                                <label>{{__('words.title_en')}}</label>
                                                <input type="text" name="title_en" value="{{$show_ad->title_en}}"
                                                       class="form-control @error('title_en') is-invalid @enderror"
                                                       placeholder="{{__('words.title_en')}}">

                                                @error('title_en')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>{{__('words.description_ar')}}</label>
                                                <textarea name="description_ar"
                                                          class="form-control ckeditor @error('description_ar') is-invalid @enderror">{{$show_ad->description_ar}}</textarea>

                                                @error('description_ar')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>{{__('words.description_en')}}</label>
                                                <textarea name="description_en"
                                                          class="form-control ckeditor @error('description_en') is-invalid @enderror">{{$show_ad->description_ar}}</textarea>

                                                @error('description_en')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-row ">
                                            <div class="form-group col-md-12">
                                                <label>{{__('words.images')}}</label>
                                                <input type="file" name="images[]" id="files"
                                                       class="form-control image @error('images') is-invalid @enderror"
                                                       placeholder="{{__('words.images')}}" multiple>
                                                @error('images')
                                                <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                @enderror
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <output id='result' class="row"/>
                                            </div>
                                        </div>

                                            <div class="form-row">
                                                @foreach($show_ad->files as $file)
                                                <div class="form-group col-md-3 rounded ">
                                                    <a href="{{asset($file->path)}}"
                                                       data-toggle="lightbox">
                                                        <img class="img-thumbnail w-100"
                                                             src="{{asset($file->path)}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="image">
                                                    </a>
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
                                                @endforeach
                                            </div>

                                        <div id="deleted_images"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>{{__('words.ad_type')}}</label>
                                            <select name="ad_type_id"
                                                    class="form-control ad_type_id @error('ad_type_id') is-invalid @enderror">
                                                <option value="" selected>{{__('words.choose')}}</option>
                                                @foreach($ad_types as $ad_type)
                                                    <option
                                                        @if($ad_type->id==$show_ad->ad_type_id)
                                                        selected
                                                        @endif
                                                        value="{{$ad_type->id}}">{{$ad_type->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('ad_type_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>{{__('words.negotiable')}}</label>
                                            <select name="negotiable"
                                                    class="form-control @error('negotiable') is-invalid @enderror">
                                                <option value="" selected>{{__('words.choose')}}</option>
                                                <option
                                                    @if($show_ad->negotiable==1)
                                                    selected
                                                    @endif
                                                    value="1">{{__('words.accepted')}}
                                                </option>
                                                <option
                                                    @if($show_ad->negotiable==0)
                                                    selected
                                                    @endif
                                                    value="0">{{__('words.not_accepted')}}
                                                </option>
                                            </select>
                                            @error('negotiable')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>{{__('words.negotiable')}}</label>
                                                <select name="negotiable" value="{{$show_ad->negotiable}}"
                                                        class="form-control @error('negotiable') is-invalid @enderror">
                                                    <option
                                                        value="1">{{__('words.accepted')}}
                                                    </option>
                                                    <option
                                                        value="0">{{__('words.not_accepted')}}
                                                    </option>
                                                </select>
                                                @error('negotiable')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>{{__('words.price')}}</label>
                                                <input type="text" name="price" value="{{$show_ad->price}}"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       placeholder="{{__('words.price')}}">
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                @enderror
                                            </div>


                                            {{--                                <div class="form-group col-md-4">--}}
                                            {{--                                    <label>{{__('words.year_founded')}}</label>--}}
                                            {{--                                    <input type="text" name="year_founded" id="year_founded"--}}
                                            {{--                                           class="form-control @error('year_founded') is-invalid @enderror"--}}
                                            {{--                                           placeholder="{{__('words.year_founded')}}">--}}

                                            {{--                                    @error('year_founded')--}}
                                            {{--                                    <span class="invalid-feedback" role="alert">--}}
                                            {{--                                            <strong>{{ $message }}</strong>--}}
                                            {{--                                        </span>--}}
                                            {{--                                    @enderror--}}
                                            {{--                                </div>--}}
                                            {{--                            </div>--}}

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label>{{__('words.country')}}</label>
                                                    <select name="country_id"
                                                            class="form-control country_id @error('country_id') is-invalid @enderror">
                                                        {{--                                            <option value="" selected>{{__('words.choose')}}</option>--}}
                                                        @foreach($countries as $country)
                                                            <option
                                                                @if($show_ad->country_id==$country->id)
                                                                selected
                                                                @endif
                                                                value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country_id')
                                                    <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>{{__('words.city')}}</label>
                                                    <select name="city_id"
                                                            class="form-control city_id @error('city_id') is-invalid @enderror">
                                                        @foreach($cities as $city)

                                                            <option
                                                                @if($show_ad->city_id==$city->id)
                                                                selected
                                                                @endif
                                                                value="{{$city->id}}">{{$city->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('city_id')
                                                    <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>{{__('words.area')}}</label>
                                                    <select name="area_id" id="area_id"
                                                            class="form-control area_id @error('area_id') is-invalid @enderror">
                                                        @foreach($areas as $area)

                                                            <option
                                                                @if($show_ad->area_id==$area->id)
                                                                selected
                                                                @endif
                                                                value="{{$area->id}}">{{$area->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('area_id')
                                                    <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="available"
                                                               @if($show_ad->available)
                                                               checked
                                                               @endif
                                                               type="checkbox">
                                                        <label class="form-check-label">
                                                            {{__('words.activity')}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('organization.ads.index')}}"
                                           class="btn btn-outline-danger">{{__('words.back')}}</a>
                                        <button type="submit" data-toggle="update_modal"
                                                class="btn btn-outline-primary">{{__('words.update')}}</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        window.onload = function () {
            //Check File API support
            if (window.File && window.FileList && window.FileReader) {
                var filesInput = document.getElementById("files");
                // console.log(filesInput.value);
                filesInput.addEventListener("change", function (event) {

                    var files = event.target.files; //FileList object
                    document.getElementById("result").innerHTML = "";
                    var output = document.getElementById("result");

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        //Only pics
                        if (!file.type.match('image'))
                            continue;
                        var picReader = new FileReader();
                        picReader.addEventListener("load", function (event) {
                            var picFile = event.target;
                            var div = document.createElement("div");
                            div.innerHTML = "<img class='img-thumbnail w-100' src='" + picFile.result + "'" +
                                "title='" + picFile.name + "'/>";
                            output.insertBefore(div, null);
                        });
                        //Read the image
                        picReader.readAsDataURL(file);
                    }
                });
            } else {
                console.log("Your browser does not support File API");
            }
            document.getElementById('close').onclick = function () {
                this.parentNode.parentNode.parentNode
                    .removeChild(this.parentNode.parentNode);
                return false;
            };
        }

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
        {{--    <script>--}}
        {{--        $(".multi-select").select2()--}}
        {{--    </script>--}}
    </script>
@endsection
