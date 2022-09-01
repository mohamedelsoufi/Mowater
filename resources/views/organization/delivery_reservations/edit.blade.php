@extends('organization.layouts.app')
@section('title','Mawatery | reservations')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.reservations')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.reservations')}}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            <div class="col-sm-6 p-md-0">
                                <div class="welcome-text">
                                    <h4>{{__('words.show_reservation')}}</h4>
                                </div>
                            </div>
                        </div>
                        <form method="POST"
                              action="{{route('organization.delivery_reservations.update',$show_reservation->id)}}"
                              id="update_form" autocomplete="off" enctype="multipart/form-data">
                            {{--                            @method('put')--}}
                            @csrf
                            <input type="hidden" name="id" value="{{$show_reservation->id}}" id="reservation_id">
                            <div class="modal-body">

                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <div class="form-group col-md-6">
                                                        <label>{{__('words.status')}}</label>
                                                        <select name="status" class="form-control" id="status">
                                                            {{--                                            @if($reservation->status == 'pending')--}}
                                                            <option
                                                                @if($show_reservation->status=='rejected')
                                                                selected
                                                                @endif
                                                                value="rejected">{{__('words.reject_reservation')}}</option>
                                                            <option
                                                                @if($show_reservation->status=='approved')
                                                                selected
                                                                @endif
                                                                value="approved">{{__('words.approve_reservation')}}</option>
                                                            {{--                                            @endif--}}
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>{{__('words.price')}}</label>
                                                        <input type="text" name="price" id="price"
                                                               value="{{$show_reservation->price}}"
                                                               class="form-control @error('price') is-invalid @enderror"
                                                               placeholder="{{__('words.price')}}">
                                                        @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                                class="btn btn-outline-primary">{{__('words.update')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
