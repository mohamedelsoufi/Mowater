<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editTrainer" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editBrokerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editTrainerLabel">{{__('words.show_driving_trainer')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="trainer_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_ar')}}</label>
                                    <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar') }}"
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
                                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
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
                                    <label>{{__('words.notes_ar')}}</label>
                                    <textarea name="description_ar" id="description_ar"
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
                                    <label>{{__('words.notes_ar')}}</label>
                                    <textarea name="description_en" id="description_en"
                                              class="form-control ckeditor @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>

                                    @error('description_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 ">
                                    <label>{{__('words.birth_date')}}</label>
                                    <input class="form-control birth_date" type="date" id="birth_date" name="birth_date">
                                    @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4  gender_display">
                                    <label>{{__('words.gender')}}</label>
                                    <select name="gender" id="gender"
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
                            <div class="form-row">
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
                            <div class=" files">
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
                            <div class="form-row">
                                <div class="form-group col-md-6">
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
                                <div class="form-group col-md-6">
                                    <label>{{__('words.conveyor_type')}}</label>
                                    <select name="conveyor_type" id="conveyor_type"
                                            class="form-control conveyor_type @error('conveyor_type') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
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
                                </div>

                                <div class="form-group d-none brands col-md-6">
                                    <label>{{__('words.brand')}}</label>
                                    <select name="brand_id" class="form-control brands brand_id"
                                            @error('brand_id') is-invalid @enderror>
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
                                </div>
                                {{-- car_model --}}
                                <div class="form-group col-md-6">
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
                                {{-- car_class --}}
                                <div class="form-group col-md-6">
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

                                <div class="form-group col-md-6 ">
                                    <label>{{__('words.manufacture_year')}}</label>
                                    <input type="text" name="manufacturing_year" id="manufacturing_year"
                                           class="yearpicker form-control @error('manufacturing_year') is-invalid @enderror"
                                           value="{{ old('manufacturing_year') }}" placeholder="">
                                    @error('manufacturing_year')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4 ">
                                    <label>{{__('words.hour_price')}}</label>
                                    <input type="text" name="hour_price" id="hour_price" disabled
                                           class="form-control @error('hour_price') is-invalid @enderror"
                                    >
                                    @error('hour_price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="active" name="active"
                                               type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.activity')}}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Organization user start --}}
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('words.email')}}</label>
                                    <select name="organization_user_id"
                                            class="form-control email-change @error('email') is-invalid @enderror">
                                    </select>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('words.user_name')}}</label>
                                    <input type="text" name="user_name"
                                           class="form-control username @error('user_name') is-invalid @enderror"
                                           value="{{ old('user_name') }}" placeholder="{{__('words.user_name')}}">

                                    @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('words.password')}}</label>
                                    <input type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           value="{{ old('password') }}" placeholder="{{__('words.password')}}">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('words.confirm_password')}}</label>
                                    <input type="password" name="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           value="{{ old('password_confirmation') }}" placeholder="{{__('words.confirm_password')}}">

                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Organization user end --}}

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{__('words.close')}}
                    </button>
                    <button type="submit" class="btn btn-outline-primary">{{__('words.update')}}</button>
                </div>


            </form>
        </div>
    </div>
</div>
