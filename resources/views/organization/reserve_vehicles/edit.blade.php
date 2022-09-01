@extends('organization.layouts.app')
@section('title','Mawatery | Contact')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.contact')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.day_offs')}}</li>
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
                          <form action="{{route('organization.day_off.update' , $day_off->id)}}" method = "POST">
                              @csrf
                                @method('PUT')
                              <div class="row">

                                <div class="form-group col-md-6">
                                    <label>{{__('words.day')}}</label>
                                    <input type="date" name = "date" value = "{{$day_off->date}}" class="form-control @error('date') is-invalid @enderror">
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
  
@endsection

