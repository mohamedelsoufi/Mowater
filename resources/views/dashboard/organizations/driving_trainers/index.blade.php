@extends('dashboard.layouts.standard')
@section('title','Mawatery | Trainers')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.driving_trainers')}} <small class="text-secondary">({{ $trainers->count() }}
                                )</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.driving_trainers')}}</li>
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
                                    data-target="#storeTrainer">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.organizations.driving_trainers.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.profile_picture')}}</th>
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($trainers as $trainer)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$trainer->profile_picture)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}"
                                                             alt="logo">
                                                    </a>
                                                @else
                                                    <a href="{{$trainer->profile_picture}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset($trainer->profile)}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="profile_picture"></a>
                                                @endif

                                            </td>
                                            <td>{{$trainer->name}}</td>
                                            <td>{{$trainer->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_sparepart" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editTrainer"
                                                        onclick="get_trainer_data({{$trainer->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_trainer_data({{$trainer->id}})">
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
    @include('dashboard.organizations.driving_trainers.update')
    @include('dashboard.organizations.driving_trainers.delete')
@endsection

@section('scripts')
    @include('change_brand')
    <script type="text/javascript">
        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeTrainer').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editTrainer').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_trainer_data({{$error}});

        @endforeach
        @endif

        function get_trainer_data(id) {
            var url = "{{route('trainers.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        var name_en = data.data.show_trainer.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_trainer.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);

                        CKEDITOR.instances.description_ar.setData(data.data.show_trainer.description_ar);
                        CKEDITOR.instances.description_en.setData(data.data.show_trainer.description_en);

                        // $('#logo').attr("src", data.data.show_trainer.logo);
                        // $('#logo').attr("src", 'uploads/' + data.data.show_trainer.logo);
                        $('#trainer_id').val(data.data.show_trainer.id);

                        if (data.data.show_trainer.hasOwnProperty('brand_id')) {
                            $('.brands').removeClass('d-none');
                            if (data.data.show_trainer.brand_id) {
                                var brand_id = data.data.show_trainer.brand_id;
                                var old_brand_id = "{{old('brand_id','current')}}";
                                old_brand_id = old_brand_id.replace("current",brand_id);
                                $('.brand_id').val(old_brand_id);

                                if (data.data.show_trainer.brand_id) {
                                    get_models(data.data.show_trainer.car_model.brand_id);
                                }
                            }

                            var car_model_id = data.data.show_trainer.car_model_id;
                            var old_car_model_id = "{{old('car_model_id','current')}}";
                            old_car_model_id = old_car_model_id.replace("current",car_model_id);
                            $('#car_model_id').val(old_car_model_id);

                        } else {
                            // $('#brand_id').val('');
                            $('.brands').addClass('d-none');
                        }

                        var car_class_id = data.data.show_trainer.car_class_id;
                        var old_car_class_id = "{{old('car_class_id','current')}}";
                        old_car_class_id = old_car_class_id.replace("current",car_class_id);
                        $('#car_class_id').val(old_car_class_id);

                        var vehicle_type = data.data.show_trainer.vehicle_type;
                        var old_vehicle_type = "{{old('vehicle_type','current')}}";
                        old_vehicle_type = old_vehicle_type.replace("current",vehicle_type);
                        $('#vehicle_type').val(old_vehicle_type);

                        var manufacturing_year = data.data.show_trainer.manufacturing_year;
                        var old_manufacturing_year = "{{old('manufacturing_year','current')}}";
                        old_manufacturing_year = old_manufacturing_year.replace("current",manufacturing_year);
                        $('#manufacturing_year').val(old_manufacturing_year);

                        if (data.data.show_trainer.birth_date) {
                            var birth_date = data.data.show_trainer.birth_date;
                            var old_birth_date = "{{old('birth_date','current')}}";
                            old_birth_date = old_birth_date.replace("current",birth_date);
                            $('.birth_date').val(old_birth_date);
                        }
                        $('#license').attr("src", data.data.show_trainer.file_url);

                        var country_id = data.data.show_trainer.country_id;
                        var old_country_id = "{{old('country_id','current')}}";
                        old_country_id = old_country_id.replace("current",country_id);

                        $('.email-change').empty();

                        let user_id;
                        data.data.users.forEach(function (user) {
                            user_id = user.id;
                            var option = `<option value ="${user.id}" >${user.email}</option>`;
                            $('.email-change').append(option);
                        });
                        get_user(data.data.show_trainer.id, $('.email-change').val());

                        function get_user(org_id, user_id) {
                            var url = "{{route('trainer.user' , ['org_id'=>':org_id','user_id'=>':user_id'])}}"
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
                            get_user(data.data.show_trainer.id, $('.email-change').val());
                        });


                        $('.country_id').val(old_country_id);

                        get_cities(data.data.show_trainer.country_id, data.data.show_trainer.city_id, data.data.show_trainer.area_id);

                        // if (data.data.show_trainer.hasOwnProperty('profile_picture')) {
                        //     $('.profile_picture').removeClass('d-none');

                        $('#profile_picture').attr("src", data.data.show_trainer.profile);
                        // } else {
                        //     $('.profile_picture').addClass('d-none');
                        //
                        // }

                        var gender = data.data.show_trainer.gender;
                        var old_gender = "{{old('gender','current')}}";
                        old_gender = old_gender.replace("current",gender);
                        $('#gender').val(old_gender);

                        var conveyor_type = data.data.show_trainer.conveyor_type;
                        var old_conveyor_type = "{{old('conveyor_type','current')}}";
                        old_conveyor_type = old_conveyor_type.replace("current",conveyor_type);
                        $('#conveyor_type').val(old_conveyor_type);

                        if (data.data.show_trainer.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }
                        // $('#hour_price').val(data.data.show_trainer.hour_price);
                        //get_areas(data.data.show_trainer.city_id, data.data.show_trainer.area_id);

                        var hour_price = data.data.show_trainer.hour_price;
                        var old_hour_price = "{{old('hour_price','current')}}";
                        old_hour_price = old_hour_price.replace("current",hour_price);
                        $('#hour_price').val(old_hour_price);

                        let update = "{{route('trainers.update', ':id')}}";
                        update = update.replace(':id', data.data.show_trainer.id);

                        let destroy = "{{route('trainers.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_trainer.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_message').text(data.data.show_trainer.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection
