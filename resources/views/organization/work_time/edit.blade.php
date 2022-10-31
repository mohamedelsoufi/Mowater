@extends('organization.layouts.app')
@section('title','Mawatery | Work Time')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.work_time')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.work_time')}}</li>
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
                            <form action="{{route('organization.work_time.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.time_from')}}</label>
                                        <input type="time" name="from" value="{{$work_time ? $work_time->from : ''}}"
                                               class="form-control @error('from') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.time_to')}}</label>
                                        <input type="time" name="to" value="{{$work_time ? $work_time->to : ''}}"
                                               class="form-control @error('to') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.duration')}}</label>
                                        <input type="number" name="duration"
                                               @if( get_class($organization)=='App\Models\DrivingTrainer')disabled
                                               value="120" @endif value="{{$work_time ? $work_time->duration : ''}}"
                                               class="form-control @error('duration') is-invalid @enderror">
                                        @if(get_class($organization)=='App\Models\DrivingTrainer')
                                            <input type="hidden" name = "duration" value = "120">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{__('words.work_days')}}</label>
                                        <br>
                                        {{--  'days' => 'Sat,Sun,Mon,Tue,Wed,Thu,Fri', --}}

                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="Sat">{{__('words.Sat')}}</label>
                                                <input type="checkbox" name="work_days[]" value="Sat"
                                                       id="Sat" {{ $work_time && in_array('Sat' , $work_time->days) ? 'checked' : ''   }} >
                                            </div>

                                            <div class="col-md-2">
                                                <label for="Sun">{{__('words.Sun')}}</label>
                                                <input type="checkbox" name="work_days[]" value="Sun"
                                                       id="Sun" {{ $work_time && in_array('Sun' , $work_time->days) ? 'checked' : ''   }} >
                                            </div>

                                            <div class="col-md-2">
                                                <label for="Mon">{{__('words.Mon')}}</label>
                                                <input type="checkbox" name="work_days[]" value="Mon"
                                                       id="Mon" {{ $work_time && in_array('Mon' , $work_time->days) ? 'checked' : ''   }} >
                                            </div>

                                            <div class="col-md-2">
                                                <label for="Tue">{{__('words.Tue')}}</label>
                                                <input type="checkbox" name="work_days[]" value="Tue"
                                                       id="Tue" {{ $work_time && in_array('Tue' , $work_time->days) ? 'checked' : ''   }} >
                                            </div>

                                            <div class="col-md-2">
                                                <label for="Wed">{{__('words.Wed')}}</label>
                                                <input type="checkbox" name="work_days[]" value="Wed"
                                                       id="Wed" {{ $work_time && in_array('Wed' , $work_time->days) ? 'checked' : ''   }} >
                                            </div>

                                            <div class="col-md-2">
                                                <label for="Thu">{{__('words.Thur')}}</label>
                                                <input type="checkbox" name="work_days[]" value="Thu"
                                                       id="Thu" {{ $work_time && in_array('Thu' , $work_time->days) ? 'checked' : ''   }} >
                                            </div>

                                            <div class="col-md-2">
                                                <label for="Fri">{{__('words.Fri')}}</label>
                                                <input type="checkbox" name="work_days[]" value="Fri"
                                                       id="Fri" {{ $work_time && in_array('Fri' , $work_time->days) ? 'checked' : ''   }} >
                                            </div>
                                        </div>


                                        <div class="modal-footer">

                                            <button type="submit"
                                                    class="btn btn-outline-primary">{{__('words.edit')}}</button>
                                        </div>


                                    </div>

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

