@extends('dashboard.layouts.standard')
@section('title','Mawatery | Manufacture Countries')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.manufacture_countries')}} <small
                                class="text-secondary">({{ $manufacture_countries->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.manufacture_countries')}}</li>
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
                                    data-target="#storeManufacture_country">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.vehicle_details.manufacture_countries.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($manufacture_countries as $manufacture_country)
                                        <tr class="text-center">
                                            <td>{{$manufacture_country->name_en}}</td>
                                            <td>{{$manufacture_country->name_ar}}</td>
                                            <td>{{$manufacture_country->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_brand" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editManufacture_country"
                                                        onclick="get_manufacture_data({{$manufacture_country->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_manufacture_data({{$manufacture_country->id}})">
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
    @include('dashboard.vehicle_details.manufacture_countries.update')
    @include('dashboard.vehicle_details.manufacture_countries.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeManufacture_country').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editManufacture_country').modal('show');
            @foreach ($errors->get('update_modal') as $error)
                {{--console.log({{ $error }});--}}
                get_manufacture_data({{$error}});
            @endforeach
        @endif

        function get_manufacture_data(id) {
            var url = "{{route('manufacture-countries.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        $('#name_en').val(data.data.show_manufacture_country.name_en);
                        $('#name_ar').val(data.data.show_manufacture_country.name_ar);
                        if (data.data.show_manufacture_country.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }
                        $('#manufacture_id').val(data.data.show_manufacture_country.id);

                        let update = "{{route('manufacture-countries.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_manufacture_country.id);

                        let destroy = "{{route('manufacture-countries.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_manufacture_country.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_manufacture_country.name);
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

