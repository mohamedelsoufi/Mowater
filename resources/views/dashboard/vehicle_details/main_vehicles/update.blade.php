<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editMainVehicle" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editMainVehicleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editMainVehicleLabel">{{__('words.show_main_vehicle')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="main_vehicle_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
{{--                                <div class="form-group col-md-3">--}}
{{--                                    <label>{{__('vehicle.vehicle_type')}}</label>--}}
{{--                                    <select type="text" name="vehicle_type" id="vehicle_type"--}}
{{--                                            class="form-control @error('vehicle_type') is-invalid @enderror">--}}
{{--                                        <option value="trucks">{{__('vehicle.trucks')}}</option>--}}
{{--                                        <option value="pickups">{{__('vehicle.pickups')}}</option>--}}
{{--                                        <option value="cars">{{__('vehicle.cars')}}</option>--}}
{{--                                        <option value="motorcycles">{{__('vehicle.motorcycles')}}</option>--}}
{{--                                        <option value="cruisers">{{__('vehicle.cruisers')}}</option>--}}
{{--                                    </select>--}}
{{--                                    @error('vehicle_type')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

                                <div class="form-group col-md-3">
                                    <label>{{__('words.vehicle_type')}}</label>
                                    <select name="vehicle_type" id="vehicle_type"
                                            class="form-control @error('vehicle_type') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        @foreach(vehicle_type_arr() as $key=>$val)
                                            <option
                                                value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.brand_id')}}</label>
                                    <select type="text" name="brand_id"
                                            class="form-control brand_id @error('brand_id') is-invalid @enderror">
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.car_model_id')}}</label>
                                    <select name="car_model_id"
                                            class="form-control car_model_id @error('car_model_id') is-invalid @enderror">
                                    </select>
                                    @error('car_model_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.car_class_id')}}</label>
                                    <select id="car_class_id" name="car_class_id"
                                            class="form-control @error('car_class_id') is-invalid @enderror">
                                        @foreach($car_classes as $car_class)
                                            <option
                                                value="{{$car_class->id}}">{{$car_class->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('car_class_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.manufacturing_year')}}</label>
                                    <input type="text" name="manufacturing_year" id="manufacturing_year"
                                           class="form-control @error('manufacturing_year') is-invalid @enderror"
                                           placeholder="{{__('vehicle.manufacturing_year')}}">

                                    @error('manufacturing_year')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.body_shape')}}</label>
                                    <select id="body_shape" name="body_shape"
                                            class="form-control @error('body_shape') is-invalid @enderror">
                                        @foreach(body_shape_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('body_shape')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.engine')}}</label>
                                    <input type="text" name="engine" id="engine"
                                           class="form-control @error('engine') is-invalid @enderror"
                                           placeholder="{{__('vehicle.engine')}}">

                                    @error('engine')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.fuel_type')}}</label>
                                    <select id="fuel_type" name="fuel_type"
                                            class="form-control @error('fuel_type') is-invalid @enderror">
                                        @foreach(fuel_type_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('fuel_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.passengers_number')}}</label>
                                    <input type="text" name="passengers_number" id="passengers_number"
                                           class="form-control @error('passengers_number') is-invalid @enderror"
                                           placeholder="{{__('vehicle.passengers_number')}}">

                                    @error('passengers_number')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.doors_number')}}</label>
                                    <input type="text" name="doors_number" id="doors_number"
                                           class="form-control @error('doors_number') is-invalid @enderror"
                                           placeholder="{{__('vehicle.doors_number')}}">

                                    @error('doors_number')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.start_engine_with_button')}}</label>
                                    <select id="start_engine_with_button" name="start_engine_with_button"
                                            class="form-control @error('start_engine_with_button') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('start_engine_with_button')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.seat_adjustment')}}</label>
                                    <select id="seat_adjustment" name="seat_adjustment"
                                            class="form-control @error('seat_adjustment') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('seat_adjustment')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.steering_wheel')}}</label>
                                    <select id="steering_wheel" name="steering_wheel"
                                            class="form-control @error('steering_wheel') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('steering_wheel')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.ambient_interior_lighting')}}</label>
                                    <select id="ambient_interior_lighting" name="ambient_interior_lighting"
                                            class="form-control @error('ambient_interior_lighting') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('ambient_interior_lighting')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.seat_heating_cooling_function')}}</label>
                                    <select id="seat_heating_cooling_function" name="seat_heating_cooling_function"
                                            class="form-control @error('seat_heating_cooling_function') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('seat_heating_cooling_function')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.remote_engine_start')}}</label>
                                    <select id="remote_engine_start" name="remote_engine_start"
                                            class="form-control @error('remote_engine_start') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('remote_engine_start')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.manual_steering_wheel_tilt_and_movement')}}</label>
                                    <select id="manual_steering_wheel_tilt_and_movement"
                                            name="manual_steering_wheel_tilt_and_movement"
                                            class="form-control @error('manual_steering_wheel_tilt_and_movement') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('manual_steering_wheel_tilt_and_movement')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.automatic_steering_wheel_tilt_and_movement')}}</label>
                                    <select id="automatic_steering_wheel_tilt_and_movement"
                                            name="automatic_steering_wheel_tilt_and_movement"
                                            class="form-control @error('automatic_steering_wheel_tilt_and_movement') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('automatic_steering_wheel_tilt_and_movement')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.child_seat_restraint_system')}}</label>
                                    <select id="child_seat_restraint_system" name="child_seat_restraint_system"
                                            class="form-control @error('child_seat_restraint_system') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('child_seat_restraint_system')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.steering_wheel_controls')}}</label>
                                    <select id="steering_wheel_controls" name="steering_wheel_controls"
                                            class="form-control @error('steering_wheel_controls') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('steering_wheel_controls')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.seat_upholstery')}}</label>
                                    <select id="seat_upholstery" name="seat_upholstery"
                                            class="form-control @error('seat_upholstery') is-invalid @enderror">
                                        @foreach(seat_upholstery_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('seat_upholstery')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.air_conditioning_system')}}</label>
                                    <select id="air_conditioning_system" name="air_conditioning_system"
                                            class="form-control @error('air_conditioning_system') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('air_conditioning_system')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.electric_windows')}}</label>
                                    <select id="electric_windows" name="electric_windows"
                                            class="form-control @error('electric_windows') is-invalid @enderror">
                                        @foreach(electric_windows_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('electric_windows')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.car_info_screen')}}</label>
                                    <input type="text" name="car_info_screen" id="car_info_screen"
                                           class="form-control @error('car_info_screen') is-invalid @enderror"
                                           placeholder="{{__('vehicle.car_info_screen')}}">

                                    @error('manufacturing_year')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.seat_memory_feature')}}</label>
                                    <select id="seat_memory_feature" name="seat_memory_feature"
                                            class="form-control @error('seat_memory_feature') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('seat_memory_feature')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.sunroof')}}</label>
                                    <select id="sunroof" name="sunroof"
                                            class="form-control @error('sunroof') is-invalid @enderror">
                                        @foreach(sunroof_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('sunroof')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.seat_massage_feature')}}</label>
                                    <select id="seat_massage_feature" name="seat_massage_feature"
                                            class="form-control @error('seat_massage_feature') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('seat_massage_feature')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.air_filtration')}}</label>
                                    <select id="air_filtration" name="air_filtration"
                                            class="form-control @error('air_filtration') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('air_filtration')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.interior_embroidery')}}</label>
                                    <select id="interior_embroidery" name="interior_embroidery"
                                            class="form-control @error('interior_embroidery') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('interior_embroidery')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.side_awnings')}}</label>
                                    <select id="side_awnings" name="side_awnings"
                                            class="form-control @error('side_awnings') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('side_awnings')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.side_mirror')}}</label>
                                    <select id="side_mirror" name="side_mirror"
                                            class="form-control @error('side_mirror') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('side_mirror')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.tire_type_and_size')}}</label>
                                    <input type="text" name="tire_type_and_size" id="tire_type_and_size"
                                           class="form-control @error('tire_type_and_size') is-invalid @enderror"
                                           placeholder="{{__('vehicle.tire_type_and_size')}}">

                                    @error('tire_type_and_size')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.car_gear_shift_knob')}}</label>
                                    <select id="car_gear_shift_knob" name="car_gear_shift_knob"
                                            class="form-control @error('car_gear_shift_knob') is-invalid @enderror">
                                        @foreach(car_gear_shift_knob_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('car_gear_shift_knob')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.front_lighting')}}</label>
                                    <select id="front_lighting" name="front_lighting"
                                            class="form-control @error('front_lighting') is-invalid @enderror">
                                        @foreach(front_lighting_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('front_lighting')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.transparent_coating')}}</label>
                                    <select id="transparent_coating" name="transparent_coating"
                                            class="form-control @error('transparent_coating') is-invalid @enderror">
                                        @foreach(transparent_coating_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('transparent_coating')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.toughened_glass')}}</label>
                                    <select id="toughened_glass" name="toughened_glass"
                                            class="form-control @error('toughened_glass') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('toughened_glass')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.roof_rails')}}</label>
                                    <select id="roof_rails" name="roof_rails"
                                            class="form-control @error('roof_rails') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('roof_rails')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.electric_back_door')}}</label>
                                    <select id="electric_back_door" name="electric_back_door"
                                            class="form-control @error('electric_back_door') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('electric_back_door')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.daytime_running_lights')}}</label>
                                    <select id="daytime_running_lights" name="daytime_running_lights"
                                            class="form-control @error('daytime_running_lights') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('daytime_running_lights')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.automatically_closing_doors')}}</label>
                                    <select id="automatically_closing_doors" name="automatically_closing_doors"
                                            class="form-control @error('automatically_closing_doors') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('automatically_closing_doors')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.back_lights')}}</label>
                                    <select id="back_lights" name="back_lights"
                                            class="form-control @error('back_lights') is-invalid @enderror">
                                        @foreach(back_lights_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('back_lights')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.fog_lights')}}</label>
                                    <select id="fog_lights" name="fog_lights"
                                            class="form-control @error('fog_lights') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('fog_lights')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('vehicle.Electric_height_adjustment_for_headlights')}}</label>
                                    <select id="Electric_height_adjustment_for_headlights"
                                            name="Electric_height_adjustment_for_headlights"
                                            class="form-control @error('Electric_height_adjustment_for_headlights') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('Electric_height_adjustment_for_headlights')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label">{{__('vehicle.back_space')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="back_space_label">{{__('vehicle.cm')}}</span>
                                        <input type="text" name="back_space" id="back_space_value"
                                               class="form-control @error('back_space') is-invalid @enderror"
                                               placeholder="{{__('vehicle.back_space')}}"
                                               aria-describedby="back_space_label">

                                        @error('back_space')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.roof')}}</label>
                                    <select id="roof" name="roof"
                                            class="form-control @error('roof') is-invalid @enderror">
                                        @foreach(roof_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('roof')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.rear_spoiler')}}</label>
                                    <select id="rear_spoiler" name="rear_spoiler"
                                            class="form-control @error('rear_spoiler') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('rear_spoiler')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.keyless_entry_feature')}}</label>
                                    <select id="keyless_entry_feature" name="keyless_entry_feature"
                                            class="form-control @error('keyless_entry_feature') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('keyless_entry_feature')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.sensitive_windshield_wipers_rain')}}</label>
                                    <select id="sensitive_windshield_wipers_rain"
                                            name="sensitive_windshield_wipers_rain"
                                            class="form-control @error('sensitive_windshield_wipers_rain') is-invalid @enderror">
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('sensitive_windshield_wipers_rain')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-label">{{__('vehicle.weight')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="weight_label">{{__('vehicle.kg')}}</span>
                                        <input type="text" name="weight" id="weight_vlaue"
                                               class="form-control @error('weight') is-invalid @enderror"
                                               placeholder="{{__('vehicle.weight')}}"
                                               aria-describedby="weight_label">

                                        @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('vehicle.injection_type')}}</label>
                                    <select id="injection_type" name="injection_type"
                                            class="form-control @error('injection_type') is-invalid @enderror">
                                        @foreach(injection_type_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('injection_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.determination')}}</label>
                                    <input type="text" name="determination" id="determination"
                                           class="form-control @error('determination') is-invalid @enderror"
                                           placeholder="{{__('vehicle.determination')}}">

                                    @error('determination')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="form-label">{{__('vehicle.fuel_tank_capacity')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"
                                              id="fuel_tank_capacity_label">{{__('vehicle.liter')}}</span>
                                        <input type="text" name="fuel_tank_capacity" id="fuel_tank_capacity_value"
                                               class="form-control @error('fuel_tank_capacity') is-invalid @enderror"
                                               placeholder="{{__('vehicle.fuel_tank_capacity')}}"
                                               aria-describedby="fuel_tank_capacity_label">

                                        @error('fuel_tank_capacity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.fuel_consumption')}}</label>
                                    <input type="text" name="fuel_consumption" id="fuel_consumption"
                                           class="form-control @error('fuel_consumption') is-invalid @enderror"
                                           placeholder="{{__('vehicle.fuel_consumption')}}">

                                    @error('fuel_consumption')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('vehicle.fuel_consumption')}}</label>
                                    <input type="text" name="fuel_consumption" id="fuel_consumption"
                                           class="form-control @error('fuel_consumption') is-invalid @enderror"
                                           placeholder="{{__('vehicle.fuel_consumption')}}">

                                    @error('fuel_consumption')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="active" id="active">
                                        <label class="form-check-label">
                                            {{__('words.activity')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
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
