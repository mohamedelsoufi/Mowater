@extends('organization.layouts.app')
@section('title','Mawatery | services')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.services')}} <small class="text-secondary">({{ $services->count() }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.services')}}</li>
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
                            <a href="{{route('organization.services.create')}}"  class="btn btn-primary"> {{__('words.create')}}</a>
                        </div>

                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.images')}}</th>
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.price')}} ({{__('words.bhd')}})</th>
                                        <th>{{__('words.category')}}</th>
                                        <th>{{__('words.discount_availability')}}</th>
                                        <th>{{__('words.availability')}}</th>
                                        {{--                                        <th>{{__('words.location')}}</th>--}}
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($services as $service)
                                        <tr class="text-center">
                                            <td>
                                                <img class="slider_image"
                                                     src="{{$service->one_image}}"
                                                     onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                     alt="">
                                            </td>
                                            <td>{{$service->name_en}}</td>
                                            <td>{{$service->name_ar}}</td>
                                            <td>{{$service->price}}</td>
                                            <td>{{$service->category ? $service->category->name : '--'}}</td>
                                            <td>{{$service->discount_availability == 0 ?  __('words.not_available_prop') : __('words.available_prop')}}</td>
                                            <td>{{$service->getAvailability()}}</td>

                                            <td>
                                                <a href="{{route('organization.services.edit',$service->id)}}"   class="btn btn-outline-info"> {{__('words.show')}}</a>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_service_data({{$service->id}})">
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

    @include('organization.services.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeService').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editService').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_service_data({{$error}});

        @endforeach
        @endif

        function get_service_data(id) {
            var url = "{{route('organization.services.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {
                        let update = "{{route('organization.services.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_service.id);

                        let destroy = "{{route('organization.services.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_service.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_message').text(data.data.show_service.name);
                    }
                },
                error: function (reject) {alert(reject);
                    //
                }
            });
        }

    </script>


@endsection









