@extends('organization.layouts.app')
@section('title', __('words.edit_payment_method'))
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('words.dashboard') .' '. $record->name}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb {{app()->getLocale() == 'ar' ? 'float-sm-left' :  'float-sm-right'}}">
                            <li class="breadcrumb-item"><a
                                    href="{{route('organization.home')}}">{{__('words.home')}}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('organization.available-payment-methods.index')}}">{{__('words.show_available_payment_methods')}}</a>
                            </li>

                            <li class="breadcrumb-item active">{{__('words.edit_payment_method')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @include('organization.includes.alerts.success')
        @include('organization.includes.alerts.errors')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">{{__('words.edit_payment_method')}}</h3>
                            </div>
                            <form method="post" action="{{route('organization.available-payment-methods.update')}}"
                                  autocomplete="off"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="card-body">
                                    <div class="basic-form">
                                        <table id="example1" class="table table-bordered table-striped text-center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('words.availability')}}</th>
                                                <th>{{__('words.image_s')}}</th>
                                                <th>{{__('words.name')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($payment_methods as $key => $payment_method)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>
                                                            <input class="form-check-input" name="available_payment[]"
                                                                   value="{{$payment_method->id}}"
                                                                   {{in_array($payment_method->id, $available_payment_methods) ? "checked" : ""}} type="checkbox">
                                                        </td>
                                                        <td>
                                                            @if(!$payment_method->symbol)
                                                                <a href="{{asset('uploads/default_image.png')}}"
                                                                   data-toggle="lightbox"
                                                                   data-title="{{$payment_method->name}}"
                                                                   data-gallery="gallery">
                                                                    <img class="index_image"
                                                                         src="{{asset('uploads/default_image.png')}}"
                                                                         alt="logo">
                                                                </a>
                                                            @else
                                                                <a href="{{$payment_method->symbol}}"
                                                                   data-toggle="lightbox"
                                                                   data-title="{{$payment_method->name}}"
                                                                   data-gallery="gallery">
                                                                    <img class="index_image"
                                                                         src="{{$payment_method->symbol}}"
                                                                         onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                                         alt="logo">
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{$payment_method->name}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-block btn-outline-info">
                                                {{__('words.update')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>

    </div>

@endsection
