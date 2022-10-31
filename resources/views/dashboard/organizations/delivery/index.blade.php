@extends('dashboard.layouts.standard')
@section('title','Mawatery | Delivery Men')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.delivery_men')}} <small class="text-secondary">({{ $delivery_men->count() }}
                                )</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.delivery')}}</li>
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
                                    data-target="#storeDelivery">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.organizations.delivery.create')
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
                                    @foreach($delivery_men as $delivery_man)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$delivery_man->profile_picture)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}"
                                                             alt="logo">
                                                    </a>
                                                @else
                                                    <a href="{{$delivery_man->profile_picture}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset($delivery_man->profile)}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="profile_picture"></a>
                                                @endif

                                            </td>
                                            <td>{{$delivery_man->name}}</td>
                                            <td>{{$delivery_man->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_sparepart" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editDelivery"
                                                        onclick="get_delivery_data({{$delivery_man->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_delivery_data({{$delivery_man->id}})">
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
    @include('dashboard.organizations.delivery.update')
    @include('dashboard.organizations.delivery.delete')
@endsection

@section('scripts')
    @include('change_brand')
    <script type="text/javascript">
        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeDelivery').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editDelivery').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_delivery_data({{$error}});

        @endforeach
        @endif

        function get_delivery_data(id) {
            var url = "{{route('delivery.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        var name_en = data.data.show_delivery.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_delivery.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);

                        CKEDITOR.instances.description_ar.setData(data.data.show_delivery.description_ar);
                        CKEDITOR.instances.description_en.setData(data.data.show_delivery.description_en);
                        $('#logo').attr("src", data.data.show_delivery.logo);

                        var brand_id = data.data.show_delivery.brand_id;
                        var old_brand_id = "{{old('brand_id','current')}}";
                        old_brand_id = old_brand_id.replace("current",brand_id);
                        $('.brand_id').val(old_brand_id);

                        if (data.data.show_delivery.brand_id) {
                            get_models(data.data.show_delivery.car_model.brand_id);
                        }

                        var car_model_id = data.data.show_delivery.car_model_id;
                        var old_car_model_id = "{{old('car_model_id','current')}}";
                        old_car_model_id = old_car_model_id.replace("current",car_model_id);
                        $('#car_model_id').val(old_car_model_id);

                        var car_class_id = data.data.show_delivery.car_class_id;
                        var old_car_class_id = "{{old('car_class_id','current')}}";
                        old_car_class_id = old_car_class_id.replace("current",car_class_id);
                        $('#car_class_id').val(old_car_class_id);

                        var category_id = data.data.show_delivery.category_id;
                        var old_category_id = "{{old('category_id','current')}}";
                        old_category_id = old_category_id.replace("current",category_id);
                        $('#category_id').val(old_category_id);

                        var manufacturing_year = data.data.show_delivery.manufacturing_year;
                        var old_manufacturing_year = "{{old('manufacturing_year','current')}}";
                        old_manufacturing_year = old_manufacturing_year.replace("current",manufacturing_year);
                        $('#manufacturing_year').val(old_manufacturing_year);

                        $('#profile_picture').attr("src", data.data.show_delivery.profile);
                        if (data.data.show_delivery.birth_date) {
                            var birth_date = data.data.show_delivery.birth_date;
                            var old_birth_date = "{{old('birth_date','current')}}";
                            old_birth_date = old_birth_date.replace("current",birth_date);
                            $('.birth_date').val(old_birth_date);

                        }
                        var conveyor_type = data.data.show_delivery.conveyor_type;
                        var old_conveyor_type = "{{old('conveyor_type','current')}}";
                        old_conveyor_type = old_conveyor_type.replace("current",conveyor_type);
                        $('#conveyor_type').val(old_conveyor_type);

                        // if (data.data.show_delivery.hasOwnProperty('profile_picture')) {
                        //     $('.profile_picture').removeClass('d-none');

                        // } else {
                        //     $('.profile_picture').addClass('d-none');
                        //
                        // }
                        // if (data.data.show_trainer.hasOwnProperty('file')) {
                        $('#license').attr("src", data.data.show_delivery.file_url);
                        // }
                        if (data.data.show_delivery.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }
                        $('#car_type').val(data.data.show_delivery.car_type);

                        $('#logo').attr("src", 'uploads/' + data.data.show_delivery.logo);

                        $('.email-change').empty();

                        let user_id;
                        data.data.users.forEach(function (user) {
                            user_id = user.id;
                            var option = `<option value ="${user.id}" >${user.email}</option>`;
                            $('.email-change').append(option);
                        });
                        get_user(data.data.show_delivery.id, $('.email-change').val());

                        function get_user(org_id, user_id) {
                            var url = "{{route('delivery-user.user' , ['org_id'=>':org_id','user_id'=>':user_id'])}}"
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
                            get_user(data.data.show_delivery.id, $('.email-change').val());
                        });


                        $('.country_id').val(data.data.show_delivery.country_id);

                        get_cities(data.data.show_delivery.country_id, data.data.show_delivery.city_id, data.data.show_delivery.area_id);

                        get_areas(data.data.show_delivery.city_id, data.data.show_delivery.area_id);

                        var hour_price = data.data.show_delivery.hour_price;
                        var old_hour_price = "{{old('hour_price','current')}}";
                        old_hour_price = old_hour_price.replace("current",hour_price);
                        $('#hour_price').val(old_hour_price);

                        var gender = data.data.show_delivery.gender;
                        var old_gender = "{{old('gender','current')}}";
                        old_gender = old_gender.replace("current",gender);
                        $('#gender').val(old_gender);

                        $('#delivery_id').val(data.data.show_delivery.id);
                        let update = "{{route('delivery.update', ':id')}}";
                        update = update.replace(':id', data.data.show_delivery.id);

                        let destroy = "{{route('delivery.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_delivery.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_message').text(data.data.show_delivery.name);
                        // if (data.data.show_trainer.hasOwnProperty('file')) {
                        //     $('#license').attr("src", data.data.show_trainer.file.path);
                        // }
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection
