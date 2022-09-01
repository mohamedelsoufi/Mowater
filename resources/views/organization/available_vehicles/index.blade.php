@extends('organization.layouts.app')
@section('title','Mawatery | Available Vehicles')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.available_vehicles')}}  <small class="text-secondary">({{ $available_vehicles->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.available_vehicles')}}</li>
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
                            <a href = "{{route('organization.available_vehicle.create')}}" class="btn btn-primary">{{__('words.create')}}</a>

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.image_s')}}</th>
                                        <th>{{__('words.car_model')}}</th>
                                        <th>{{__('words.car_class')}}</th>
                                        <th>{{__('vehicle.manufacturing_year')}}</th>
{{--                                        <th>{{__('vehicle.body_shape')}}</th>--}}
                                        {{-- <th>{{__('words.actions')}}</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($available_vehicles as $available_vehicle)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$available_vehicle->one_image)
                                                    <a href="{{asset('uploads/default_image.png')}}" data-toggle="lightbox">
                                                        <img class="slider_image" src="{{asset('uploads/default_image.png')}}" alt="">
                                                    </a>
                                                @else
                                                    <a href="{{$available_vehicle->one_image}}" data-toggle="lightbox">
                                                        <img class="slider_image" src="{{$available_vehicle->one_image}}" onerror="this.src='{{asset('uploads/default_image.png')}}'" alt="">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$available_vehicle->car_model ? $available_vehicle->car_model->name : '--'}}</td>
                                            <td>{{$available_vehicle->car_class ? $available_vehicle->car_class->name : '--'}}</td>
                                            <td>{{$available_vehicle->manufacturing_year  ? $available_vehicle->manufacturing_year : '--'}}</td>
{{--                                            <td>{{$available_vehicle->main_vehicle  ? __('vehicle.' . $available_vehicle->main_vehicle->body_shape)  : '--'}}</td>--}}


                                            {{-- <td>
                                                <a href = "{{route('organization.available_vehicle.edit' , $available_vehicle->id)}}" type="button" class="btn btn-outline-info">{{__('words.show')}}</a>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"

                                                        onclick="delete_available_vehicle({{$available_vehicle->id}})">
                                                    {{__('words.delete')}}
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.available_vehicles.delete')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
   <script>
       function delete_available_vehicle(id)
        {
            var url = "{{route('organization.available_vehicle.destroy' , ':id')}}";
            url = url.replace(':id' , id);
            $('#ModalDelete form').attr('action' , url);
            $('#ModalDelete').modal('show');
        }

   </script>
@endsection

