@extends('organization.layouts.app')
@section('title','Mawatery | available_services')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.create_available_services')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.available_services')}}</li>
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
                          <form action="{{route('organization.available_service.store')}}" method = "POST">
                              @csrf

                            
                                {{-- services --}}
                                <h3>{{__('words.available_services')}}</h3>
                                <div class="table-responsive">
                                    <table class="table primary-table-bordered">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">{{__('words.name')}}</th>
                                                <th scope="col">{{__('words.description')}}</th>
                                                <th scope="col">{{__('words.price')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($services as $service)
                                            <tr>
                                                <td> 
                                                    <input type="checkbox" name = "services[]" id = "service_{{$service->id}}" value = "{{$service->id}}" {{in_array($service->id , $available_services) ? 'checked' : ''}}  >
                                                </td>
                                                <td><label for="service_{{$service->id}}">{{$service->name}}</label></td>
                                                <td><label for="service_{{$service->id}}">{{Str::limit($service->description , 20)}}</label></td>
                                                <td><label for="service_{{$service->id}}">{{$service->price}}</label></td>
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

