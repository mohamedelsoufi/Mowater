@extends('organization.layouts.app')
@section('title','Mawatery | Coverage Types')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.coverage_types')}}  <small class="text-secondary">({{ $coverage_types->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.coverage_types')}}</li>
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
                            <a href = "{{route('organization.coverage_type.create')}}" class="btn btn-primary">{{__('words.create')}}</a>
                        
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($coverage_types as $coverage_type)
                                        <tr class="text-center">
                                            <td>{{$coverage_type->name}}</td>

                                            <td>
                                                <a href = "{{route('organization.coverage_type.edit' , $coverage_type->id)}}" type="button" class="btn btn-outline-info">{{__('words.show')}}</a>
                                           
                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        
                                                        onclick="delete_coverage_type({{$coverage_type->id}} , '{{$coverage_type->name}}')">
                                                    {{__('words.delete')}}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.coverage_types.delete')
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
       function delete_coverage_type(id , name)
        {
            $("#text_meesage").text(name);
            var url = "{{route('organization.coverage_type.destroy' , ':id')}}";
            url = url.replace(':id' , id);
            $('#ModalDelete form').attr('action' , url);
            $('#ModalDelete').modal('show');
        }

   </script>
@endsection

