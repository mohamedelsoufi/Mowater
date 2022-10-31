@extends('dashboard.layouts.standard')
@section('title','Mawatery | Fuel Stations')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.fuel_stations')}} <small class="text-secondary">({{ $fuel_stations->count() }}
                                )</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.fuel_stations')}}</li>
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
                                    data-target="#storeFuelStation">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.organizations.fuel_stations.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.logo')}}</th>
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.address')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($fuel_stations as $fuel_station)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$fuel_station->logo)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="logo">
                                                    </a>
                                                @else
                                                    <a href="{{$fuel_station->logo}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$fuel_station->logo}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="logo">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$fuel_station->name}}</td>
                                            <td>{{$fuel_station->address}}</td>
                                            <td>{{$fuel_station->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_fuel_stations"
                                                        class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editFuelStation"
                                                        onclick="get_fuel_station_data({{$fuel_station->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_fuel_station_data({{$fuel_station->id}})">
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
    @include('dashboard.organizations.fuel_stations.update')
    @include('dashboard.organizations.fuel_stations.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeFuelStation').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editFuelStation').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_fuel_station_data({{$error}});

        @endforeach
        @endif

        function get_fuel_station_data(id) {
            var url = "{{route('fuel-stations.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {
                        var name_en = data.data.show_fuel_station.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current", name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_fuel_station.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current", name_ar);
                        $('#name_ar').val(old_name_ar);

                        var address_en = data.data.show_fuel_station.address_en;
                        var old_address_en = "{{old('address_en','current')}}";
                        old_address_en = old_address_en.replace("current", address_en);
                        $('#address_en').val(address_en);

                        var address_ar = data.data.show_fuel_station.address_ar;
                        var old_address_ar = "{{old('address_ar','current')}}";
                        old_address_ar = old_address_ar.replace("current", address_ar);
                        $('#address_ar').val(address_ar);


                        $('#logo').attr("src", data.data.show_fuel_station.logo);

                        if (data.data.show_fuel_station.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }

                        // $work_time && in_array('Sat' , $work_time->days) ? 'checked' : ''
                        if (data.data.show_fuel_station.fuel_types.includes('Gasoline_91')) {
                            $('#Gasoline_91').prop('checked', true);
                        } else {
                            $('#Gasoline_91').prop('checked', false);
                        }

                        if (data.data.show_fuel_station.fuel_types.includes('Gasoline_95')) {
                            $('#Gasoline_95').prop('checked', true);
                        } else {
                            $('#Gasoline_95').prop('checked', false);
                        }

                        if (data.data.show_fuel_station.fuel_types.includes('Gasoline_98')) {
                            $('#Gasoline_98').prop('checked', true);
                        } else {
                            $('#Gasoline_98').prop('checked', false);
                        }

                        if (data.data.show_fuel_station.fuel_types.includes('Diesel')) {
                            $('#Diesel').prop('checked', true);
                        } else {
                            $('#Diesel').prop('checked', false);
                        }

                        $('.email-change').empty();

                        let user_id;
                        data.data.users.forEach(function (user) {
                            user_id = user.id;
                            var option = `<option value ="${user.id}" >${user.email}</option>`;
                            $('.email-change').append(option);
                        });
                        get_user(data.data.show_fuel_station.id, $('.email-change').val());

                        function get_user(org_id, user_id) {
                            var url = "{{route('fuel-station.user' , ['org_id'=>':org_id','user_id'=>':user_id'])}}"
                            url = url.replace(':org_id', org_id);
                            url = url.replace(':user_id', user_id);

                            $.ajax({
                                type: "Get",
                                url: url,
                                datatype: 'JSON',
                                success: function (data) {
                                    if (data.status == true) {
                                        $('.username').val(data.data.user.user_name);
                                    }
                                },
                                error: function (reject) {
                                    alert(reject);
                                }
                            });
                        }

                        $('.email-change').on('change', function () {
                            get_user(data.data.show_fuel_station.id, $('.email-change').val());
                        });


                        var country_id = data.data.show_fuel_station.country_id;
                        var old_country_id = "{{old('country_id','current')}}";
                        old_country_id = old_country_id.replace("current", country_id);
                        $('.country_id').val(old_country_id);

                        get_cities(data.data.show_fuel_station.country_id, data.data.show_fuel_station.city_id, data.data.show_fuel_station.area_id);

                        get_areas(data.data.show_fuel_station.city_id, data.data.show_fuel_station.area_id);


                        $('#fuel_station_id').val(data.data.show_fuel_station.id);

                        let update = "{{route('fuel-stations.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_fuel_station.id);

                        let destroy = "{{route('fuel-stations.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_fuel_station.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_fuel_station.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection

