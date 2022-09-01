@extends('organization.layouts.app')
@section('title','Mawatery | Vehicles')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.vehicles')}} <small class="text-secondary">({{ $vehicles->count() }}
                                )</small> ({{$organization->brand ? $organization->brand->name : ''}})</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.vehicles')}}</li>
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
                            <!-- Button trigger modal -->
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.vehicle_image')}}</th>
                                        <th>{{__('words.s_car_model')}}</th>
                                        <th>{{__('words.s_car_class')}}</th>
                                        <th>{{__('words.vehicle_status')}}</th>
                                        <th>{{__('words.price')}} ({{__('words.bhd')}})</th>
                                        <th>{{__('words.availability')}}</th>
                                        <th>{{__('words.created_at')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($vehicles as $vehicle)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$vehicle->one_image)
                                                    <img class="slider_image"
                                                         src="{{asset('uploads/default_image.png')}}" alt="">
                                                @else
                                                    <a href="{{$vehicle->one_image}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$vehicle->one_image}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$vehicle->car_model->name}}</td>
                                            <td>{{$vehicle->car_class->name}}</td>
                                            <td>{{$vehicle->getIsNew()}}</td>
                                            <td>{{$vehicle->price}}</td>

                                            <td>{{$vehicle->getAvailability()}}</td>
                                            <td> {{ date('l d-m-Y', strtotime($vehicle->created_at)) }}<br>
                                                {{ date('h:i A', strtotime($vehicle->created_at)) }}
                                            </td>
                                            <td>

                                                <a class="text-info"
                                                   href="{{route('organization.vehicles.edit', $vehicle->id)}}">
                                                    <button type="button" id="show_vehicle"
                                                            class="btn btn-outline-info">{{__('words.show')}}
                                                    </button>
                                                </a>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_vehicle_data({{$vehicle->id}})">
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
    @include('organization.vehicles.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        function get_vehicle_data(id) {

            var url = "{{route('organization.vehicles.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
// console.log(data);
                        $('#vehicle_id').val(data.data.show_vehicle.id);

                        let destroy = "{{route('organization.vehicles.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_vehicle.id);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_vehicle.brand.name + ' | ' + data.data.show_vehicle.car_model.name + ' | ' + data.data.show_vehicle.car_class.name);
                        // console.log(data.data.show_vehicle.brand.name + ' | ' + data.data.show_vehicle.car_model.name + ' | ' + data.data.show_vehicle.car_class.name);
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

