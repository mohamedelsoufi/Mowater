@extends('dashboard.layouts.standard')
@section('title','Mawatery | Classes')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.car_class')}} <small class="text-secondary">({{ $car_classes->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.car_class')}}</li>
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
                                    data-target="#storeCarClass">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.vehicle_details.car_classes.create')
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
                                    @foreach($car_classes as $car_class)
                                        <tr class="text-center">
                                            <td>{{$car_class->name_en}}</td>
                                            <td>{{$car_class->name_ar}}</td>
                                            <td>{{$car_class->getActive()}}</td>
                                            <td>
                                                <button type="button" id="$show_car_class" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editCarClass"
                                                        onclick="get_car_class_data({{$car_class->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_car_class_data({{$car_class->id}})">
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
    @include('dashboard.vehicle_details.car_classes.update')
    @include('dashboard.vehicle_details.car_classes.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeCarClass').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editCarClass').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_car_class_data({{$error}});

        @endforeach
        @endif

        function get_car_class_data(id) {
            var url = "{{route('car-classes.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        console.log(data);
                        $('#name_en').val(data.data.show_car_class.name_en);
                        $('#name_ar').val(data.data.show_car_class.name_ar);
                        if (data.data.show_car_class.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }
                        $('#car_class_id').val(data.data.show_car_class.id);
                        let update = "{{route('car-classes.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_car_class.id);

                        let destroy = "{{route('car-classes.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_car_class.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);
                        $('#text_meesage').text(data.data.show_car_class.name);
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

