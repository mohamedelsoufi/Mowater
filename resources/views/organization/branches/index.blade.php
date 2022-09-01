@extends('organization.layouts.app')
@section('title','Mawatery | Branches')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.branches')}}  <small class="text-secondary">({{ $branches->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.branches')}}</li>
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
                            <a href = "{{route('organization.branch.create')}}" class="btn btn-primary">{{__('words.create')}}</a>
                        
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.category')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($branches as $branch)
                                        <tr class="text-center">
                                            <td>{{$branch->name}}</td>
                                            <td>{{$branch->category ? $branch->category->name : '--'}}</td>

                                            <td>
                                                <a href = "{{route('organization.branch.edit' , $branch->id)}}" type="button" class="btn btn-outline-info">{{__('words.show')}}</a>
                                           
                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        
                                                        onclick="delete_branch({{$branch->id}})">
                                                    {{__('words.delete')}}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.branches.delete')
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
       function delete_branch(id)
        {
            var url = "{{route('organization.branch.destroy' , ':id')}}";
            url = url.replace(':id' , id);
            $('#ModalDelete form').attr('action' , url);
            $('#ModalDelete').modal('show');
        }

   </script>
@endsection

