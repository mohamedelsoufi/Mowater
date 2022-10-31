@extends('organization.layouts.app')
@section('title','Mawatery | Rental Office Cars')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.rental_office_cars')}} <small
                                class="text-secondary">({{ $rental_office_cars->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.rental_office_cars')}}</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#store_rental_office_car">{{__('words.create')}}
                            </button>
                            @include('organization.rental_office_cars.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('vehicle.vehicle_type')}}</th>
                                        <th>{{__('vehicle.brand_id')}}</th>
                                        <th>{{__('words.car_model')}}</th>
                                        <th>{{__('words.car_class')}}</th>
                                        <th>{{__('words.manufacture_year')}}</th>
                                        <th>{{__('words.color')}}</th>
                                        <th>{{__('words.available')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($rental_office_cars as $rental_office_car)
                                        <tr class="text-center">
                                            <td>
                                                @foreach(vehicle_type_arr() as $key=>$val)
                                                    @if($rental_office_car->vehicle_type === $key)
                                                        {{$val}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$rental_office_car->brand ? $rental_office_car->brand->name : '--' }}</td>
                                            <td>{{$rental_office_car->car_model ? $rental_office_car->car_model->name : '--' }}</td>
                                            <td>{{$rental_office_car->car_class ? $rental_office_car->car_class->name : '--' }}</td>
                                            <td>{{$rental_office_car->manufacture_year}}</td>
                                            <td>{{$rental_office_car->color}}</td>
                                            <td>{!!$rental_office_car->available ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' !!}</td>

                                            <td>
                                                <button type="button" id="show_rental_office_cars"
                                                        class="btn btn-outline-info" data-toggle="modal"
                                                        data-target="#update_rental_office_car"
                                                        onclick="get_rental_office_car_data({{$rental_office_car->id}})">{{__('words.show')}}</button>

                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_rental_office_car_data({{$rental_office_car->id}})">{{__('words.delete')}} </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.rental_office_cars.edit')
                                @include('organization.rental_office_cars.delete')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    @include('change_brand')
    <script type="text/javascript">

        // $('.yearpicker').yearpicker()

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#store_rental_office_car').modal('show');

        @elseif($errors->has('update_modal'))
        $('#update_rental_office_car').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_rental_office_car_data({{$error}});

        @endforeach
        @endif


        $('.vehicle_type').on('change', function () {
            if ($(this).val() == 'pickups') {
                $('.ghamara_count').removeClass('d-none');
            } else {
                $('.ghamara_count').addClass('d-none');
            }
        });

        function get_rental_office_car_data(id) {
            var url = "{{route('organization.rental_office_car.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        console.log(data);
                        get_models(data.data.rental_office_car.car_model.brand_id);

                        var vehicle_type = data.data.rental_office_car.vehicle_type;
                        var old_vehicle_type = "{{old('vehicle_type','current')}}";
                        old_vehicle_type = old_vehicle_type.replace('current',vehicle_type);
                        $('.vehicle_type').val(old_vehicle_type);

                        if ($('.vehicle_type').val() == 'pickups') {
                            $('.ghamara_count').removeClass('d-none');

                            var ghamara_count = data.data.rental_office_car.ghamara_count;
                            var old_ghamara_count = "{{old('ghamara_count','current')}}";
                            old_ghamara_count = old_ghamara_count.replace("current",ghamara_count);
                            $('.ghamara_val').val(old_ghamara_count);

                        } else {
                            $('.ghamara_count').addClass('d-none');
                        }

                        $('#brand_id').val(data.data.rental_office_car.car_model.brand_id);
                        $('#car_model_id').val(data.data.rental_office_car.car_model_id);
                        $('#car_class_id').val(data.data.rental_office_car.car_class_id);

                        var manufacture_year = data.data.rental_office_car.manufacture_year;
                        var old_manufacture_year = "{{old('manufacture_year','current')}}";
                        old_manufacture_year = old_manufacture_year.replace('current',manufacture_year);
                        $('#manufacture_year').val(old_manufacture_year);

                        var color = data.data.rental_office_car.color;
                        var old_color = "{{old('color','current')}}";
                        old_color = old_color.replace('current',color);
                        $('#color').val(old_color);

                        var daily_rental_price = data.data.rental_office_car.daily_rental_price;
                        var old_daily_rental_price = "{{old('daily_rental_price','current')}}";
                        old_daily_rental_price = old_daily_rental_price.replace('current',daily_rental_price);
                        $('#daily_rental_price').val(old_daily_rental_price);

                        var weekly_rental_price = data.data.rental_office_car.weekly_rental_price;
                        var old_weekly_rental_price = "{{old('weekly_rental_price','current')}}";
                        old_weekly_rental_price = old_weekly_rental_price.replace('current',weekly_rental_price);
                        $('#weekly_rental_price').val(old_weekly_rental_price);

                        var monthly_rental_price = data.data.rental_office_car.monthly_rental_price;
                        var old_monthly_rental_price = "{{old('monthly_rental_price','current')}}";
                        old_monthly_rental_price = old_monthly_rental_price.replace('current',monthly_rental_price);
                        $('#monthly_rental_price').val(old_monthly_rental_price);

                        var yearly_rental_price = data.data.rental_office_car.yearly_rental_price;
                        var old_yearly_rental_price = "{{old('yearly_rental_price','current')}}";
                        old_yearly_rental_price = old_yearly_rental_price.replace('current',yearly_rental_price);
                        $('#yearly_rental_price').val(old_yearly_rental_price);

                        $('#rental_car_id').val(data.data.rental_office_car.id);
                        if (data.data.rental_office_car.available) {
                            $('#available').prop('checked', true);
                        } else {
                            $('#available').prop('checked', false);
                        }

                        let update = "{{route('organization.rental_office_car.update' , ':id')}}";
                        update = update.replace(':id', data.data.rental_office_car.id);

                        let destroy = "{{route('organization.rental_office_car.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.rental_office_car.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);
                        $('#text_meesage').text(data.data.rental_office_car.car_model.name + ' ' + data.data.rental_office_car.manufacture_year);
                    }
                    // alert(data);
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection

