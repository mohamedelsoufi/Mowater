@extends('dashboard.layouts.standard')
@section('title','Mawatery | Vehicles')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.main_vehicles')}} <small class="text-secondary">({{ $main_vehicles->count() }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.main_vehicles')}}</li>
                    </ol>
                </div>
                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#storeMainVehicle">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.vehicle_details.main_vehicles.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.images')}}</th>
                                        <th>{{__('vehicle.vehicle_type')}}</th>
                                        <th>{{__('vehicle.brand_id')}}</th>
                                        <th>{{__('vehicle.car_model_id')}}</th>
                                        <th>{{__('vehicle.car_class_id')}}</th>
                                        <th>{{__('vehicle.manufacturing_year')}}</th>
                                        <th>{{__('vehicle.body_shape')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($main_vehicles as $main_vehicle)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$main_vehicle->files)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
{{--                                                @if($main_vehicle->vehicle_type == 'trucks')--}}
{{--                                                    {{__('vehicle.trucks')}}--}}
{{--                                                @elseif($main_vehicle->vehicle_type == 'pickups')--}}
{{--                                                    {{__('vehicle.pickups')}}--}}
{{--                                                @elseif($main_vehicle->vehicle_type == 'cars')--}}
{{--                                                    {{__('vehicle.cars')}}--}}
{{--                                                @elseif($main_vehicle->vehicle_type == 'motorcycles')--}}
{{--                                                    {{__('vehicle.motorcycles')}}--}}
{{--                                                @elseif($main_vehicle->vehicle_type == 'cruisers')--}}
{{--                                                    {{__('vehicle.cruisers')}}--}}
{{--                                                @endif--}}

                                                @foreach(vehicle_type_arr() as $key=>$val)
                                                    @if($main_vehicle->vehicle_type === $key)
                                                        {{$val}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$main_vehicle->brand->name}}</td>
                                            <td>{{$main_vehicle->car_model->name}}</td>
                                            <td>{{$main_vehicle->car_class->name}}</td>
                                            <td>{{$main_vehicle->manufacturing_year}}</td>
                                            <td>
                                                @if($main_vehicle->body_shape == 'sedan')
                                                    {{__('vehicle.sedan')}}
                                                @elseif($main_vehicle->body_shape == 'hatchback')
                                                    {{__('vehicle.hatchback')}}
                                                @endif
                                            </td>
                                            <td>{{$main_vehicle->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_main_vehicle"
                                                        class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editMainVehicle"
                                                        onclick="get_main_vehicle_data({{$main_vehicle->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_main_vehicle_data({{$main_vehicle->id}})">
                                                    {{__('words.delete')}}
                                                </button>
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
    @include('dashboard.vehicle_details.main_vehicles.update')
    @include('dashboard.vehicle_details.main_vehicles.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeMainVehicle').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editMainVehicle').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        console.log({{ $error }});
        get_main_vehicle_data({{$error}});

        @endforeach
        @endif

        function get_main_vehicle_data(id) {

            var url = "{{route('main-vehicles.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        // console.log(data);
                        $('#vehicle_type').val(data.data.show_main_vehicle.vehicle_type);
                        $('.brand_id').val(data.data.show_main_vehicle.brand_id);
                        $('#car_model_id').val(data.data.show_main_vehicle.car_model_id);
                        $('#car_class_id').val(data.data.show_main_vehicle.car_class_id);
                        $('#manufacturing_year').val(data.data.show_main_vehicle.manufacturing_year);
                        $('#body_shape').val(data.data.show_main_vehicle.body_shape);
                        $('#engine').val(data.data.show_main_vehicle.engine);
                        $('#fuel_type').val(data.data.show_main_vehicle.fuel_type);
                        $('#passengers_number').val(data.data.show_main_vehicle.passengers_number);
                        $('#doors_number').val(data.data.show_main_vehicle.doors_number);
                        $('#start_engine_with_button').val(data.data.show_main_vehicle.start_engine_with_button);
                        $('#seat_adjustment').val(data.data.show_main_vehicle.seat_adjustment);
                        $('#steering_wheel').val(data.data.show_main_vehicle.steering_wheel);
                        $('#ambient_interior_lighting').val(data.data.show_main_vehicle.ambient_interior_lighting);
                        $('#seat_heating_cooling_function').val(data.data.show_main_vehicle.seat_heating_cooling_function);
                        $('#remote_engine_start').val(data.data.show_main_vehicle.remote_engine_start);
                        $('#manual_steering_wheel_tilt_and_movement').val(data.data.show_main_vehicle.manual_steering_wheel_tilt_and_movement);
                        $('#automatic_steering_wheel_tilt_and_movement').val(data.data.show_main_vehicle.automatic_steering_wheel_tilt_and_movement);
                        $('#child_seat_restraint_system').val(data.data.show_main_vehicle.child_seat_restraint_system);
                        $('#steering_wheel_controls').val(data.data.show_main_vehicle.steering_wheel_controls);
                        $('#seat_upholstery').val(data.data.show_main_vehicle.seat_upholstery);
                        $('#air_conditioning_system').val(data.data.show_main_vehicle.air_conditioning_system);
                        $('#electric_windows').val(data.data.show_main_vehicle.electric_windows);
                        $('#car_info_screen').val(data.data.show_main_vehicle.car_info_screen);
                        $('#seat_memory_feature').val(data.data.show_main_vehicle.seat_memory_feature);
                        $('#sunroof').val(data.data.show_main_vehicle.sunroof);
                        $('#interior_embroidery').val(data.data.show_main_vehicle.interior_embroidery);
                        $('#side_awnings').val(data.data.show_main_vehicle.side_awnings);
                        $('#seat_massage_feature').val(data.data.show_main_vehicle.seat_massage_feature);
                        $('#air_filtration').val(data.data.show_main_vehicle.air_filtration);
                        $('#car_gear_shift_knob').val(data.data.show_main_vehicle.car_gear_shift_knob);
                        $('#front_lighting').val(data.data.show_main_vehicle.front_lighting);
                        $('#side_mirror').val(data.data.show_main_vehicle.side_mirror);
                        $('#tire_type_and_size').val(data.data.show_main_vehicle.tire_type_and_size);
                        $('#roof_rails').val(data.data.show_main_vehicle.roof_rails);
                        $('#electric_back_door').val(data.data.show_main_vehicle.electric_back_door);
                        $('#transparent_coating').val(data.data.show_main_vehicle.transparent_coating);
                        $('#toughened_glass').val(data.data.show_main_vehicle.toughened_glass);
                        $('#back_lights').val(data.data.show_main_vehicle.back_lights);
                        $('#fog_lights').val(data.data.show_main_vehicle.fog_lights);
                        $('#daytime_running_lights').val(data.data.show_main_vehicle.daytime_running_lights);
                        $('#automatically_closing_doors').val(data.data.show_main_vehicle.automatically_closing_doors);
                        $('#roof').val(data.data.show_main_vehicle.roof);
                        $('#rear_spoiler').val(data.data.show_main_vehicle.rear_spoiler);
                        $('#Electric_height_adjustment_for_headlights').val(data.data.show_main_vehicle.Electric_height_adjustment_for_headlights);
                        $('#back_space_value').val(data.data.show_main_vehicle.back_space);
                        $('#keyless_entry_feature').val(data.data.show_main_vehicle.keyless_entry_feature);
                        $('#sensitive_windshield_wipers_rain').val(data.data.show_main_vehicle.sensitive_windshield_wipers_rain);
                        $('#weight_vlaue').val(data.data.show_main_vehicle.weight);
                        $('#injection_type').val(data.data.show_main_vehicle.injection_type);
                        $('#determination').val(data.data.show_main_vehicle.determination);
                        $('#fuel_tank_capacity_value').val(data.data.show_main_vehicle.fuel_tank_capacity);
                        $('#fuel_consumption').val(data.data.show_main_vehicle.fuel_consumption);
                        if (data.data.show_main_vehicle.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }
                        $('#main_vehicle_id').val(data.data.show_main_vehicle.id);

                        let update = "{{route('main-vehicles.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_main_vehicle.id);

                        let destroy = "{{route('main-vehicles.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_main_vehicle.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_main_vehicle.brand.name + ' | ' + data.data.show_main_vehicle.car_model.name + ' | ' + data.data.show_main_vehicle.car_class.name);
                        // console.log(data.data.show_main_vehicle.brand.name + ' | ' + data.data.show_main_vehicle.car_model.name + ' | ' + data.data.show_main_vehicle.car_class.name);
                        get_models();
                    }
                    // alert(data);
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

        function get_models(){
            var id = $('.brand_id').val();
            var url = "{{route('car-models-of-brand' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        $('.car_model_id').empty();

                        data.data.car_models.forEach(function(car_model) {
                            var option = "<option value = '" + car_model.id +"'>" + car_model.name + "</option>"
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

        $('.brand_id').on('change',function(){
            get_models();
        });

    </script>
@endsection

