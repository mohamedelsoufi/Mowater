@extends('dashboard.layouts.standard')
@section('title','Mawatery | Models')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.car_model')}} <small class="text-secondary">({{ $car_models->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.car_model')}}</li>
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
                                    data-target="#storeCarModel">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.vehicle_details.car_models.create')
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
                                        <th>{{__('words.brand')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($car_models as $car_model)
                                        <tr class="text-center">
                                            <td>{{$car_model->name_en}}</td>
                                            <td>{{$car_model->name_ar}}</td>
                                            <td>{{$car_model->getActive()}}</td>
                                            <td>{{$car_model->brand->name}}</td>
                                            <td>
                                                <button type="button" id="show_car_models" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editCarModel"
                                                        onclick="get_car_model_data({{$car_model->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_car_model_data({{$car_model->id}})">
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
    @include('dashboard.vehicle_details.car_models.update')
    @include('dashboard.vehicle_details.car_models.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeCarModel').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editCarModel').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_car_model_data({{$error}});

        @endforeach
        @endif

        function get_car_model_data(id) {
            var url = "{{route('car-models.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        console.log(data);
                        $('#name_en').val(data.data.show_car_models.name_en);
                        $('#name_ar').val(data.data.show_car_models.name_ar);
                        $('#brand_id').val(data.data.show_car_models.brand_id);
                        if (data.data.show_car_models.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }
                        $('#car_model_id').val(data.data.show_car_models.id);
                        let update = "{{route('car-models.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_car_models.id);

                        let destroy = "{{route('car-models.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_car_models.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);
                        $('#text_meesage').text(data.data.show_car_models.name);
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

