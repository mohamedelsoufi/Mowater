@extends('organization.layouts.app')
@section('title','Mawatery | Vehicles Reservations')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.reserve_vehicles')}}  <small class="text-secondary">({{ $reserve_vehicles->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.reserve_vehicles')}}</li>
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

                            @if(count($branches) > 0)
                            <form action="" method = "GET">
                                <select name="branch_id" class = "form-control select2" style = "background: #343957; color: white;padding: 0 10px;">
                                    <option value="">{{__('words.all_branches')}}</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}" {{$branch->id == request()->branch_id ? 'selected' : ''}} >{{$branch->name}}</option>
                                    @endforeach
                                </select>
                            </form>
                            @endif


                            <!-- Button trigger modal -->
                            {{-- <a href = "{{route('organization.reserve_vehicle.create')}}" class="btn btn-primary">{{__('words.create')}}</a> --}}

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.created_at')}}</th>
                                        <th>{{__('words.user_data')}}</th>
                                        <th>{{__('words.branch')}}</th>
                                        <th>{{__('words.vehicle')}}</th>
                                        <th>{{__('words.status')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($reserve_vehicles as $reserve_vehicle)
                                        <tr class="text-center">
                                            <td>{{ date('l d-m-Y', strtotime($reserve_vehicle->created_at)) }}<br>
                                                {{ date('h:i A', strtotime($reserve_vehicle->created_at)) }}</td>
                                            <td>
                                                {{$reserve_vehicle->name }} <br> {{$reserve_vehicle->phone }} <br> {{$reserve_vehicle->address }}
                                            </td>
                                            <td>{{$reserve_vehicle->branch ? $reserve_vehicle->branch->name : '--'  }}</td>
                                            <td><a href="{{route('organization.vehicles.edit' , $reserve_vehicle->id)}}">{{$reserve_vehicle->vehicle ? $reserve_vehicle->vehicle->name : '--'  }}</a></td>

                                            <td>{{__('words.' . $reserve_vehicle->status) }}</td>

                                            <td>
                                                <a href = "{{route('organization.reserve_vehicle.show' , $reserve_vehicle->id)}}" type="button" class="btn btn-outline-info">{{__('words.show')}}</a>

                                                {{-- <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"

                                                        onclick="delete_reserve_vehicle({{$reserve_vehicle->id}})">
                                                    {{__('words.delete')}}
                                                </button> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{-- @include('organization.reserve_vehicles.delete') --}}
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
       function delete_reserve_vehicle(id)
        {
            var url = "{{route('organization.reserve_vehicle.destroy' , ':id')}}";
            url = url.replace(':id' , id);
            $('#ModalDelete form').attr('action' , url);
            $('#ModalDelete').modal('show');
        }

        //submit the form when change branch
        $("select[name='branch_id']").change(function(){
            $(this).parent().submit();
        });


   </script>
@endsection

