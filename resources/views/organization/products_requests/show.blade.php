@extends('organization.layouts.app')
@section('title','Mawatery | products requests')
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
                        <li class="breadcrumb-item active">{{__('words.products_requests')}}</li>
                    </ol>
                </div>
                @include('organization.includes.alerts.success')
                @include('organization.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="welcome-text">
                                <h4>{{__('words.user_details')}}<span class="f-w-500">:</span></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="profile-personal-info">
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">

                                            <h5 class="f-w-500">{{__('words.name')}}<span class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$user->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">
                                            <h5 class="f-w-500">{{__('words.phone')}}<span class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$user->phone}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">
                                            <h5 class="f-w-500">{{__('words.email')}}<span
                                                    class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$user->email}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-header">
                            <div class="welcome-text">
                                <h4>{{__('words.request_details')}}<span class="f-w-500">:</span></h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="profile-personal-info">
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">

                                            <h5 class="f-w-500">{{__('words.car_model')}}<span
                                                    class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$product_request->car_model}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">
                                            <h5 class="f-w-500">{{__('words.manufacturing_year')}}<span
                                                    class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$product_request->manufacturing_year}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">
                                            <h5 class="f-w-500">{{__('words.brand')}}<span class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9">
                                                <span>{{\App\Models\Brand::find($product_request->brand_id)->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">
                                            <h5 class="f-w-500">{{__('words.category')}}<span
                                                    class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9">
                                                <span>{{\App\Models\Category::find($product_request->category_id)->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">

                                            <h5 class="f-w-500">{{__('words.type')}}<span class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$product_request->type}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">
                                            <h5 class="f-w-500">{{__('words.product_is_new')}}<span
                                                    class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$product_request->getIsNew()}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">

                                            <h5 class="f-w-500">{{__('words.status')}}<span class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$product_request->pivot->status}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    @if($product_request->pivot->status !='pending')
                                        <div class="modal-footer">
                                            <a
                                                href="{{route('organization.products_requests.reply',$product_request->id)}}"
                                                class="btn btn-outline-info">{{__('words.send_reply')}}</a>

                                        </div>
                                    @else
                                        <div class="modal-footer">
                                            <a disabled
                                               href="{{route('organization.products_requests.reply',$product_request->id)}}"
                                               class="btn btn-outline-info">{{__('words.send_reply')}}</a>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    @include('organization.reservations.change_status')--}}

@endsection

@section('scripts')
    <script type="text/javascript">

        {{--        @if(count($errors) > 0 && !$errors->has('update_modal'))--}}
        {{--        $('#storeProduct').modal('show');--}}

        {{--        @elseif($errors->has('update_modal'))--}}
        {{--        $('#editProduct').modal('show');--}}
        {{--        @foreach ($errors->get('update_modal') as $error)--}}
        {{--        --}}{{----}}{{--console.log({{ $error }});--}}
        {{--        get_product_data({{$error}});--}}

        {{--        @endforeach--}}
        {{--        @endif--}}

        {{--function get_product_data(id) {--}}
        {{--    var url = "{{route('organization.reservations.edit' , ':id')}}";--}}
        {{--    url = url.replace(':id', id);--}}
        {{--    $.ajax({--}}
        {{--        type: "Get",--}}
        {{--        url: url,--}}
        {{--        datatype: 'JSON',--}}
        {{--        success: function (data) {--}}
        {{--            // console.log(data);--}}
        {{--            if (data.status == true) {--}}
        {{--                // $('#name_en').val(data.data.show_product.name_en);--}}
        {{--                // $('#name_ar').val(data.data.show_product.name_ar);--}}
        {{--                //--}}
        {{--                // CKEDITOR.instances.description_ar.setData(data.data.show_product.description_ar);--}}
        {{--                // CKEDITOR.instances.description_en.setData(data.data.show_product.description_en);--}}
        {{--                // // $('#brand_id').val(data.data.show_agency.brand_id);--}}
        {{--                // $('#price').val(data.data.show_product.price);--}}
        {{--                // $('#warranty').val(data.data.show_product.warranty_value);--}}
        {{--                $('#status').val(data.data.reservation.status);--}}
        {{--                // $('#is_new').val(data.data.show_product.is_new);--}}

        {{--                // console.log $('#images').attr("src", data.data.show_product.one_image);--}}
        {{--                //--}}
        {{--                //  if (data.data.show_reservation.active == 1) {--}}
        {{--                //      $('#active').prop('checked', true);--}}
        {{--                //  } else {--}}
        {{--                //      $('#active').prop('checked', false);--}}
        {{--                //  }--}}


        {{--                console.log($('#reservation_id').val(data.data.reservation.id));--}}

        {{--                let update = "{{route('organization.reservations.edit' , ':id')}}";--}}
        {{--                // destroy = destroy.replace(':id', data.data.show_product.id);/--}}
        {{--                $('#update_form').attr('action', update);--}}
        {{--                $('#text_message').text(data.data.show_product.name);--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (reject) {--}}
        {{--            alert(reject);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

    </script>

@endsection
