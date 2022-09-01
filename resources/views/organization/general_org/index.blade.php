@extends('organization.layouts.app')
@section('title','Mawatery | Organization')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{$record->name}}
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{$record->name}}</li>
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

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table header-border table-hover verticle-middle">
                                    <thead class="text-dark">
                                    <tr class="text-center">
                                        @if(isset($record->logo))
                                            <th>{{__('words.logo')}}</th>
                                        @else
                                            <th>{{__('words.profile_picture')}}</th>
                                        @endif
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.available')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    <tr class="text-center">
                                        <td>
                                            @if(isset($record->logo))
                                                <a href="{{$record->logo}}"
                                                   data-toggle="lightbox">
                                                    <img class="slider_image"
                                                         src="{{$record->logo}}"
                                                         onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                         alt="logo">
                                                </a>
                                            @elseif(isset($record->profile_picture))
                                                <a href="{{$record->profile}}"
                                                   data-toggle="lightbox">
                                                    <img class="slider_image"
                                                         src="{{asset($record->profile)}}"
                                                         onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                         alt="profile_picture"></a>
                                            @else
                                                <a href="{{asset('uploads/default_image.png')}}"
                                                   data-toggle="lightbox">
                                                    <img class="slider_image"
                                                         src="{{asset('uploads/default_image.png')}}"
                                                         alt="logo">
                                                </a>

                                            @endif
                                        </td>
                                        <td>{{$record->name}}</td>
                                        <td>{{$record->getAvailable()}}</td>
                                        <td>
                                            <button type="button" id="show_organization" class="btn btn-outline-info"
                                                    data-toggle="modal"
                                                    data-target="#editOrganization"
                                                    onclick="get_organization_data({{$record->id}})">
                                                {{__('words.show')}}
                                            </button>


                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('organization.general_org.update')

@endsection

