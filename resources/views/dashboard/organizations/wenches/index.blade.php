@extends('dashboard.layouts.standard')
@section('title','Mawatery | Wench')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.wenches')}} <small class="text-secondary">({{ $wenches->count() }})</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.wenches')}}</li>
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
                                    data-target="#storeWench">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.organizations.wenches.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.logo')}}</th>
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.wench_type')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($wenches as $wench)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$wench->logo)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="logo">
                                                    </a>
                                                @else
                                                    <a href="{{$wench->logo}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$wench->logo}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="logo">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$wench->name}}</td>
                                            <td>
                                                @foreach(wench_type_arr() as $key=>$val)
                                                    @if($wench->wench_type === $key)
                                                        {{$val}}
                                                    @endif
                                                @endforeach

                                            </td>
                                            <td>{{$wench->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_wenchs"
                                                        class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editWench"
                                                        onclick="get_wench_data({{$wench->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_wench_data({{$wench->id}})">
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
    @include('dashboard.organizations.wenches.update')
    @include('dashboard.organizations.wenches.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeWench').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editWench').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_wench_data({{$error}});

        @endforeach
        @endif

        function get_wench_data(id) {
            var url = "{{route('wenches.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {
                        var name_en = data.data.show_wench.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_wench.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);

                        CKEDITOR.instances.description_ar.setData(data.data.show_wench.description_ar);
                        CKEDITOR.instances.description_en.setData(data.data.show_wench.description_en);

                        var tax_number = data.data.show_wench.tax_number;
                        var old_tax_number = "{{old('tax_number','current')}}";
                        old_tax_number = old_tax_number.replace("current",tax_number);
                        $('#tax_number').val(old_tax_number);

                        var wench_type = data.data.show_wench.wench_type;
                        var old_wench_type = "{{old('wench_type','current')}}";
                        old_wench_type = old_wench_type.replace("current",wench_type);
                        $('#wench_type').val(old_wench_type);

                        $('#logo').attr("src", data.data.show_wench.logo);

                        if (data.data.show_wench.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }

                        if (data.data.show_wench.reservation_active == 1) {
                            $('#reservation_active').prop('checked', true);
                        } else {
                            $('#reservation_active').prop('checked', false);
                        }

                        if (data.data.show_wench.delivery_active == 1) {
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
                        get_user(data.data.show_wench.id, $('.email-change').val());

                        function get_user(org_id, user_id) {
                            var url = "{{route('wench.user' , ['org_id'=>':org_id','user_id'=>':user_id'])}}"
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
                            get_user(data.data.show_wench.id, $('.email-change').val());
                        });


                        var country_id = data.data.show_wench.country_id;
                        var old_country_id = "{{old('country_id','current')}}";
                        old_country_id = old_country_id.replace("current",country_id);
                        $('.country_id').val(old_country_id);

                        get_cities(data.data.show_wench.country_id,data.data.show_wench.city_id,data.data.show_wench.area_id);

                        get_areas(data.data.show_wench.city_id,data.data.show_wench.area_id);

                        var year_founded = data.data.show_wench.year_founded;
                        var old_year_founded = "{{old('year_founded','current')}}";
                        old_year_founded = old_year_founded.replace("current",year_founded);
                        $('#year_founded').val(old_year_founded);

                        $('#wench_id').val(data.data.show_wench.id);

                        let update = "{{route('wenches.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_wench.id);

                        let destroy = "{{route('wenches.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_wench.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_wench.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection

