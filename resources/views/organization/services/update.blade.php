@extends('organization.layouts.app')
@section('title','Mawatery | Services')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.services')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.services')}}</li>
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
                                    <h4>{{__('words.show_service')}}</h4>
                                </div>
                            </div>
                        </div>
                        @include('organization.includes.alerts.success')
                        @include('organization.includes.alerts.errors')
                        <form method="POST" action="{{route('organization.services.update',$show_service->id)}}"
                              autocomplete="off"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{$show_service->id}}">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.name_ar')}}</label>
                                                <input type="text" name="name_ar" value="{{$show_service->name_ar}}"
                                                       class="form-control @error('name_ar') is-invalid @enderror"
                                                       placeholder="{{__('words.name_ar')}}">
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>{{__('words.name_en')}}</label>
                                                <input type="text" name="name_en" value="{{$show_service->name_en}}"
                                                       class="form-control @error('name_en') is-invalid @enderror"
                                                       placeholder="{{__('words.name_en')}}">

                                                @error('name_en')
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
                                                          class="form-control ckeditor @error('description_ar') is-invalid @enderror">{{$show_service->description_ar}}</textarea>

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
                                                          value="{{$show_service->description_en}}"
                                                          class="form-control ckeditor @error('description_en') is-invalid @enderror">{{$show_service->description_en}}</textarea>

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
                                            <div class="form-row col-md-3">
                                                <output id='result' class="row"/>
                                            </div>

                                            @foreach($show_service->files as $file)
                                                <div class="form-row col-md-3">
                                                    <div class="rounded border m-1">
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
                                                </div>
                                            @endforeach
                                            <div id="deleted_images"></div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>{{__('words.category')}}</label>
                                                <select name="category_id" id="category_id"
                                                        class="form-control category_id @error('category_id') is-invalid @enderror">
                                                    <option value="" selected>{{__('words.choose')}}</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            @if($category->id==$show_service->category_id)
                                                            selected
                                                            @endif
                                                            value="{{$category->id}}">{{$category->name}}</option>

                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>{{__('words.price')}}</label>
                                                <input type="number" name="price" step="0.01" min="0"
                                                       value="{{$show_service->price}}"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       placeholder="{{__('words.price')}}">
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>{{__('words.discount_availability')}}</label>
                                                <select name="discount_availability" id="discount_availability"
                                                        class="form-control @error('discount_availability') is-invalid @enderror">
                                                    <option
                                                        {{ $show_service->discount_availability == '0' ? "selected" : "" }} value="0">
                                                        {{__('words.not_available_prop')}}
                                                    </option>
                                                    <option
                                                        {{  $show_service->discount_availability == '1' ? "selected" : "" }} value="1">
                                                        {{__('words.available_prop')}}
                                                    </option>
                                                </select>
                                                @error('colors[]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div id="discount" class="col-md-8 form-row d-none">
                                                <div class="form-group col-md-6">
                                                    <label>{{__('words.discount_value')}}</label>
                                                    <input type="number" name="discount" step="0.01" min="0"
                                                           value="{{ $show_service->discount}}"
                                                           class="form-control @error('discount') is-invalid @enderror"
                                                           placeholder="{{__('words.discount_value')}}">
                                                    @error('discount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>{{__('words.discount_type')}}</label>
                                                    <select name="discount_type"
                                                            class="form-control @error('discount_type') is-invalid @enderror">
                                                        <option
                                                            {{$show_service->discount_type == 'percentage' ? 'selected' : ''}}
                                                            value="percentage">{{__('words.percentage')}}</option>
                                                        <option
                                                            {{$show_service->discount_type == 'amount' ? 'selected' : ''}}
                                                            value="amount">{{__('words.amount')}}</option>
                                                    </select>
                                                    @error('discount_type')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="available"
                                                           @if($show_service->available)
                                                           checked
                                                           @endif
                                                           type="checkbox">
                                                    <label class="form-check-label">
                                                        {{__('words.availability')}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">

                                <a href="{{route('organization.services.index')}}"
                                   class="btn btn-outline-danger">{{__('words.back')}}</a>
                                <button type="submit"
                                        class="btn btn-outline-primary">{{__('words.update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('scripts')
    @include('organization.includes.change_files')

    <script type="text/javascript">
        $(window).on('load', function () {
            if ($('#discount_availability').val() == '1') {
                $('#discount').removeClass('d-none');
            }

        });

        $('#discount_availability').on('change', function () {
            if ($(this).val() == '1') {
                $('#discount').removeClass('d-none');
            } else {
                $('#discount').addClass('d-none');
            }
        });

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


