@extends('organization.layouts.app')
@section('title','Mawatery | Reservation')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.rental_reservations')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.rental_reservations')}}</li>
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
                            <form action="{{route('organization.rental_reservation.update' , $rental_reservation->id)}}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.created_at')}}</label>
                                        <input type="text" name="created_at" value="{{$rental_reservation->created_at}}"
                                               disabled class="form-control @error('created_at') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.name')}}</label>
                                        <input type="text" name="name" value="{{$rental_reservation->name}}" disabled
                                               class="form-control @error('name') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.phone')}}</label>
                                        <input type="text" name="phone" value="{{$rental_reservation->phone}}" disabled
                                               class="form-control @error('phone') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.address')}}</label>
                                        <input type="text" name="address" value="{{$rental_reservation->address}}"
                                               disabled class="form-control @error('address') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.rental_car')}}</label>
                                        <input type="text" name="vehicle" value="{{$rental_reservation->car_name}}"
                                               disabled class="form-control @error('address') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.rental_type')}}</label>
                                        <input type="text" name="vehicle"
                                               value="{{__('words.' . $rental_reservation->rental_type)}}" disabled
                                               class="form-control @error('address') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.start_date')}}</label>
                                        <input type="text" name="vehicle" value="{{$rental_reservation->start_date}}"
                                               disabled class="form-control @error('address') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.payment_method')}}</label>
                                        <input type="text" name="payment_method"
                                               value="{{$rental_reservation->payment_method ? $rental_reservation->payment_method->name : '--' }}"
                                               disabled class="form-control @error('address') is-invalid @enderror">
                                    </div>

                                    {{-- <div class="form-group col-md-12">
                                        <label>{{__('words.files')}}</label>
                                        <br>
                                        @if(count($rental_reservation->files) > 0)
                                            @foreach($rental_reservation->files as $file)
                                            <a href="{{$file->path}}"
                                                data-toggle="lightbox">
                                                 <img class="slider_image"  style = "width: 20%;"
                                                      src="{{$file->path}}"
                                                      onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                      alt="">
                                             </a>

                                            @endforeach
                                        @else
                                            <p>{{__('words.no_there')}}</p>
                                        @endif
                                    </div> --}}

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.nationality')}}</label>
                                        <input type="text" name="nationality"
                                               value="{{ $rental_reservation->nationality ==1 ? __('words.bahraini') : __('words.foreign')}}"
                                               disabled class="form-control @error('nationality') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        @foreach($rental_reservation->files as $file)
                                            @if(!$file)
                                                <a href="{{asset('uploads/default_image.png')}}"
                                                   data-toggle="lightbox">
                                                    <img class="slider_image"
                                                         src="{{asset('uploads/default_image.png')}}" alt="logo">
                                                </a>
                                            @else
                                                <a href="{{$file->path}}"
                                                   data-toggle="lightbox">
                                                    <img class="slider_image"
                                                         src="{{$file->path}}"
                                                         onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                         alt="logo">
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.status')}}</label>
                                    @if($rental_reservation->status == 'pending')
                                        <select name="status" class="form-control">
                                            <option value="approved">{{__('words.approve_reservation')}}</option>
                                            <option value="rejected">{{__('words.reject_reservation')}}</option>
                                        </select>
                                        @else
                                        <input type="text"
                                               value="{{ $rental_reservation->status == 'approved' ? __('words.approve_reservation') : __('words.reject_reservation')}}"
                                               disabled class="form-control">
                                    @endif
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

