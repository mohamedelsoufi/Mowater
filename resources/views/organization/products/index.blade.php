@extends('organization.layouts.app')
@section('title','Mawatery | products')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.products')}} <small class="text-secondary">({{ $products->count() }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.products')}}</li>
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

                            <a href="{{route('organization.products.create')}}"  class="btn btn-primary"> {{__('words.create')}}</a>

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.images')}}</th>
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.price')}} ({{__('words.bhd')}})</th>
                                        @if($model_type != 'App\\Models\\Agency')
                                        <th>{{__('words.product_status')}}</th>
                                        @endif
                                        <th>{{__('words.availability')}}</th>
                                        @if($model_type != 'App\\Models\\Agency')
                                        <th>{{__('words.type')}}</th>
                                        @endif
                                        <th>{{__('words.product_warranty')}}</th>
                                        <th>{{__('words.product_is_new')}}</th>
                                        <th>{{__('words.discount_availability')}}</th>
                                        <th>{{__('words.actions')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($products as $product)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$product->files)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="">
                                                    </a>
                                                @else
                                                    <a href="{{$product->one_image}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$product->one_image}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$product->name_en}}</td>
                                            <td>{{$product->name_ar}}</td>
                                            <td>{{$product->price}}</td>
                                            @if($model_type != 'App\\Models\\Agency')
                                            <td>{{__('words.' . $product->status)}}</td>
                                            @endif
                                            <td>{{$product->getAvailability()}}</td>
                                            @if($model_type != 'App\\Models\\Agency')
                                            <td>{{__('words.' . $product->type)}}</td>
                                            @endif
                                            <td>@if($product->warranty){{$product->warranty}}
                                                @else {{__('words.product_no_warranty')}}
                                                @endif
                                            </td>
                                            <td>{{$product->getIsNew()}}</td>
                                            <td>{{$product->discount_availability == 0 ?  __('words.not_available_prop') : __('words.available_prop')}}</td>

                                            <td>
{{--                                                <button type="button" id="show_product"--}}
{{--                                                        class="btn btn-outline-info"--}}
{{--                                                        data-toggle="modal"--}}
{{--                                                        data-target="#editProduct"--}}
{{--                                                        onclick="{{route('organization.products.show',$product->id)}}">--}}
{{--                                                    {{__('words.show')}}--}}
{{--                                                </button>--}}
                                                <a href="{{route('organization.products.show',$product->id)}}"   class="btn btn-outline-info"> {{__('words.show')}}</a>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_product_data({{$product->id}})">
                                                    {{__('words.delete')}}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    @include('organization.products.update')--}}
    @include('organization.products.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeProduct').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editProduct').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_product_data({{$error}});

        @endforeach
        @endif

        function get_product_data(id) {
            var url = "{{route('organization.products.edit' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {
                        // $('#name_en').val(data.data.show_product.name_en);
                        // $('#name_ar').val(data.data.show_product.name_ar);
                        //
                        // CKEDITOR.instances.description_ar.setData(data.data.show_product.description_ar);
                        // CKEDITOR.instances.description_en.setData(data.data.show_product.description_en);
                        // // $('#brand_id').val(data.data.show_agency.brand_id);
                        // $('#price').val(data.data.show_product.price);
                        // $('#warranty').val(data.data.show_product.warranty_value);
                        // $('#type').val(data.data.show_product.type);
                        // $('#is_new').val(data.data.show_product.is_new);

                       // console.log $('#images').attr("src", data.data.show_product.one_image);
                       //
                       //  if (data.data.show_service.active == 1) {
                       //      $('#active').prop('checked', true);
                       //  } else {
                       //      $('#active').prop('checked', false);
                       //  }


                        // console.log($('#product_id').val(data.data.show_product.id));

                        let destroy = "{{route('organization.products.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_product.id);
                        // $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_message').text(data.data.show_product.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection

