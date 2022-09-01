<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editOrganization" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editOrganizationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary"
                    id="editOrganizationLabel">{{__('words.show_org_data')}}{{$record->name}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="organization_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_ar')}}</label>
                                    <input type="text" name="name_ar" id="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                           placeholder="{{__('words.name_ar')}}">
                                    @error('name_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_en')}}</label>
                                    <input type="text" name="name_en" id="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           placeholder="{{__('words.name_en')}}">

                                    @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row desc">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.description_ar')}}</label>
                                    <textarea name="description_ar" id="description_ar"
                                              class="form-control @error('description_ar') is-invalid @enderror"></textarea>

                                    @error('description_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row desc">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.description_en')}}</label>
                                    <textarea name="description_en" id="description_en"
                                              class="form-control @error('description_en') is-invalid @enderror"></textarea>

                                    @error('description_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row address d-none">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.address_ar')}}</label>
                                    <input type="text" name="address_ar" id="address_ar"
                                           class="form-control @error('address_ar') is-invalid @enderror"
                                           value="{{ old('address_ar') }}" placeholder="{{__('words.address_ar')}}">
                                    @error('address_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.address_en')}}</label>
                                    <input type="text" name="address_en" id="address_en"
                                           class="form-control @error('address_en') is-invalid @enderror"
                                           value="{{ old('address_en') }}" placeholder="{{__('words.address_en')}}">

                                    @error('address_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="fuel_station d-none">
                                <hr>
                                <h6>{{__('words.fuel_types')}}</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="Gasoline_91">{{__('words.Gasoline_91')}}</label>
                                        <input type="checkbox" name="fuel_types[]" id="Gasoline_91" value="Gasoline_91">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="Gasoline_95">{{__('words.Gasoline_95')}}</label>
                                        <input type="checkbox" name="fuel_types[]" id="Gasoline_95" value="Gasoline_95">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="Gasoline_98">{{__('words.Gasoline_98')}}</label>
                                        <input type="checkbox" name="fuel_types[]" id="Gasoline_98" value="Gasoline_98">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="Diesel">{{__('words.Diesel')}}</label>
                                        <input type="checkbox" name="fuel_types[]" id="Diesel" value="Diesel">
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="d-none requirements">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>{{__('words.requirements_ar')}}</label>
                                        <textarea name="requirements_ar" id="requirements_ar"
                                                  class="form-control ckeditor @error('requirements_ar') is-invalid @enderror"></textarea>

                                        @error('requirements_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>{{__('words.requirements_en')}}</label>
                                        <textarea name="requirements_en" id="requirements_en"
                                                  class="form-control ckeditor @error('requirements_en') is-invalid @enderror"></textarea>

                                        @error('requirements_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row d-none birth_date">
                                <div class="form-group col-md-6 ">
                                    <label>{{__('words.birth_date')}}</label>
                                    <input type="text" class=" birth_date datepicker-default form-control"
                                           name="birth_date"
                                           placeholder="{{__('words.birth_date')}}"
                                           id="datepicker">
                                    @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 d-none gender_display">
                                    <label>{{__('words.gender')}}</label>
                                    <select name="gender"
                                            class="form-control gender @error('gender') is-invalid @enderror">
                                        {{--                                    <option value="" selected>{{__('words.choose')}}</option>--}}
                                        <option
                                            value="female">{{__('words.female')}}</option>
                                        <option
                                            value="male">{{__('words.male')}}</option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row d-none logo">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.logo')}}</label>
                                    <input type="file" name="logo"
                                           class="form-control image @error('logo') is-invalid @enderror"
                                           placeholder="{{__('words.logo')}}">
                                    @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6 text-center pt-3">
                                    <img src="{{ asset('uploads/default_image.png') }}" id="logo"
                                         class="slider_image image-preview" alt="logo">
                                </div>
                            </div>
                            <div class="form-row d-none profile_picture">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.profile_picture')}}</label>
                                    <input type="file" name="profile_picture"
                                           class="form-control image @error('profile_picture') is-invalid @enderror"
                                           placeholder="{{__('words.profile_picture')}}">
                                    @error('profile_picture')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6 text-center pt-3">
                                    <img src="{{ asset('uploads/default_image.png') }}" id="profile_picture"
                                         class="slider_image image-preview" alt="profile_picture">
                                </div>
                            </div>
                            <div class="d-none files">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>{{__('words.license')}}</label>
                                        <input type="file" name="image"
                                               class="form-control license @error('license') is-invalid @enderror"
                                               placeholder="{{__('words.license')}}">
                                        @error('license')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-6 text-center pt-3">
                                        <img src="{{ asset('uploads/default_image.png') }}" id="license"
                                             class="slider_image license-preview" alt="license">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.country')}}</label>
                                    <select name="country_id"
                                            class="form-control country_id @error('country_id') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        @foreach($countries as $country)
                                            <option
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
                                    </select>
                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{__('words.area')}}</label>
                                    <select name="area_id"
                                            class="form-control area_id @error('area_id') is-invalid @enderror">
                                    </select>
                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row coordinates d-none">
                                    <div class="form-group col-md-4">
                                        <label class="coordinate_text" onclick="getLocation()">{{__('words.click_here_to_get_your_coordinates')}}</label>

                                        <p id="demo"></p>
                                    </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.latitude')}}</label>
                                    <input type="number" step="0.000000000000000001" name="latitude" id="latitude"
                                           class="form-control @error('latitude') is-invalid @enderror"
                                           placeholder="{{__('words.latitude')}}">
                                    @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.longitude')}}</label>
                                    <input type="number" step="0.000000000000000001" name="longitude" id="longitude"
                                           class="form-control @error('longitude') is-invalid @enderror"
                                           placeholder="{{__('words.longitude')}}">
                                    @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>

                            @if(isset($categories))
                                <div class="form-row">
                                    <div class="form-group d-none categories col-md-4">
                                        <label>{{__('words.category')}}</label>
                                        <select name="category_id" class="form-control categories "
                                                id="category_id">
                                            <option value="">{{__('words.category')}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-row d-none car_details"><label>{{__('words.car_details')}}: </label>
                            </div>
                            <div class="form-row ">
                                <div class="form-group col-md-6 vehicle_type d-none">
                                    <label>{{__('words.vehicle_type')}}</label>
                                    <select name="vehicle_type" id="vehicle_type"
                                            class="form-control vehicle_type @error('vehicle_type') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        <option
                                            value="cars">{{__('vehicle.cars')}}</option>
                                        <option
                                            value="motorcycles">{{__('vehicle.motorcycles')}}</option>
                                        <option
                                            value="pickups">{{__('vehicle.pickups')}}</option>
                                    </select>
                                    @error('vehicle_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{--                                <div class=" conveyor_type_display">--}}
                                <div class="form-group col-md-6 conveyor_type">
                                    <label>{{__('words.conveyor_type')}}</label>
                                    <select name="conveyor_type" id="conveyor_type"
                                            class="form-control conveyor_type @error('conveyor_type') is-invalid @enderror">
                                        <option value="" selected>{{__('words.conveyor_type')}}</option>
                                        <option
                                            value="automatic">{{__('words.automatic')}}</option>
                                        <option
                                            value="manual">{{__('words.manual')}}</option>
                                    </select>
                                    @error('conveyor_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    {{--                                    </div>--}}
                                </div>

                                {{-- car_class --}}
                                <div class="form-group car_classes  d-none col-md-6">
                                    <label>{{__('words.car_class')}}</label>
                                    <select name="car_class_id" id="car_class_id"
                                            class="form-control @error('car_class_id') is-invalid @enderror">
                                        <option value="">{{__('words.car_class')}}</option>
                                        @foreach($car_classes as $car_class)
                                            <option value="{{$car_class->id}}">{{$car_class->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('car_class_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group d-none brands col-md-4">
                                    <label>{{__('words.brand')}}</label>
                                    <select name="brand_id" class="form-control brands brand_id" id="brand_id">
                                        <option value="">{{__('words.brand')}}</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>{{-- car_model --}}
                                <div class="form-group col-md-4 car_models d-none">
                                    <label>{{__('words.car_model')}}</label>
                                    <select name="car_model_id" id="car_model_id"
                                            class="form-control car_model_id @error('car_model_id') is-invalid @enderror">
                                        <option value="">{{__('words.car_model')}}</option>
                                    </select>
                                    @error('car_model_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 d-none manufacturing_year">
                                    <label>{{__('words.manufacture_year')}}</label>
                                    <input type="text" name="manufacturing_year" id="manufacturing_year"
                                           class="yearpicker form-control @error('manufacture_year') is-invalid @enderror"
                                           value="" placeholder="">
                                    @error('manufacture_year')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4 hour_price d-none">
                                    <label>{{__('words.hour_price')}}</label>
                                    <input type="text" name="hour_price" id="hour_price"
                                           class="form-control @error('hour_price') is-invalid @enderror" disabled
                                           placeholder="{{__('words.hour_price')}}">
                                    @error('hour_price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 d-none tax_number ">
                                    <label>{{__('words.tax_number')}}</label>
                                    <input type="text" name="tax_number" id="tax_number"
                                           class="form-control @error('tax_number') is-invalid @enderror"
                                           placeholder="{{__('words.tax_number')}}">
                                    @error('tax_number')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 d-none year_founded">
                                    <label>{{__('words.year_founded')}}</label>
                                    <input type="text" name="year_founded" id="year_founded"
                                           class="yearpicker form-control @error('year_founded') is-invalid @enderror"
                                           value="" placeholder="">
                                    @error('year_founded')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row ">
{{--                                <div class="form-group col-md-4 d-none reservation_active">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" id="reservation_active"--}}
{{--                                               name="reservation_active"--}}
{{--                                               value="0"--}}
{{--                                               type="checkbox">--}}
{{--                                        <label class="form-check-label">--}}
{{--                                            {{__('words.reservation_active')}}--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group col-md-4 d-none reservation_availability">
                                    <div class="form-check">
                                        <input class="form-check-input" id="reservation_availability"
                                               name="reservation_availability" value="0"
                                               type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.reservation_availability')}}
                                        </label>
                                    </div>
                                </div>
{{--                                <div class="form-group col-md-4 d-none delivery_active">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" id="delivery_active" name="delivery_active"--}}
{{--                                               value="0"--}}
{{--                                               type="checkbox">--}}
{{--                                        <label class="form-check-label">--}}
{{--                                            {{__('words.delivery_active')}}--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group col-md-4 d-none delivery_availability">
                                    <div class="form-check">
                                        <input class="form-check-input" id="delivery_availability"
                                               name="delivery_availability" value="0"
                                               type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.delivery_availability')}}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 ">
                                    <div class="form-check">
                                        <input class="form-check-input" id="available" name="available" value="0"
                                               type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.available')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger"
                                    data-dismiss="modal">{{__('words.close')}}
                            </button>
                            <button type="submit" class="btn btn-outline-primary">{{__('words.update')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

