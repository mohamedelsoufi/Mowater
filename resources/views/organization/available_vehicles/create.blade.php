@extends('organization.layouts.app')
@section('title','Mawatery | available_vehicles')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.create_available_vehicles')}}</h4>
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

                        </div>

                        <div class="card-body">
                          <form action="{{route('organization.available_vehicle.store')}}" method = "POST">
                              @csrf


                                {{-- vehicles --}}
                                <h3>{{__('words.available_vehicles')}}</h3>
                                <div class="table-responsive">
                                    <table class="table primary-table-bordered">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">{{__('words.image_s')}}</th>
                                                <th scope="col">{{__('words.car_model')}}</th>
                                                <th scope="col">{{__('words.car_class')}}</th>
                                                <th scope="col">{{__('vehicle.manufacturing_year')}}</th>
{{--                                                <th scope="col">{{__('vehicle.body_shape')}}</th>--}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($vehicles as $vehicle)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name = "vehicles[]" id = "vehicle_{{$vehicle->id}}" value = "{{$vehicle->id}}" {{in_array($vehicle->id , $available_vehicles) ? 'checked' : ''}}  >
                                                </td>
                                                <td>
                                                    @if(!$vehicle->one_image)
                                                        <a href="{{asset('uploads/default_image.png')}}" data-toggle="lightbox">
                                                            <img class="slider_image" src="{{asset('uploads/default_image.png')}}" alt="">
                                                        </a>
                                                    @else
                                                        <a href="{{$vehicle->one_image}}" data-toggle="lightbox">
                                                            <img class="slider_image" src="{{$vehicle->one_image}}" onerror="this.src='{{asset('uploads/default_image.png')}}'" alt="">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td><label for="vehicle_{{$vehicle->id}}">{{$vehicle->car_model ? $vehicle->car_model->name : '--'}}</label></td>
                                                <td><label for="vehicle_{{$vehicle->id}}">{{$vehicle->car_class ? $vehicle->car_class->name : '--'}}</label></td>
                                                <td><label for="vehicle_{{$vehicle->id}}">{{$vehicle->manufacturing_year  ? $vehicle->manufacturing_year : '--'}}</label></td>
{{--                                                <td><label for="vehicle_{{$vehicle->id}}">{{$vehicle->main_vehicle  ? __('vehicle.' . $vehicle->main_vehicle->body_shape)  : '--'}}</label></td>--}}
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>



                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary">{{__('words.edit')}}</button>
                                </div>

                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('styles')
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice
{
    background-color: #343957;
}
</style>
@endsection

@section('scripts')
  <script>
      $(".select2").select2();
  </script>
@endsection

