@extends('organization.layouts.app')
@section('title','Mawatery | products_requests')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.products_requests')}} <small
                                class="text-secondary">({{$products_requests ?  $products_requests->count() : 0 }}
                                )</small></h4>
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
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.images')}}</th>
                                        <th>{{__('words.car_model')}}</th>
                                        <th>{{__('words.manufacturing_year')}}</th>
                                        <th>{{__('words.brand')}}</th>
                                        <th>{{__('words.category')}}</th>
                                        <th>{{__('words.product_status')}}</th>
                                        <th>{{__('words.type')}}</th>
                                        <th>{{__('words.product_is_new')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    @if($products_requests !=null)
                                        <tbody id="display_data">
                                        @foreach($products_requests as $product)
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
                                                <td>{{$product->car_model}}</td>
                                                <td>{{$product->manufacturing_year}}</td>
                                                <td>{{\App\Models\Brand::find($product->brand_id)->name}}</td>
                                                <td>{{\App\Models\Category::find($product->category_id)->name}}</td>
                                                <td>{{$product->getStatus()}}</td>
                                                <td>{{__('words.' . $product->type)}}</td>
                                                <td>{{$product->getIsNew()}}</td>
                                                <td>
                                                    <a href="{{route('organization.products_requests.show',$product->id)}}"
                                                       class="btn btn-outline-info"> {{__('words.show')}}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    @include('organization.products.update')--}}
    {{--    @include('organization.products.delete')--}}
@endsection

@section('scripts')
    {{--    <script type="text/javascript">--}}

    {{--        @if(count($errors) > 0 && !$errors->has('update_modal'))--}}
    {{--        $('#storeProduct').modal('show');--}}

    {{--        @elseif($errors->has('update_modal'))--}}
    {{--        $('#editProduct').modal('show');--}}
    {{--        @foreach ($errors->get('update_modal') as $error)--}}
    {{--        --}}{{--console.log({{ $error }});--}}
    {{--        get_product_data({{$error}});--}}

    {{--        @endforeach--}}
    {{--        @endif--}}

    {{--        function get_product_data(id) {--}}
    {{--            var url = "{{route('organization.products.edit' , ':id')}}";--}}
    {{--            url = url.replace(':id', id);--}}
    {{--            $.ajax({--}}
    {{--                type: "Get",--}}
    {{--                url: url,--}}
    {{--                datatype: 'JSON',--}}
    {{--                success: function (data) {--}}
    {{--                    // console.log(data);--}}
    {{--                    if (data.status == true) {--}}
    {{--                        // $('#name_en').val(data.data.show_product.name_en);--}}
    {{--                        // $('#name_ar').val(data.data.show_product.name_ar);--}}
    {{--                        //--}}
    {{--                        // CKEDITOR.instances.description_ar.setData(data.data.show_product.description_ar);--}}
    {{--                        // CKEDITOR.instances.description_en.setData(data.data.show_product.description_en);--}}
    {{--                        // // $('#brand_id').val(data.data.show_agency.brand_id);--}}
    {{--                        // $('#price').val(data.data.show_product.price);--}}
    {{--                        // $('#warranty').val(data.data.show_product.warranty_value);--}}
    {{--                        // $('#type').val(data.data.show_product.type);--}}
    {{--                        // $('#is_new').val(data.data.show_product.is_new);--}}

    {{--                        // console.log $('#images').attr("src", data.data.show_product.one_image);--}}
    {{--                        //--}}
    {{--                        //  if (data.data.show_service.active == 1) {--}}
    {{--                        //      $('#active').prop('checked', true);--}}
    {{--                        //  } else {--}}
    {{--                        //      $('#active').prop('checked', false);--}}
    {{--                        //  }--}}


    {{--                        // console.log($('#product_id').val(data.data.show_product.id));--}}

    {{--                        let destroy = "{{route('organization.products.destroy' , ':id')}}";--}}
    {{--                        destroy = destroy.replace(':id', data.data.show_product.id);--}}
    {{--                        // $('#update_form').attr('action', update);--}}
    {{--                        $('#delete_form').attr('action', destroy);--}}

    {{--                        $('#text_message').text(data.data.show_product.name);--}}
    {{--                    }--}}
    {{--                },--}}
    {{--                error: function (reject) {--}}
    {{--                    alert(reject);--}}
    {{--                }--}}
    {{--            });--}}
    {{--        }--}}

    {{--    </script>--}}

@endsection

