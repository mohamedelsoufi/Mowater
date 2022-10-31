@extends('dashboard.layouts.standard')
@section('title','Mawatery | Spare Part')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.spareparts')}} <small class="text-secondary">({{ $spareparts->count() }}
                                )</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.spareparts')}}</li>
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
                                    data-target="#storeSparepart">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.organizations.spareparts.create')
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
                                    @foreach($spareparts as $sparepart)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$sparepart->logo)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="logo">
                                                    </a>
                                                @else
                                                    <a href="{{$sparepart->logo}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$sparepart->logo}}"
                                                             alt="logo">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$sparepart->name}}</td>
                                            <td>{{$sparepart->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_sparepart" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editSparepart"
                                                        onclick="get_sparepart_data({{$sparepart->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_sparepart_data({{$sparepart->id}})">
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
    @include('dashboard.organizations.spareparts.update')
    @include('dashboard.organizations.spareparts.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeSparepart').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editSparepart').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_sparepart_data({{$error}});

        @endforeach
        @endif

        function get_sparepart_data(id) {
            var url = "{{route('spareparts.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        var name_en = data.data.show_sparepart.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_sparepart.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);


                        CKEDITOR.instances.description_ar.setData(data.data.show_sparepart.description_ar);
                        CKEDITOR.instances.description_en.setData(data.data.show_sparepart.description_en);
                        $('#logo').attr("src", data.data.show_sparepart.logo);

                        if (data.data.show_sparepart.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }

                        if (data.data.show_sparepart.reservation_active == 1) {
                            $('#reservation_active').prop('checked', true);
                        } else {
                            $('#reservation_active').prop('checked', false);
                        }

                        if (data.data.show_sparepart.delivery_active == 1) {
                            $('#delivery_active').prop('checked', true);
                        } else {
                            $('#delivery_active').prop('checked', false);
                        }

                        $('.email-change').empty();

                        let user_id;
                        data.data.users.forEach(function (user) {
                            user_id = user.id;
                            var option = `<option value ="${user.id}" >${user.email}</option>`;
                            $('.email-change').append(option);
                        });
                        get_user(data.data.show_sparepart.id, $('.email-change').val());

                        function get_user(org_id, user_id) {
                            var url = "{{route('sparepart.user' , ['org_id'=>':org_id','user_id'=>':user_id'])}}"
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
                            get_user(data.data.show_sparepart.id, $('.email-change').val());
                        });



                        var country_id = data.data.show_sparepart.country_id;
                        var old_country_id = "{{old('country_id','current')}}";
                        old_country_id = old_country_id.replace("current",country_id);
                        $('.country_id').val(old_country_id);

                        get_cities(data.data.show_sparepart.country_id, data.data.show_sparepart.city_id, data.data.show_sparepart.area_id);

                        get_areas(data.data.show_sparepart.city_id, data.data.show_sparepart.area_id);

                        var year_founded = data.data.show_sparepart.year_founded;
                        var old_year_founded = "{{old('year_founded','current')}}";
                        old_year_founded = old_year_founded.replace("current",year_founded);
                        $('#year_founded').val(old_year_founded);

                        $('#sparepart_id').val(data.data.show_sparepart.id);

                        let update = "{{route('spareparts.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_sparepart.id);

                        let destroy = "{{route('spareparts.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_sparepart.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_sparepart.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection
