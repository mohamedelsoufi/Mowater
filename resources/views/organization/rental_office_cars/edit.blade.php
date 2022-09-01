<!-- Modal -->
<div class="modal fade" id="update_rental_office_car" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="update_rental_office_carLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="update_rental_office_carLabel">{{__('words.edit_rental_office_car')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="rental_car_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.vehicle_type')}}</label>
                                    <select name="vehicle_type"
                                            class="form-control vehicle_type @error('vehicle_type') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        @foreach(vehicle_type_arr() as $key=>$val)
                                            <option value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 d-none ghamara_count">
                                    <label>{{__('vehicle.ghamara_count')}}</label>
                                    <select name="ghamara_count"
                                            class="form-control ghamara_val @error('ghamara_count') is-invalid @enderror">
                                        @foreach(ghamara_count_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('ghamara_count')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                {{-- brand --}}
                                <div class="form-group col-md-6">
                                    <label>{{__('words.brand')}}</label>
                                    <select name="brand_id" class = "form-control brand_id" id = "brand_id">
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
                                    <select name="car_model_id" id = "car_model_id" class = "form-control car_model_id @error('car_model_id') is-invalid @enderror">
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
                                    <select name="car_class_id" id = "car_class_id" class = "form-control @error('car_class_id') is-invalid @enderror">
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

                                <div class="form-group col-md-6">
                                    <label>{{__('words.manufacture_year')}}</label>
                                    <input type="text" name="manufacture_year" id = "manufacture_year" class="yearpicker form-control @error('manufacture_year') is-invalid @enderror" value="" placeholder="">
                                    @error('manufacture_year')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label>{{__('words.color')}}</label>
                                    <input type="text" name="color" id = "color" class="form-control @error('color') is-invalid @enderror" value="" placeholder="">
                                    @error('color')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.daily_rental_price')}}</label>
                                    <input type="number" name="daily_rental_price" id = "daily_rental_price" class="form-control @error('daily_rental_price') is-invalid @enderror" value="" placeholder="">
                                    @error('daily_rental_price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.weekly_rental_price')}}</label>
                                    <input type="number" name="weekly_rental_price" id = "weekly_rental_price" class="form-control @error('weekly_rental_price') is-invalid @enderror" value="" placeholder="">
                                    @error('weekly_rental_price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.monthly_rental_price')}}</label>
                                    <input type="number" name="monthly_rental_price" id = "monthly_rental_price" class="form-control @error('monthly_rental_price') is-invalid @enderror" value="" placeholder="">
                                    @error('monthly_rental_price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.yearly_rental_price')}}</label>
                                    <input type="number" name="yearly_rental_price" id = "yearly_rental_price" class="form-control @error('yearly_rental_price') is-invalid @enderror" value="" placeholder="">
                                    @error('yearly_rental_price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.available')}}</label>
                                    <input type="checkbox" name="available" id = "available" class=" @error('available') is-invalid @enderror" >
                                    @error('available')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{__('words.close')}}
                    </button>
                    <button type="submit" class="btn btn-outline-primary">{{__('words.edit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
