@extends('organization.layouts.app')
@section('title','Mawatery | Products')
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            <div class="col-sm-6 p-md-0">
                                <div class="welcome-text">
                                    <h4>{{__('words.new_product')}}</h4>
                                </div>
                            </div>
                        </div>
                        @include('organization.includes.alerts.success')
                        @include('organization.includes.alerts.errors')
                        <form method="POST" action="{{route('organization.products.store')}}" id="store_form"
                              autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.name_ar')}}</label>
                                                <input type="text" name="name_ar"
                                                       class="form-control @error('name_ar') is-invalid @enderror"
                                                       value="{{ old('name_ar') }}"
                                                       placeholder="{{__('words.name_ar')}}">
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>{{__('words.name_en')}}</label>
                                                <input type="text" name="name_en"
                                                       class="form-control @error('name_en') is-invalid @enderror"
                                                       value="{{ old('name_en') }}"
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
                                                          class="form-control ckeditor @error('description_ar') is-invalid @enderror">{{ old('description_ar') }}</textarea>

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
                                                          class="form-control ckeditor @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>

                                                @error('description_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

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

                                        <div class="form-row">
                                            <output id='result' class="row"/>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>{{__('words.category')}}</label>
                                                <select name="category_id" id="category_id"
                                                        class="form-control category_id @error('category_id') is-invalid @enderror">
                                                    <option value="" selected>{{__('words.choose')}}</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            {{ old('category_id') == $category->id ? "selected" : "" }}
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
                                        <div class="form-row {{$model_type = 'App\\Models\\Agency' ? 'd-none' :''}}">
                                            <div class="form-group col-md-4">
                                                <label>{{__('words.type')}}</label>
                                                <select name="type"
                                                        class="form-control @error('type') is-invalid @enderror">
                                                    <option value="" selected>{{__('words.choose')}}</option>
                                                    {{--                                                                @foreach($brands as $brand)--}}
                                                    <option {{ old("type") == "commercial" ? "selected" : "" }}
                                                            value="commercial">{{__('words.commercial')}}
                                                    </option>
                                                    <option {{ old("type") == "original" ? "selected" : "" }}
                                                            value="original" selected>{{__('words.original')}}
                                                    </option>
                                                    {{--                                                                @endforeach--}}
                                                </select>
                                                @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- check if is new type --}}

                                        <div class="form-row">
                                            {{-- check if is new start --}}
                                            <div
                                                class="form-group col-md-4 {{$model_type = 'App\\Models\\Agency' ? 'd-none' :''}}">
                                                <label>{{__('words.product_is_new')}}</label>
                                                <select name="is_new"
                                                        class="form-control @error('is_new') is-invalid @enderror">
                                                    <option {{ old("is_new") == "1" ? "selected" : "" }}
                                                            value="1" selected>{{__('words.new')}}
                                                    </option>
                                                    <option {{ old("is_new") == "0" ? "selected" : "" }}
                                                            value="0">{{__('words.used')}}
                                                    </option>
                                                    {{--                                                                @endforeach--}}
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
                                                <input type="number" name="price" step="0.01" min="0"  value="{{old('price')}}"
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
                                                class="form-group col-md-4 {{$model_type = 'App\\Models\\Agency' ? 'd-none' :''}}">
                                                <label>{{__('words.status')}}</label>

                                                <select name="status"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                    @foreach(g_status_arr() as $key=>$val)
                                                        <option {{ old('status') == $key ? "selected" : "" }}
                                                                value="{{$key}}">{{$val}}</option>
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
                                                       value="{{old('warranty_value')}}"
                                                       class="form-control @error('warranty_value') is-invalid @enderror"
                                                       placeholder="{{__('words.product_warranty')}}">
                                                @error('warranty_value')
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
                                                        {{ old('discount_availability') == '0' ? "selected" : "" }} value="0">
                                                        {{__('words.not_available_prop')}}
                                                    </option>
                                                    <option
                                                        {{ old('discount_availability') == '1' ? "selected" : "" }} value="1">
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
                                                           value="{{old('discount')}}"
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
                                                            {{old('discount_type') == 'percentage' ? 'selected' : ''}}
                                                            value="percentage">{{__('words.percentage')}}</option>
                                                        <option
                                                            {{old('discount_type') == 'amount' ? 'selected' : ''}}
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
                                                    <input class="form-check-input" name="available" value="0"
                                                           type="checkbox">
                                                    <label class="form-check-label">
                                                        {{__('words.availability')}}
                                                    </label>
                                                </div>
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
                                                    <input class="form-check-input"
                                                           name="car_models[{{$i}}]"
                                                           value="{{$car_models[$i]->id}}"
                                                           type="checkbox">
                                                    <label class="form-check-label">
                                                        {{$car_models[$i]->name}}
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="text" name="manufacturing_years[{{$i}}]"
                                                           style="width: 179px;margin-left: 173px;"
                                                           value="{{old('manufacturing_years[]')}}"
                                                           class="form-control man_place @error('manufacturing_years') is-invalid @enderror"
                                                           placeholder="ex:2011,1991,2020">
                                                    @error('manufacturing_years')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        @endfor
                                        @error('car_models')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer">

                                <a href="{{route('organization.products.index')}}"
                                   class="btn btn-outline-danger">{{__('words.back')}}</a>
                                <button type="submit"
                                        class="btn btn-outline-primary">{{__('words.create')}}</button>
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

    <script>

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
                        data.data.sub_categories.forEach(function (sub_category) {
                            var option = `<option value ="${sub_category.id}">${sub_category.name}</option>`;
                            $('#sub_category_id').append(option);
                        });

                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

        $('#discount_availability').on('change', function () {
            if ($(this).val() == '1') {
                $('#discount').removeClass('d-none');
            } else {
                $('#discount').addClass('d-none');
            }
        });
    </script>
@endsection

