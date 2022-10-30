@extends('organization.layouts.app')
@section('title','Mawatery | products')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.products')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.products')}}</li>
                    </ol>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @include('organization.includes.alerts.success')
            @include('organization.includes.alerts.errors')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            <div class="col-sm-6 p-md-0">
                                <div class="welcome-text">
                                    <h4>{{__('words.show_product')}}</h4>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{route('organization.products.update',$show_product->id)}}"
                              autocomplete="off"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" name="id" value="{{$show_product->id}}">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.name_ar')}}</label>
                                                <input type="text" name="name_ar" value="{{$show_product->name_ar}}"
                                                       class="form-control @error('name_ar') is-invalid @enderror"
                                                       placeholder="{{__('words.name_ar')}}">
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror                                </div>

                                            <div class="form-group col-md-6">
                                                <label>{{__('words.name_en')}}</label>
                                                <input type="text" name="name_en" value="{{$show_product->name_en}}"
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
                                                          class="form-control @error('description_ar') is-invalid @enderror">{{$show_product->description_ar}}</textarea>

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
                                                          value="{{$show_product->description_en}}"
                                                          class="form-control @error('description_en') is-invalid @enderror">{{$show_product->description_en}}</textarea>

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


                                            @foreach($show_product->files as $file)
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
                                                            @if($category->id==$show_product->category_id)
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
                                                <label>{{__('words.sub_category')}}</label>
                                                <select name="sub_category_id" id="sub_category_id"
                                                        class="form-control sub_category_id @error('sub_category_id') is-invalid @enderror">
                                                    <option value="">{{__('words.sub_category')}}</option>

                                                </select>
                                                @error('sub_category_id')
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- check if is new type --}}
                                        <div class="form-row {{$model_type == 'App\\Models\\Agency' ? 'd-none' :''}}">
                                            <div class="form-group col-md-4">
                                                <label>{{__('words.type')}}</label>
                                                <select name="type" value="{{$show_product->type}}"
                                                        class="form-control @error('type') is-invalid @enderror">
                                                    {{--                                            <option value="" >{{__('words.choose')}}</option>--}}
                                                    <option @if($show_product->type=="commercial")
                                                            selected
                                                            @endif
                                                            value="commercial">{{__('words.commercial')}}
                                                    </option>
                                                    <option @if($show_product->type=="original")
                                                            selected
                                                            @endif
                                                            value="original">{{__('words.original')}}
                                                    </option>
                                                </select>
                                                @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- check if is new type --}}
                                    </div>
                                    <div class="form-row">
                                        {{-- check if is new start --}}
                                        <div
                                            class="form-group col-md-4 {{$model_type == 'App\\Models\\Agency' ? 'd-none' :''}}">
                                            <label>{{__('words.product_is_new')}}</label>
                                            <select name="is_new" value="{{$show_product->is_new}}"
                                                    class="form-control @error('is_new') is-invalid @enderror">
                                                <option value="" selected>{{__('words.choose')}}</option>
                                                <option
                                                    value="1" {{$show_product->is_new ? 'selected' : ''}}>{{__('words.new')}}</option>
                                                <option
                                                    value="0" {{!$show_product->is_new ? 'selected' : ''}}>{{__('words.used')}}</option>

                                            </select>
                                            @error('is_new')
                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                            @enderror
                                        </div>
                                        {{-- check if is new end --}}

                                        <div class="form-group col-md-4">
                                            <label>{{__('words.price')}}</label>
                                            <input type="number" name="price" step="0.01" min="0"
                                                   value="{{$show_product->price}}"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   placeholder="{{__('words.price')}}">
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                            @enderror
                                        </div>

                                        {{-- check if is new status --}}
                                        <div
                                            class="form-group col-md-4 {{$model_type == 'App\\Models\\Agency' ? 'd-none' :''}}">
                                            <label>{{__('words.status')}}</label>
                                            <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror">
                                                @foreach(g_status_arr() as $key=>$val)
                                                    <option {{ old('status') == $key ? "selected" : "" }}
                                                            value="{{$key}}" {{$show_product->status == $key ? 'selected' : ''}}>{{$val}}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                            @enderror
                                        </div>
                                        {{-- check if is new status --}}

                                        <div class="form-group col-md-4">
                                            <label>{{__('words.product_warranty')}}</label>
                                            <input type="text" name="warranty_value"
                                                   value="{{$show_product->warranty_value}}"

                                                   class="form-control @error('warranty_value') is-invalid @enderror"
                                                   placeholder="{{__('words.product_warranty')}}">
                                            @error('warranty_value')
                                            <span class="iinvalid-feedback" role="alert">
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
                                                    {{ $show_product->discount_availability == '0' ? "selected" : "" }} value="0">
                                                    {{__('words.not_available_prop')}}
                                                </option>
                                                <option
                                                    {{  $show_product->discount_availability == '1' ? "selected" : "" }} value="1">
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
                                                       value="{{ $show_product->discount}}"
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
                                                        {{$show_product->discount_type == 'percentage' ? 'selected' : ''}}
                                                        value="percentage">{{__('words.percentage')}}</option>
                                                    <option
                                                        {{$show_product->discount_type == 'amount' ? 'selected' : ''}}
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
                                                       @if($show_product->available)
                                                       checked
                                                       @endif
                                                       type="checkbox">
                                                <label class="form-check-label">
                                                    {{__('words.availability')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row col-md-12">
                                            <label>{{__('words.product_car_model')}}</label>
                                        </div>
                                        @for($i=0;$i<count($car_models);$i++)
                                            <div class="form-row col-md-4" style="display:inline-block;">
                                                <div class="col-md-6" style="display:inline-block;">
                                                    <input class="form-check-input" name="car_models[{{$i}}]"
                                                           value="{{$car_models[$i]->id}}"
                                                           type="checkbox"
                                                        {{ in_array($car_models[$i]->id,$show_product->car_models->pluck('id')->toArray()) ? 'checked' : ''}}>
                                                    <label class="form-check-label">
                                                        {{$car_models[$i]->name}}
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="text" name="manufacturing_years[{{$i}}]"
                                                           id="man_place"
                                                           style="width: 179px;margin-left: 173px;"
                                                           value="{{in_array($car_models[$i]->id ,  $show_product->car_models->pluck('id')->toArray()) ?   $show_product->car_models()->where('car_models.id',$car_models[$i]->id)->first()->pivot->manufacturing_years : '' }}"
                                                           class="form-control @error('manufacturing_years') is-invalid @enderror"
                                                           placeholder="ex: 2011,1991,2020">
                                                </div>
                                            </div>

                                        @endfor
                                        @error('car_models')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    @error('$car_model')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                </div>
                            </div>
                            <div class="modal-footer">

                                <a href="{{route('organization.products.index')}}"
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
@endsection
@section('scripts')
    @include('organization.includes.change_files')

    <script type="text/javascript">
        $(window).on('load', function () {
            get_sub_category_data($('#category_id').val());
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

        $('#category_id').on('change', function () {
            get_sub_category_data($(this).val());
        });

        function get_sub_category_data(id) {
            var url = "{{route('organization.products.sub_category' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        $('#sub_category_id').empty();
                        let equal;
                        data.data.sub_categories.forEach(function (sub_category) {
                            equal = "{{$show_product->sub_category_id}}" == sub_category.id ? "selected" : "";
                            var option = `<option value ="${sub_category.id}" ${equal}>${sub_category.name}</option>`;
                            $('#sub_category_id').append(option);
                        });

                    }
                },
                // error: function (reject) {
                //     alert(reject);
                // }
            });
        }
    </script>
@endsection


