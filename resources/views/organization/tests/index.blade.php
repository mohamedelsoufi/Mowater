@extends('organization.layouts.app')
@section('title','Mawatery | Test Drive')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.tests')}}  <small class="text-secondary">({{ $tests->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.tests')}}</li>
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
                            {{-- <a href = "{{route('organization.test.create')}}" class="btn btn-primary">{{__('words.create')}}</a> --}}

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
                                    @foreach($tests as $test)
                                        <tr class="text-center">
                                            <td>{{ date('l d-m-Y', strtotime($test->created_at)) }}<br>
                                                {{ date('h:i A', strtotime($test->created_at)) }}</td>
                                            <td>
                                                {{$test->name }} <br> {{$test->phone }} <br> {{$test->address }}
                                            </td>
                                            <td>{{$test->branch ? $test->branch->name : '--'  }}</td>
                                            <td><a href="{{route('organization.vehicles.edit' , $test->id)}}">{{$test->vehicle ? $test->vehicle->name : '--'  }}</a></td>
                                            <td>{{__('words.' . $test->status) }}</td>

                                            <td>
                                                <a href = "{{route('organization.test.show' , $test->id)}}" type="button" class="btn btn-outline-info">{{__('words.show')}}</a>

                                                {{-- <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"

                                                        onclick="delete_test({{$test->id}})">
                                                    {{__('words.delete')}}
                                                </button> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{-- @include('organization.tests.delete') --}}
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
       function delete_test(id)
        {
            var url = "{{route('organization.test.destroy' , ':id')}}";
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

