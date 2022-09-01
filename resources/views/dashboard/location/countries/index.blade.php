@extends('dashboard.layouts.standard')
@section('title','Mawatery | Countries')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.countries')}} <small
                                class="text-secondary">({{ $countries->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.countries')}}</li>
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
                            <button type="button" class="btn btn-primary" id="create" data-toggle="modal"
                                    data-target="#storeCountry">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.location.countries.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.image_s')}}</th>
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($countries as $country)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$country->image)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="logo">
                                                    </a>
                                                @else
                                                    <a href="{{$country->image}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$country->image}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="logo">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$country->name_en}}</td>
                                            <td>{{$country->name_ar}}</td>
                                            <td>
                                                <button type="button" id="show_brand" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editCountry"
                                                        onclick="get_manufacture_data({{$country->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_manufacture_data({{$country->id}})">
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
    @include('dashboard.location.countries.update')
    @include('dashboard.location.countries.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeCountry').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editCountry').modal('show');
            @foreach ($errors->get('update_modal') as $error)
                {{--console.log({{ $error }});--}}
                get_manufacture_data({{$error}});
            @endforeach
        @endif

        function get_manufacture_data(id) {
            var url = "{{route('countries.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        // console.log(data);
                        var name_en = data.data.show_country.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_country.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);

                        $('#flag').attr("src",data.data.show_country.image);

                        var currency_id = data.data.show_country.currency_id;
                        var old_currency_id = "{{old('currency_id','current')}}";
                        old_currency_id = old_currency_id.replace("current",currency_id);
                        $('#currency_id').val(old_currency_id);

                        $('#country_id').val(data.data.show_country.id);

                        let update = "{{route('countries.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_country.id);

                        let destroy = "{{route('countries.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_country.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_country.name);
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

