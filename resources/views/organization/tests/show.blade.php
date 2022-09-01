@extends('organization.layouts.app')
@section('title','Mawatery | Test Drive')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.tests')}}</h4>
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

                        </div>

                        <div class="card-body">
                            <form action="{{route('organization.test.update' , $test->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.created_at')}}</label>
                                        <input type="text" name="created_at" value="{{$test->created_at}}" disabled
                                               class="form-control @error('created_at') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.name')}}</label>
                                        <input type="text" name="name" value="{{$test->name}}" disabled
                                               class="form-control @error('name') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.phone')}}</label>
                                        <input type="text" name="phone" value="{{$test->phone}}" disabled
                                               class="form-control @error('phone') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.address')}}</label>
                                        <input type="text" name="address" value="{{$test->address}}" disabled
                                               class="form-control @error('address') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{__('words.files')}}</label>
                                        <br>
                                        @if(count($test->files) > 0)
                                            @foreach($test->files as $file)
                                                <a href="{{$file->path}}"
                                                   data-toggle="lightbox">
                                                    <img class="slider_image" style="width: 20%;"
                                                         src="{{$file->path}}"
                                                         onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                         alt="">
                                                </a>

                                            @endforeach
                                        @else
                                            <p>{{__('words.no_there')}}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.status')}}</label>
                                        <select name="status" id="status" class="form-control">
                                            @if($test->status == 'pending')
                                                <option value="approved">{{__('words.approve_reservation')}}</option>
                                                <option value="rejected">{{__('words.reject_reservation')}}</option>
                                            @else
                                                <option
                                                    value="">{{$test->status == 'approved' ?__('words.approve_reservation') : __('words.reject_reservation')}}</option>
                                            @endif
                                        </select>
                                    </div>


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

@section('scripts')
    <script>
        if("{{$test->status}}" == "pending"){
            $("#status").prop("disabled",false);
        }else{
            $("#status").prop("disabled",true);
        }
    </script>
@endsection

