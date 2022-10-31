@extends('dashboard.layouts.standard')
@section('title','Mawatery | Brokers')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.brokers')}} <small class="text-secondary">({{ $brokers->count() }})</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.brokers')}}</li>
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
                                    data-target="#storeBroker">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.organizations.brokers.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.logo')}}</th>
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($brokers as $broker)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$broker->logo)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="logo">
                                                    </a>
                                                @else
                                                    <a href="{{$broker->logo}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/'.$broker->logo)}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"

                                                             alt="logo">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$broker->name}}</td>
                                            <td>{{$broker->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_sparepart" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editBroker"
                                                        onclick="get_broker_data({{$broker->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_broker_data({{$broker->id}})">
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
    @include('dashboard.organizations.brokers.update')
    @include('dashboard.organizations.brokers.delete')
@endsection

@section('scripts')
    <script type="text/javascript">
        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeBroker').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editBroker').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_broker_data({{$error}});

        @endforeach
        @endif

        function get_broker_data(id) {
            var url = "{{route('brokers.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {
                        var name_en = data.data.show_broker.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_broker.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);

                        CKEDITOR.instances.description_ar.setData(data.data.show_broker.description_ar);
                        CKEDITOR.instances.description_en.setData(data.data.show_broker.description_en);
                        CKEDITOR.instances.requirements_ar.setData(data.data.show_broker.requirements_ar);
                        CKEDITOR.instances.requirements_en.setData(data.data.show_broker.requirements_en);

                        var tax_number = data.data.show_broker.tax_number;
                        var old_tax_number = "{{old('tax_number','current')}}";
                        old_tax_number = old_tax_number.replace("current",tax_number);
                        $('#tax_number').val(old_tax_number);

                        // $('#logo').attr("src",data.data.show_agency.logo);
                        $('#logo').attr("src", data.data.show_broker.logo);

                        if (data.data.show_broker.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }

                        if (data.data.show_broker.reservation_active == 1) {
                            $('#reservation_active').prop('checked', true);
                        } else {
                            $('#reservation_active').prop('checked', false);
                        }

                        if (data.data.show_broker.delivery_active == 1) {
                            $('#delivery_active').prop('checked', true);
                        } else {
                            $('#delivery_active').prop('checked', false);
                        }
                        $('#logo').attr("src", 'uploads/' + data.data.show_broker.logo);

                        $('.email-change').empty();
                        console.log(data.data.users);

                        let user_id;
                        data.data.users.forEach(function (user) {
                            user_id = user.id;
                            var option = `<option value ="${user.id}" >${user.email}</option>`;
                            $('.email-change').append(option);
                        });
                        get_user(data.data.show_broker.id, $('.email-change').val());

                        function get_user(org_id, user_id) {
                            var url = "{{route('broker.user' , ['org_id'=>':org_id','user_id'=>':user_id'])}}"
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
                            get_user(data.data.show_broker.id, $('.email-change').val());
                        });


                        $('.country_id').val(data.data.show_broker.country_id);

                        get_cities(data.data.show_broker.country_id, data.data.show_broker.city_id, data.data.show_broker.area_id);

                        get_areas(data.data.show_broker.city_id, data.data.show_broker.area_id);

                        $('#broker_id').val(data.data.show_broker.id);

                        let update = "{{route('brokers.update', ':id')}}";
                        update = update.replace(':id', data.data.show_broker.id);

                        let destroy = "{{route('brokers.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_broker.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_message').text(data.data.show_broker.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection
