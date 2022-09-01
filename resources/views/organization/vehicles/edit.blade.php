@extends('organization.layouts.app')
@section('title','Mawatery | Vehicles')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.vehicles')}} <small class="text-secondary"></small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item ">{{__('words.vehicles')}}</li>
                        <li class="breadcrumb-item active">{{__('words.show_vehicle')}}</li>
                    </ol>
                </div>
                @include('organization.includes.alerts.success')
                @include('organization.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ol>
                                        @foreach ($errors->all() as $error)
                                            <li>* {{ $error }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            @endif
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">

                            <form method="POST" action="{{route('organization.vehicles.update',$vehicle->id)}}"
                                  enctype="multipart/form-data" autocomplete="off">
                                @method('put')
                                @csrf
                                <input type="hidden" name="id" value="{{$vehicle->id}}">

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label>{{__('words.vehicle_type')}}</label>
                                        <select name="vehicle_type" id="vehicle_type"
                                                class="form-control @error('vehicle_type') is-invalid @enderror">
                                            <option value="" selected>{{__('words.choose')}}</option>
                                            @foreach(vehicle_type_arr() as $key=>$val)
                                                <option {{ old('vehicle_type') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$vehicle->vehicle_type == $key ? 'selected' : ''}}>{{$val}}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    {{--                                    <div class="form-group col-md-4 d-none" id="ghamara_count">--}}
                                    {{--                                        <label>{{__('vehicle.ghamara_count')}}</label>--}}
                                    {{--                                        <select name="ghamara_count"--}}
                                    {{--                                                class="form-control @error('ghamara_count') is-invalid @enderror">--}}
                                    {{--                                            <option value="">{{__('words.choose')}}</option>--}}
                                    {{--                                            @foreach(ghamara_count_arr() as $key=>$value)--}}
                                    {{--                                                <option {{ old('ghamara_count') == $key ? "selected" : "" }}--}}
                                    {{--                                                        value="{{$key}}" {{$vehicle->ghamara_count == $key ? 'selected' : ''}}>{{$value}}</option>--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                        </select>--}}
                                    {{--                                        @error('ghamara_count')--}}
                                    {{--                                        <span class="invalid-feedback" role="alert">--}}
                                    {{--                                            <strong>{{ $message }}</strong>--}}
                                    {{--                                        </span>--}}
                                    {{--                                        @enderror--}}
                                    {{--                                    </div>--}}

                                    <div class="form-group col-md-4">
                                        <label>
                                            {{__('vehicle.manufacturing_year')}}
                                        </label>
                                        <input type="text" name="manufacturing_year"
                                               class="yearpicker manufacturing_year form-control @error('manufacturing_year') is-invalid @enderror"
                                               value="">
                                        @error('manufacturing_year')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.brand_id')}}</label>
                                        <select type="text" name="brand_id"
                                                class="form-control brand_id @error('brand_id') is-invalid @enderror">
                                            @foreach($brands as $brand)
                                                <option {{ old('brand_id') == $brand->id ? "selected" : "" }}
                                                        value="{{$brand->id}}" {{$brand->id == $vehicle->brand_id ? 'selected' : ''}}>{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.car_model_id')}}</label>
                                        <select name="car_model_id"
                                                class="form-control car_model_id @error('car_model_id') is-invalid @enderror">

                                            @foreach($car_models as $car_model)
                                                <option {{ old('car_model_id') == $car_model->id ? "selected" : "" }}
                                                        value="{{$car_model->id}}" {{$car_model->id == $vehicle->car_model_id ? 'selected' : ''}}>{{$car_model->name}}</option>
                                            @endforeach

                                        </select>
                                        @error('car_model_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.car_class_id')}}</label>
                                        <select name="car_class_id"
                                                class="form-control @error('car_class_id') is-invalid @enderror">
                                            <option value="">{{__('words.choose')}}</option>
                                            @foreach($car_classes as $car_class)
                                                <option {{ old('car_class_id') == $car_class->id ? "selected" : "" }}
                                                        value="{{$car_class->id}}" {{$car_class->id == $vehicle->car_class_id ? 'selected' : ''}}>{{$car_class->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('car_class_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-3">
                                        <label>{{__('vehicle.outside_color')}}</label>
                                        <select name="outside_color_id"
                                                class="form-control @error('outside_color_id') is-invalid @enderror">
                                            <option value="" selected>{{__('words.choose')}}</option>
                                            @foreach($colors as $color)
                                                <option {{ old('outside_color_id') == $color->id ? "selected" : "" }}
                                                        value="{{$color->id}}" {{$color->id == $vehicle->outside_color_id ? 'selected' : ''}}>{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('outside_color_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>{{__('vehicle.inside_color')}}</label>
                                        <select name="inside_color_id"
                                                class="form-control @error('inside_color_id') is-invalid @enderror">
                                            <option value="" selected>{{__('words.choose')}}</option>
                                            @foreach($colors as $color)
                                                <option {{ old('inside_color_id') == $color->id ? "selected" : "" }}
                                                        value="{{$color->id}}" {{$color->id == $vehicle->inside_color_id ? 'selected' : ''}}>{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('inside_color_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>{{__('vehicle.transmission_type')}}</label>
                                        <select name="transmission_type"
                                                class="form-control @error('transmission_type') is-invalid @enderror">
                                            @foreach(transmission_type_arr() as $key=>$value)
                                                <option {{ old('transmission_type') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->transmission_type ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('transmission_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>{{__('vehicle.engine')}}</label>
                                        <select name="engine_size"
                                                class="form-control @error('engine_size') is-invalid @enderror">
                                            @foreach(engine_size_arr() as $key=>$value)
                                                <option {{ old('engine_size') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->engine_size ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('engine_size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.cylinder_number')}}</label>
                                        <select name="cylinder_number"
                                                class="form-control @error('cylinder_number') is-invalid @enderror">
                                            @foreach(cylinder_number_arr() as $key=>$value)
                                                <option {{ old('cylinder_number') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->cylinder_number ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('cylinder_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.fuel_type')}}</label>
                                        <select name="fuel_type"
                                                class="form-control @error('fuel_type') is-invalid @enderror">
                                            @foreach(fuel_type_arr() as $key=>$value)
                                                <option {{ old('fuel_type') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->fuel_type ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('fuel_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.wheel_drive_system')}}</label>
                                        <select name="wheel_drive_system"
                                                class="form-control @error('wheel_drive_system') is-invalid @enderror">
                                            @foreach(wheel_drive_system_arr() as $key=>$value)
                                                <option {{ old('wheel_drive_system') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->wheel_drive_system ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('wheel_drive_system')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.specifications')}}</label>
                                        <select name="specifications"
                                                class="form-control @error('specifications') is-invalid @enderror">
                                            @foreach(specifications_arr() as $key=>$value)
                                                <option {{ old('specifications') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->specifications ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('specifications')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.start_with_fingerprint')}}</label>
                                        <select name="start_with_fingerprint"
                                                class="form-control @error('start_with_fingerprint') is-invalid @enderror">
                                            <option {{ old('start_with_fingerprint') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->start_with_fingerprint == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('start_with_fingerprint') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->start_with_fingerprint == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('start_with_fingerprint')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.remote_start')}}</label>
                                        <select name="remote_start"
                                                class="form-control @error('remote_start') is-invalid @enderror">
                                            <option {{ old('remote_start') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->remote_start == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('remote_start') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->remote_start == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('remote_start')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.screen')}}</label>
                                        <select name="screen"
                                                class="form-control @error('screen') is-invalid @enderror">
                                            <option {{ old('screen') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->screen == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('screen') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->screen == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('screen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.seat_upholstery')}}</label>
                                        <select name="seat_upholstery"
                                                class="form-control @error('seat_upholstery') is-invalid @enderror">
                                            @foreach(seat_upholstery_arr() as $key=>$value)
                                                <option {{ old('seat_upholstery') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->seat_upholstery ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('seat_upholstery')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.windows_control')}}</label>
                                        <select name="windows_control"
                                                class="form-control @error('windows_control') is-invalid @enderror">
                                            @foreach(windows_control_arr() as $key=>$value)
                                                <option {{ old('windows_control') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->windows_control ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('windows_control')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-6">
                                        <label>{{__('vehicle.wheel_size')}}</label>
                                        <select name="wheel_size" id="single-select"
                                                class="form-control @error('wheel_size') is-invalid @enderror">
                                            @foreach(wheel_size_arr() as $key=>$value)
                                                <option {{ old('wheel_size') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->wheel_size ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>


                                        @error('wheel_size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('vehicle.wheel_type')}}</label>
                                        <select name="wheel_type"
                                                class="form-control @error('wheel_type') is-invalid @enderror">
                                            @foreach(wheel_type_arr() as $key=>$value)
                                                <option {{ old('wheel_type') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->wheel_type ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('wheel_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.sunroof')}}</label>
                                        <select name="sunroof"
                                                class="form-control @error('sunroof') is-invalid @enderror">
                                            @foreach(sunroof_arr() as $key=>$value)
                                                <option {{ old('sunroof') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->sunroof ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('sunroof')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.doors_number')}}</label>
                                        <input name="doors_number"
                                               value="{{old('doors_number', $vehicle->doors_number)}}"
                                               class="form-control @error('doors_number') is-invalid @enderror"
                                               value="{{$vehicle->doors_number}}"
                                               placeholder="4, 2, ...">
                                        @error('doors_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.electric_back_door')}}</label>
                                        <select name="electric_back_door"
                                                class="form-control @error('electric_back_door') is-invalid @enderror">
                                            <option {{ old('electric_back_door') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->electric_back_door == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('electric_back_door') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->electric_back_door == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('electric_back_door')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.start_engine_with_button')}}</label>
                                        <select name="start_engine_with_button"
                                                class="form-control @error('start_engine_with_button') is-invalid @enderror">
                                            <option {{ old('start_engine_with_button') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->start_engine_with_button == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('start_engine_with_button') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->start_engine_with_button == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('start_engine_with_button')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.seat_adjustment')}}</label>
                                        <select name="seat_adjustment"
                                                class="form-control @error('seat_adjustment') is-invalid @enderror">
                                            <option {{ old('seat_adjustment') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->seat_adjustment == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('seat_adjustment') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->seat_adjustment == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('seat_adjustment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.seat_heating_cooling_function')}}</label>
                                        <select name="seat_heating_cooling_function"
                                                class="form-control @error('seat_heating_cooling_function') is-invalid @enderror">
                                            <option {{ old('seat_heating_cooling_function') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->seat_heating_cooling_function == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('seat_heating_cooling_function') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->seat_heating_cooling_function == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('seat_heating_cooling_function')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.seat_massage_feature')}}</label>
                                        <select name="seat_massage_feature"
                                                class="form-control @error('seat_massage_feature') is-invalid @enderror">
                                            <option {{ old('seat_massage_feature') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->seat_massage_feature == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('seat_massage_feature') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->seat_massage_feature == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('seat_massage_feature')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.seat_memory_feature')}}</label>
                                        <select name="seat_memory_feature"
                                                class="form-control @error('seat_memory_feature') is-invalid @enderror">
                                            <option {{ old('seat_memory_feature') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->seat_memory_feature == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('seat_memory_feature') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->seat_memory_feature == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('seat_memory_feature')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('vehicle.fog_lights')}}</label>
                                        <select name="fog_lights"
                                                class="form-control @error('fog_lights') is-invalid @enderror">
                                            <option {{ old('fog_lights') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->fog_lights == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                            <option {{ old('fog_lights') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->fog_lights == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                        </select>
                                        @error('fog_lights')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="form-group col-md-6">
                                        <label>{{__('vehicle.front_lighting')}}</label>
                                        <select name="front_lighting"
                                                class="form-control @error('front_lighting') is-invalid @enderror">
                                            @foreach(front_lighting_arr() as $key=>$value)
                                                <option {{ old('front_lighting') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->front_lighting ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('front_lighting')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('vehicle.air_conditioning_system')}}</label>
                                        <select name="air_conditioning_system"
                                                class="form-control @error('air_conditioning_system') is-invalid @enderror">
                                            @foreach(air_conditioning_system_arr() as $key=>$value)
                                                <option {{ old('air_conditioning_system') == $key ? "selected" : "" }}
                                                        value="{{$key}}" {{$key == $vehicle->air_conditioning_system ? 'selected' : ''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('air_conditioning_system')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-4">
                                        <label>{{__('words.price')}}</label>
                                        <input type="number" name="price" step="0.01" min="0"
                                               value="{{old('price', $vehicle->price)}}"
                                               class="form-control @error('price') is-invalid @enderror"
                                               placeholder="{{__('words.price')}}">

                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('words.discount_type')}}</label>
                                        <select name="discount_type"
                                                class="form-control @error('discount_type') is-invalid @enderror">
                                            <option value="">{{__('words.none')}}</option>
                                            <option {{ old('discount_type') == 'percentage' ? "selected" : "" }}
                                                    {{ $vehicle->discount_type == 'percentage' ? "selected" : "" }}
                                                    value="percentage">{{__('words.percentage')}}</option>
                                            <option {{ old('discount_type') == 'amount' ? "selected" : "" }}
                                                    {{ $vehicle->discount_type == 'amount' ? "selected" : "" }}
                                                    value="amount">{{__('words.amount')}}</option>

                                        </select>
                                        @error('discount_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label>{{__('words.discount_value')}}</label>
                                        <input type="number" name="discount" step="0.01" min="1"
                                               value="{{old('discount', $vehicle->discount)}}"
                                               class="form-control @error('discount') is-invalid @enderror"
                                               placeholder="{{__('words.discount_value')}}">

                                        @error('discount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-check-label">
                                            {{__('words.availability')}}
                                        </label>
                                        <select name="availability"
                                                class="form-control @error('availability') is-invalid @enderror">
                                            <option {{ old('availability') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->availability == '0' ? 'selected' : ''}}>{{__('words.not_available_prop')}}</option>
                                            <option {{ old('availability') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->availability == 1 ? 'selected' : ''}}>{{__('words.available_prop')}}</option>
                                        </select>
                                        @error('availability')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-check-label">
                                            {{__('words.activity')}}
                                        </label>
                                        <select name="active"
                                                class="form-control @error('active') is-invalid @enderror">
                                            <option {{ old('active') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->active == '0' ? 'selected' : ''}}>{{__('words.inactive')}}</option>
                                            <option {{ old('active') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->active == '1' ? 'selected' : ''}}>{{__('words.active')}}</option>
                                        </select>
                                        @error('active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-check-label">
                                            {{__('words.vehicle_status')}}
                                        </label>
                                        <select name="is_new" id="is_new"
                                                class="form-control @error('is_new') is-invalid @enderror">
                                            <option value="" selected>{{__('words.choose')}}</option>
                                            <option {{ old('is_new') == '0' ? "selected" : "" }}
                                                    value="0" {{$vehicle->is_new == '0' ? 'selected' : ''}}>{{__('vehicle.used')}}</option>
                                            <option {{ old('is_new') == '1' ? "selected" : "" }}
                                                    value="1" {{$vehicle->is_new == '1' ? 'selected' : ''}}>{{__('vehicle.new')}}</option>
                                        </select>
                                        @error('is_new')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                {{--  for used start --}}
                                <div id="show_for_used" class="d-none">
                                    <hr>
                                    <hr>
                                    <div class="form-row mt-3">
                                        <div class="form-group col-md-4">
                                            <label>{{__('vehicle.traveled_distance')}}</label>
                                            <input type="number" name="traveled_distance" step="0.01" min="0"
                                                   value="{{old('traveled_distance', $vehicle->traveled_distance)}}"
                                                   class="form-control @error('traveled_distance') is-invalid @enderror"
                                                   placeholder="{{__('vehicle.traveled_distance')}}">

                                            @error('traveled_distance')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-check-label">
                                                {{__('vehicle.traveled_distance_type')}}
                                            </label>
                                            <select name="traveled_distance_type"
                                                    class="form-control @error('traveled_distance_type') is-invalid @enderror">
                                                <option {{ old('traveled_distance_type') == 'km' ? "selected" : "" }}
                                                        value="km" {{$vehicle->traveled_distance_type == 'km' ? 'selected' : ''}}>{{__('vehicle.km')}}</option>
                                                <option {{ old('traveled_distance_type') == 'mile' ? "selected" : "" }}
                                                        value="mile" {{$vehicle->traveled_distance_type == 'mile' ? 'selected' : ''}}>{{__('vehicle.mile')}}</option>
                                            </select>
                                            @error('traveled_distance_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-check-label">
                                                {{__('vehicle.car_status')}}
                                            </label>
                                            <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror">
                                                @foreach(status_arr() as $key=>$value)
                                                    <option {{ old('status') == $key ? "selected" : "" }}
                                                            value="{{$key}}" {{$key == $vehicle->status ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="form-check-label">
                                                {{__('vehicle.guarantee')}}
                                            </label>
                                            <select name="guarantee" id="guarantee"
                                                    class="form-control @error('guarantee') is-invalid @enderror">
                                                <option {{ old('guarantee') == '0' ? "selected" : "" }}
                                                        value="0" {{$vehicle->guarantee == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                                <option {{ old('guarantee') == '1' ? "selected" : "" }}
                                                        value="1" {{$vehicle->guarantee == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                            </select>
                                            @error('guarantee')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 show_for_guarantee d-none">
                                            <label>
                                                {{__('vehicle.year')}}
                                            </label>
                                            <input type="number" name="guarantee_year" value=""
                                                   class="yearpicker guarantee_year form-control @error('guarantee_year') is-invalid @enderror">
                                            @error('guarantee_year')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 show_for_guarantee d-none">
                                            <label class="form-check-label">
                                                {{__('vehicle.month')}}
                                            </label>
                                            <select type="number" name="guarantee_month"
                                                    class="form-control @error('guarantee_month') is-invalid @enderror">
                                                <option {{ old('guarantee_month') == '01' ? "selected" : "" }}
                                                        value="01" {{$vehicle->guarantee_month == '01' ? 'selected' : ''}}>{{__('words.january')}}</option>
                                                <option {{ old('guarantee_month') == '02' ? "selected" : "" }}
                                                        value="02" {{$vehicle->guarantee_month == '02' ? 'selected' : ''}}>{{__('words.february')}}</option>
                                                <option {{ old('guarantee_month') == '03' ? "selected" : "" }}
                                                        value="03" {{$vehicle->guarantee_month == '03' ? 'selected' : ''}}>{{__('words.march')}}</option>
                                                <option {{ old('guarantee_month') == '04' ? "selected" : "" }}
                                                        value="04" {{$vehicle->guarantee_month == '04' ? 'selected' : ''}}>{{__('words.april')}}</option>
                                                <option {{ old('guarantee_month') == '05' ? "selected" : "" }}
                                                        value="05" {{$vehicle->guarantee_month == '05' ? 'selected' : ''}}>{{__('words.may')}}</option>
                                                <option {{ old('guarantee_month') == '06' ? "selected" : "" }}
                                                        value="06" {{$vehicle->guarantee_month == '06' ? 'selected' : ''}}>{{__('words.june')}}</option>
                                                <option {{ old('guarantee_month') == '07' ? "selected" : "" }}
                                                        value="07" {{$vehicle->guarantee_month == '07' ? 'selected' : ''}}>{{__('words.july')}}</option>
                                                <option {{ old('guarantee_month') == '08' ? "selected" : "" }}
                                                        value="08" {{$vehicle->guarantee_month == '08' ? 'selected' : ''}}>{{__('words.august')}}</option>
                                                <option {{ old('guarantee_month') == '09' ? "selected" : "" }}
                                                        value="09" {{$vehicle->guarantee_month == '09' ? 'selected' : ''}}>{{__('words.september')}}</option>
                                                <option {{ old('guarantee_month') == '10' ? "selected" : "" }}
                                                        value="10" {{$vehicle->guarantee_month == '10' ? 'selected' : ''}}>{{__('words.october')}}</option>
                                                <option {{ old('guarantee_month') == '11' ? "selected" : "" }}
                                                        value="11" {{$vehicle->guarantee_month == '11' ? 'selected' : ''}}>{{__('words.november')}}</option>
                                                <option {{ old('guarantee_month') == '12' ? "selected" : "" }}
                                                        value="12" {{$vehicle->guarantee_month == '12' ? 'selected' : ''}}>{{__('words.december')}}</option>
                                            </select>
                                            @error('guarantee_month')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="form-check-label">
                                                {{__('vehicle.insurance')}}
                                            </label>
                                            <select name="insurance" id="insurance"
                                                    class="form-control @error('insurance') is-invalid @enderror">
                                                <option {{ old('insurance') == '0' ? "selected" : "" }}
                                                        value="0" {{$vehicle->insurance == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                                <option {{ old('insurance') == '1' ? "selected" : "" }}
                                                        value="1" {{$vehicle->insurance == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                            </select>
                                            @error('insurance')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 show_for_insurance d-none">
                                            <label>
                                                {{__('vehicle.year')}}
                                            </label>
                                            <input type="number" name="insurance_year" value=""
                                                   class="yearpicker insurance_year form-control @error('insurance_year') is-invalid @enderror">
                                            @error('insurance_year')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 show_for_insurance d-none">
                                            <label class="form-check-label">
                                                {{__('vehicle.month')}}
                                            </label>
                                            <select type="number" name="insurance_month"
                                                    class="form-control @error('insurance_month') is-invalid @enderror">
                                                <option {{ old('insurance_month') == '01' ? "selected" : "" }}
                                                        value="01" {{$vehicle->insurance_month == '01' ? 'selected' : ''}}>{{__('words.january')}}</option>
                                                <option {{ old('insurance_month') == '02' ? "selected" : "" }}
                                                        value="02" {{$vehicle->insurance_month == '02' ? 'selected' : ''}}>{{__('words.february')}}</option>
                                                <option {{ old('insurance_month') == '03' ? "selected" : "" }}
                                                        value="03" {{$vehicle->insurance_month == '03' ? 'selected' : ''}}>{{__('words.march')}}</option>
                                                <option {{ old('insurance_month') == '04' ? "selected" : "" }}
                                                        value="04" {{$vehicle->insurance_month == '04' ? 'selected' : ''}}>{{__('words.april')}}</option>
                                                <option {{ old('insurance_month') == '05' ? "selected" : "" }}
                                                        value="05" {{$vehicle->insurance_month == '05' ? 'selected' : ''}}>{{__('words.may')}}</option>
                                                <option {{ old('insurance_month') == '06' ? "selected" : "" }}
                                                        value="06" {{$vehicle->insurance_month == '06' ? 'selected' : ''}}>{{__('words.june')}}</option>
                                                <option {{ old('insurance_month') == '07' ? "selected" : "" }}
                                                        value="07" {{$vehicle->insurance_month == '07' ? 'selected' : ''}}>{{__('words.july')}}</option>
                                                <option {{ old('insurance_month') == '08' ? "selected" : "" }}
                                                        value="08" {{$vehicle->insurance_month == '08' ? 'selected' : ''}}>{{__('words.august')}}</option>
                                                <option {{ old('insurance_month') == '09' ? "selected" : "" }}
                                                        value="09" {{$vehicle->insurance_month == '09' ? 'selected' : ''}}>{{__('words.september')}}</option>
                                                <option {{ old('insurance_month') == '10' ? "selected" : "" }}
                                                        value="10" {{$vehicle->insurance_month == '10' ? 'selected' : ''}}>{{__('words.october')}}</option>
                                                <option {{ old('insurance_month') == '11' ? "selected" : "" }}
                                                        value="11" {{$vehicle->insurance_month == '11' ? 'selected' : ''}}>{{__('words.november')}}</option>
                                                <option {{ old('insurance_month') == '12' ? "selected" : "" }}
                                                        value="12" {{$vehicle->insurance_month == '12' ? 'selected' : ''}}>{{__('words.december')}}</option>
                                            </select>
                                            @error('insurance_month')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label class="form-check-label">
                                                {{__('vehicle.coverage_type')}}
                                            </label>
                                            <select name="coverage_type"
                                                    class="form-control @error('coverage_type') is-invalid @enderror">
                                                @foreach(coverage_type_arr() as $key=>$value)
                                                    <option {{ old('coverage_type') == $key ? "selected" : "" }}
                                                            value="{{$key}}" {{$key == $vehicle->coverage_type ? 'selected' : ''}}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('coverage_type')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="form-check-label">
                                                {{__('vehicle.selling_by_plate')}}
                                            </label>
                                            <select name="selling_by_plate" id="selling_by_plate"
                                                    class="form-control @error('selling_by_plate') is-invalid @enderror">
                                                <option {{ old('selling_by_plate') == '0' ? "selected" : "" }}
                                                        value="0" {{$vehicle->selling_by_plate == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                                <option {{ old('selling_by_plate') == '1' ? "selected" : "" }}
                                                        value="1" {{$vehicle->selling_by_plate == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                            </select>
                                            @error('selling_by_plate')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3 d-none" id="show_for_selling_by_plate">
                                            <label class="form-check-label">
                                                {{__('vehicle.number_plate')}}
                                            </label>
                                            <input type="text" name="number_plate"
                                                   value="{{old('number_plate', $vehicle->number_plate)}}"
                                                   class="form-control @error('number_plate') is-invalid @enderror">

                                            @error('number_plate')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="form-check-label">
                                                {{__('vehicle.price_is_negotiable')}}
                                            </label>
                                            <select name="price_is_negotiable"
                                                    class="form-control @error('price_is_negotiable') is-invalid @enderror">
                                                <option {{ old('price_is_negotiable') == '0' ? "selected" : "" }}
                                                        value="0" {{$vehicle->price_is_negotiable == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                                <option {{ old('price_is_negotiable') == '1' ? "selected" : "" }}
                                                        value="1" {{$vehicle->price_is_negotiable == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                            </select>
                                            @error('selling_by_plate')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="form-check-label">
                                                {{__('vehicle.in_bahrain')}}
                                            </label>
                                            <select name="in_bahrain" id="in_bahrain"
                                                    class="form-control @error('in_bahrain') is-invalid @enderror">
                                                <option
                                                    {{ old('in_bahrain') == '0' ? "selected" : "" }} value="" {{$vehicle->in_bahrain == '' ? 'selected' : ''}}>{{__('words.choose')}}</option>
                                                <option {{ old('in_bahrain') == '1' ? "selected" : "" }}
                                                        value="0" {{$vehicle->in_bahrain == '0' ? 'selected' : ''}}>{{__('vehicle.no')}}</option>
                                                <option
                                                    value="1" {{$vehicle->in_bahrain == '1' ? 'selected' : ''}}>{{__('vehicle.yes')}}</option>
                                            </select>

                                            @error('in_bahrain')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 d-none show_for_in_bahrin">
                                            <label>{{__('words.country')}}</label>
                                            <select name="country_id"
                                                    class="form-control country_id @error('country_id') is-invalid @enderror">
                                                <option value="" selected>{{__('words.choose')}}</option>
                                                @foreach($countries as $country)
                                                    <option {{ old('country_id') == $country->id ? "selected" : "" }}
                                                            value="{{$country->id}}" {{$country->id == $vehicle->country_id? 'selected' : ''}}>{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>{{__('vehicle.location')}}</label>
                                            <input name="location" value="{{old('location', $vehicle->location)}}"
                                                   class="form-control @error('location') is-invalid @enderror"
                                                   placeholder="{{__('vehicle.location')}}">
                                            @error('location')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                {{--  for used end --}}

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>{{__('words.choose_image')}}</label>
                                        <input type="file" name="images[0][]" multiple
                                               class="images_files form-control image @error('images[]') is-invalid @enderror">

                                        @error('images[]')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4 colors">
                                        <label>{{__('words.colors')}}</label>
                                        <select name="colors[]"
                                                class="form-control @error('colors[]') is-invalid @enderror">
                                            @foreach($colors as $color)
                                                <option
                                                    {{ old('colors') == $color->id ? "selected" : "" }} value="{{$color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('colors[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--3D file start--}}
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.threeDFile')}}</label>
                                        <input type="file" name="threeDFiles[0][]"
                                               class="D_files form-control  @error('threeDFiles[]') is-invalid @enderror">

                                        @error('threeDFiles[]')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4 colors">
                                        <label>{{__('words.colors')}}</label>
                                        <select name="Dcolors[]"
                                                class="form-control @error('Dcolors[]') is-invalid @enderror">
                                            @foreach($colors as $color)
                                                <option
                                                    {{ old('Dcolors') == $color->id ? "selected" : "" }} value="{{$color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('Dcolors[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{--3D file end--}}

                                <div class="form-row imageOption">

                                </div>
                                <div class="form-row DOption">

                                </div>

                                <div class="block">
                                    <button type="button" class="add btn btn-outline-success">
                                        {{__('words.add_more_images')}}
                                    </button>
                                </div>
                                <div class="Dblock">
                                    <button type="button" class="Dadd mt-3 btn btn-outline-success">
                                        {{__('words.add_more_3d')}}
                                    </button>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col-12">
                                        <textarea class="form-control @error('additional_notes') is-invalid @enderror"
                                                  placeholder="{{__('words.additional_notes')}}"
                                                  name="additional_notes"
                                                  value="{{old('', $vehicle->additional_notes)}}"
                                                  style="height: 100px">{{ Input::old('additional_notes',$vehicle->additional_notes) }}</textarea>
                                    </div>
                                </div>


                                <div>
                                    @foreach($grouped_images as $key=>$files)
                                        <div class="form-row m-2 color-name">
                                            - {{App\Models\Color::find($key)->name}}
                                            <span
                                                style="background-color: {{App\Models\Color::find($key)->color_code}};"
                                                class="dot"></span>
                                        </div>
                                        <div class="form-row">
                                            @foreach($files as $file)
                                                <div class="form-row col-md-3">

                                                    <div class="rounded v-images border m-1">

                                                        <a href="{{asset($file->path)}}"
                                                           data-toggle="lightbox">
                                                            <img class="img-thumbnail w-100"
                                                                 src="{{asset($file->path)}}"
                                                                 onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                                 alt="slider_image">
                                                        </a>
                                                        @if($file->type == 'vehicle_3D')

                                                        @endif

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
                                        </div>

                                    @endforeach
                                </div>

                                <div id="deleted_images"></div>

                                <button type="submit"
                                        class="btn btn-outline-primary m-3">{{__('words.update')}}</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        @if($errors->has('used'))
        $('#show_for_used').removeClass('d-none');
        $('.show_for_guarantee').removeClass('d-none');
        $('.show_for_insurance').removeClass('d-none');
        $('#show_for_selling_by_plate').removeClass('d-none');
        $('#show_for_selling_by_plate').removeClass('d-none');
        $('.show_for_in_bahrin').removeClass('d-none');
        @endif
        $('.manufacturing_year').val("{{old('manufacturing_year')}}");
        $('.guarantee_year').val("{{old('guarantee_year')}}");
        $('.insurance_year').val("{{old('insurance_year')}}");

        function get_models(id, model_id = null) {
            // var id = $('.brand_id').val();
            var url = "{{route('car-models-of-brand' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        $('.car_model_id').empty();
                        let equal;
                        data.data.car_models.forEach(function (car_model) {
                            equal = model_id == car_model.id ? "selected" : "";
                            var option = "<option value = '" + car_model.id + "'>" + car_model.name + "</option>"
                            $('.car_model_id').append(option);
                        });

                    }
                    // alert(data);
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

        $('.brand_id').on('change', function () {
            get_models($(this).val());
        });

        $(window).on('load', function () {
            if ($('#is_new').val() == '0') {
                $('#show_for_used').removeClass('d-none');
                $('.color-name').addClass('d-none');
                $('.colors').addClass('d-none');
                $('.add').addClass('d-none');
            }
            if ($('#guarantee').val() == '1') {
                $('.show_for_guarantee').removeClass('d-none');
            }
            if ($('#insurance').val() == '1') {
                $('.show_for_insurance').removeClass('d-none');
            }
            if ($('#selling_by_plate').val() == '1') {
                $('#show_for_selling_by_plate').removeClass('d-none');
            }
            if ($('#in_bahrain').val() == 0) {
                $('.show_for_in_bahrin').removeClass('d-none');
            }
            if ($('#in_bahrain').val() == '') {
                $('.show_for_in_bahrin').addClass('d-none');
            }
            if ($('#vehicle_type').val() == 'pickups') {
                $('#ghamara_count').removeClass('d-none');
            }


            $('.manufacturing_year').val("{{$vehicle->manufacturing_year}}");
            $('.insurance_year').val("{{$vehicle->insurance_year}}");
            $('.guarantee_year').val("{{$vehicle->guarantee_year}}");

        });

        // $('#vehicle_type').on('change', function () {
        //     if ($(this).val() == 'pickups') {
        //         $('#ghamara_count').removeClass('d-none');
        //     } else {
        //         $('#ghamara_count').addClass('d-none');
        //     }
        // });

        $('#is_new').on('change', function () {
            if ($(this).val() == 0) {
                $('.colors').addClass('d-none');
                $('.color-name').addClass('d-none');
                $('.add').addClass('d-none');
            } else {
                $('.colors').removeClass('d-none');
                $('.color-name').removeClass('d-none');
                $('.add').removeClass('d-none');
            }
            if ($(this).val() == '0') {
                $('#show_for_used').removeClass('d-none');
            } else {
                $('#show_for_used').addClass('d-none');
            }
        });

        $('#guarantee').on('change', function () {
            if ($(this).val() == '1') {
                $('.show_for_guarantee').removeClass('d-none');
            } else {
                $('.show_for_guarantee').addClass('d-none');
            }
        });

        $('#insurance').on('change', function () {
            if ($(this).val() == '1') {
                $('.show_for_insurance').removeClass('d-none');
            } else {
                $('.show_for_insurance').addClass('d-none');
            }
        });

        $('#selling_by_plate').on('change', function () {
            if ($(this).val() == '1') {
                $('#show_for_selling_by_plate').removeClass('d-none');
            } else {
                $('#show_for_selling_by_plate').addClass('d-none');
            }
        });

        $('#in_bahrain').on('change', function () {
            if ($(this).val() == '1') {
                $('.show_for_in_bahrin').addClass('d-none');
            } else {
                $('.show_for_in_bahrin').removeClass('d-none');
            }
        });

        $('.add').click(function () {
            var counter = $(".images_files").length;
            var option = "<div class='images_files form-group col-md-6'><label>{{__('words.choose_image')}}</label><input type='file' multiple name='images[" + counter + "][]' class='form-control image @error('images') is-invalid @enderror'></div><div class='form-group col-md-4'><label>{{__('words.colors')}}</label> <select name='colors[]' class='form-control @error('colors[]') is-invalid @enderror'>@foreach($colors as $color)<option value='{{$color->id}}'>{{$color->name}}</option>@endforeach</select></div>";

            $('.imageOption').append(option);
        });
        $('.Dadd').click(function () {
            var Dcounter = $(".D_files").length;
            var option = "<div class='form-group col-md-6'> <label>{{__('words.threeDFile')}}</label><input type='file' name='threeDFiles[" + Dcounter + "][]' class='images_files form-control image @error('threeDFiles[]') is-invalid @enderror'>@error('threeDFiles[]')<span class='invalid-feedback' role='alert'> <strong>{{ $message }}</strong></span>@enderror</div><div class='form-group col-md-4'><label>{{__('words.colors')}}</label> <select name='Dcolors[]' class='form-control @error('Dcolors[]') is-invalid @enderror'>@foreach($colors as $color)<option value='{{$color->id}}'>{{$color->name}}</option>@endforeach</select></div>";

            $('.DOption').append(option);
        });


        $('#is_new').on('change', function () {
            if ($(this).val() == '1') {
                $('.block').removeClass('d-none');
            } else {
                $('.block').addClass('d-none');
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


