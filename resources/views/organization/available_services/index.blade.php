@extends('organization.layouts.app')
@section('title','Mawatery | Available services')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.available_services')}}  <small class="text-secondary">({{ $available_services->count() }})</small></h4>
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
                            <!-- Button trigger modal -->
                            <a href = "{{route('organization.available_service.create')}}" class="btn btn-primary">{{__('words.create')}}</a>
                        
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.description')}}</th>
                                        <th>{{__('words.price')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($available_services as $available_service)
                                        <tr class="text-center">
                                            
                                            <td>{{$available_service->name}}</td>
                                            <td>{{Str::limit($available_service->description , 20)}}</td>
                                            <td>{{$available_service->price}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.available_services.delete')
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
       function delete_available_service(id)
        {
            var url = "{{route('organization.available_service.destroy' , ':id')}}";
            url = url.replace(':id' , id);
            $('#ModalDelete form').attr('action' , url);
            $('#ModalDelete').modal('show');
        }

   </script>
@endsection