@section('scripts')
    @include('change_brand')
    <script type="text/javascript">
        $('.yearpicker').yearpicker()


        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeOrganization').modal('show');
        @if(old('brand_id'))
        get_models("{{old('brand_id')}}");
        @endif
        @elseif($errors->has('update_modal'))
        $('#editOrganization').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_organization_data({{$error}});

        @endforeach
        @endif

        function get_organization_data(id) {
            var url = "{{route('organization.organizations.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#name_en').val(data.data.show_organization.name_en);
                        $('#name_ar').val(data.data.show_organization.name_ar);

                        // CKEDITOR.instances.description_ar.setData(data.data.show_organization.description_ar);
                        // CKEDITOR.instances.description_en.setData(data.data.show_organization.description_en);
                        $('#description_ar').val(data.data.show_organization.description_ar);
                        $('#description_en').val(data.data.show_organization.description_en);

                        if (data.data.show_organization.hasOwnProperty('address_en')) {
                            $('.desc').addClass('d-none');
                            $('.address').removeClass('d-none');
                            $('#address_en').val(data.data.show_organization.address_en);
                            $('#address_ar').val(data.data.show_organization.address_ar);
                        }
                        if (data.data.show_organization.hasOwnProperty('fuel_types')) {
                            $('.fuel_station').removeClass('d-none');
                            if (data.data.show_organization.fuel_types.includes('Gasoline_91')) {
                                $('#Gasoline_91').prop('checked', true);
                            } else {
                                $('#Gasoline_91').prop('checked', false);
                            }

                            if (data.data.show_organization.fuel_types.includes('Gasoline_95')) {
                                $('#Gasoline_95').prop('checked', true);
                            } else {
                                $('#Gasoline_95').prop('checked', false);
                            }

                            if (data.data.show_organization.fuel_types.includes('Gasoline_98')) {
                                $('#Gasoline_98').prop('checked', true);
                            } else {
                                $('#Gasoline_98').prop('checked', false);
                            }

                            if (data.data.show_organization.fuel_types.includes('Diesel')) {
                                $('#Diesel').prop('checked', true);
                            } else {
                                $('#Diesel').prop('checked', false);
                            }
                        }

                        if (data.data.show_organization.hasOwnProperty('brand_id')) {
                            $('.brands').removeClass('d-none');
                            // console.log(data.data.show_organization.brand_id);
                            if (data.data.show_organization.brand_id) {
                                $('#brand_id').val(data.data.show_organization.brand_id);
                                if (data.data.show_organization.hasOwnProperty('car_model_id')) {
                                    $('.car_models').removeClass('d-none');
                                    // car_details
                                    $('.car_details').removeClass('d-none');

                                    get_models(data.data.show_organization.car_model.brand_id);
                                    $('#car_model_id').val(data.data.show_organization.car_model_id);
                                } else {
                                    $('.car_models').addClass('d-none');
                                    $('.car_details').addClass('d-none');
                                }
                            }
                        } else {
                            $('.brands').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('birth_date')) {
                            $('.birth_date').removeClass('d-none');
                            if (data.data.show_organization.birth_date) {
                                $('.birth_date').val(data.data.show_organization.birth_date);
                            }
                        } else {
                            $('.birth_date').addClass('d-none');

                        }
                        if (data.data.show_organization.hasOwnProperty('vehicle_type')) {
                            $('.vehicle_type').removeClass('d-none');
                            if (data.data.show_organization.vehicle_type) {
                                $('#vehicle_type').val(data.data.show_organization.vehicle_type);
                            }
                        } else {
                            $('.vehicle_type').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('car_class_id')) {
                            $('.car_classes').removeClass('d-none');
                            $('#car_class_id').val(data.data.show_organization.car_class_id);
                        } else {
                            $('.car_classes').addClass('d-none');

                        }
                        if (data.data.show_organization.hasOwnProperty('category_id')) {
                            $('.categories').removeClass('d-none');
                            $('#category_id').val(data.data.show_organization.category_id);
                        } else {
                            $('.categories').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('tax_number')) {
                            $('.tax_number').removeClass('d-none');

                            $('#tax_number').val(data.data.show_organization.tax_number);
                        } else {
                            $('.tax_number').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('hour_price')) {
                            $('.hour_price').removeClass('d-none');
                            // console.log(data.data.show_organization.hour_price);
                            $('#hour_price').val(data.data.show_organization.hour_price);
                        } else {
                            $('.hour_price').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('logo')) {
                            $('.logo').removeClass('d-none');

                            $('#logo').attr("src", data.data.show_organization.logo);
                        } else {
                            $('.logo').addClass('d-none');

                        }

                        if (data.data.show_organization.hasOwnProperty('profile')) {
                            $('.profile_picture').removeClass('d-none');
                            $('#profile_picture').attr("src", data.data.show_organization.profile);
                        } else {
                            $('.profile_picture').addClass('d-none');

                        }
                        if (data.data.show_organization.available == 1) {
                            $('#available').prop('checked', true);
                        } else {
                            $('#available').prop('checked', false);
                        }
                        if (data.data.show_organization.hasOwnProperty('requirements')) {
                            $('.requirements').removeClass('d-none');
                            CKEDITOR.instances.requirements_ar.setData(data.data.show_organization.requirements_ar);
                            CKEDITOR.instances.requirements_en.setData(data.data.show_organization.requirements_en);
                        } else {
                            $('.requirements').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('gender')) {
                            $('.gender_display').removeClass('d-none');
                            $('.gender').val(data.data.show_organization.gender);
                        } else {
                            $('.gender_display').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('conveyor_type')) {
                            $('.conveyor_type_display').removeClass('d-none');
                            $('#conveyor_type').val(data.data.show_organization.conveyor_type);
                        } else {
                            $('.conveyor_type').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('files')) {
                            $('.files').removeClass('d-none');
                            $('#license').attr("src", data.data.show_organization.files.map(
                                file => file.path
                            ));
                        } else if (data.data.show_organization.hasOwnProperty('file')) {
                            $('.files').removeClass('d-none');
                            $('#license').attr("src", data.data.show_organization.file_url);

                        } else {
                            $('.files').addClass('d-none');
                        }

                        if (data.data.show_organization.hasOwnProperty('manufacturing_year')) {
                            $('.manufacturing_year').removeClass('d-none');
                            $('#manufacturing_year').val(data.data.show_organization.manufacturing_year);
                        } else {
                            $('.manufacturing_year').addClass('d-none');

                        }
                        if (data.data.show_organization.hasOwnProperty('reservation_availability')) {
                            $('.reservation_availability').removeClass('d-none');
                            console.log('menna');
                            if (data.data.show_organization.reservation_availability == 1) {
                                $('#reservation_availability').prop('checked', true);
                            } else {
                                $('#reservation_availability').prop('checked', false);
                            }
                        } else {
                            $('.reservation_availability').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('reservation_active')) {
                            $('.reservation_active').removeClass('d-none');

                            if (data.data.show_organization.reservation_active == 1) {
                                $('#reservation_active').prop('checked', true);
                            } else {
                                $('#reservation_active').prop('checked', false);
                            }
                        } else {
                            $('.reservation_active').addClass('d-none');
                        }
                        if (data.data.show_organization.hasOwnProperty('delivery_availability')) {
                            $('.delivery_availability').removeClass('d-none');

                            if (data.data.show_organization.delivery_availability == 1) {
                                $('#delivery_availability').prop('checked', true);
                            } else {
                                $('#delivery_availability').prop('checked', false);
                            }
                        } else {
                            $('.delivery_availability').addClass('d-none');
                        }

                        if (data.data.show_organization.hasOwnProperty('delivery_active')) {
                            $('.delivery_active').removeClass('d-none');

                            if (data.data.show_organization.delivery_active == 1) {
                                $('#delivery_active').prop('checked', true);
                            } else {
                                $('#delivery_active').prop('checked', false);
                            }
                        } else {
                            $('.delivery_active').addClass('d-none');
                        }

                        if (data.data.show_organization.available == 1) {
                            $('#available').prop('checked', true);
                        } else {
                            $('#available').prop('checked', false);
                        }
                        $('.country_id').val(data.data.show_organization.country_id);

                        get_cities(data.data.show_organization.country_id, data.data.show_organization.city_id, data.data.show_organization.area_id);

                        get_areas(data.data.show_organization.city_id, data.data.show_organization.area_id);

                        if (data.data.show_organization.hasOwnProperty('year_founded')) {
                            $('.year_founded').removeClass('d-none');
                            $('#year_founded').val(data.data.show_organization.year_founded);
                        } else {
                            $('.year_founded').addClass('d-none');

                        }
                        if (data.data.show_organization.hasOwnProperty('latitude')) {
                            $('.coordinates').removeClass('d-none');
                            $('#latitude').val(data.data.show_organization.latitude);
                            $('#longitude').val(data.data.show_organization.longitude);

                        } else {
                            $('.coordinates').addClass('d-none');
                        }


                        $('#organization_id').val(data.data.show_organization.id);

                        let update = "{{route('organization.organizations.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_organization.id);

                        let destroy = "{{route('organization.organizations.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_organization.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_organization.name);

                        // //model type
                        // if (data.data.model_type == 'App\\Models\\DrivingTrainer' || data.data.model_type == 'App\\Models\\Deliery') {
                        //
                        // }
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

        function getLocation() {
            const p = document.querySelector('#demo');

            function onError() {
                p.textContent = 'Unable to locate you'
            }

            function onSuccess(position) {

                // p.textContent = `Latitude: ${position.coords.latitude} , Longitude: ${position.coords.longitude} `;

                $('#latitude').val(position.coords.latitude);
                $('#longitude').val(position.coords.longitude);
            }

            if (!navigator.geolocation) {
                // This browser doesn't support Geolocation, show an error
                onError();
            } else {
                // Get the current position of the user!
                navigator.geolocation.getCurrentPosition(onSuccess, onError);
            }
        }
    </script>
@endsection

