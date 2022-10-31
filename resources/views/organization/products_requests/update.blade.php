@extends('organization.layouts.app')
@section('title','Mawatery | requests')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.products_requests')}}</h4>
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
                                    <h4>{{__('words.show_request')}}</h4>
                                </div>
                            </div>
                        </div>
                        <form method="POST"
                              action="{{route('organization.products_requests.send_reply')}}"
                              id="update_form" autocomplete="off" enctype="multipart/form-data">
                            {{--                            @method('put')--}}
                            @csrf
                            <input type="hidden" name="id" value="{{$product_request->id}}">
                            <div class="modal-body">

                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                        <label>{{__('words.price')}}</label>
                                                        <input type="text" name="price"
                                                               class="form-control @error('price') is-invalid @enderror"
                                                               placeholder="{{__('words.price')}}">
                                                        @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                        @enderror

                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                                class="btn btn-outline-primary">{{__('words.update')}}</button>
                                                    </div></div>
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
