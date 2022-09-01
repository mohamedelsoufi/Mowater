@extends('organization.layouts.app')
@section('title','Mawatery | Insurance requests')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.insurance_requests')}} <small
                                class="text-secondary">({{$insurance_requests ?  $insurance_requests->count() : 0 }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.insurance_requests')}}</li>
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
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    @if($insurance_requests !=null)
                                        <tbody id="display_data">
                                        @foreach($insurance_requests as $insurance)
                                            <tr class="text-center">
                                                <td>
                                                    @if(!$insurance->files)
                                                        <a href="{{asset('uploads/default_image.png')}}"
                                                           data-toggle="lightbox">
                                                            <img class="slider_image"
                                                                 src="{{asset('uploads/default_image.png')}}" alt="">
                                                        </a>
                                                    @else
                                                        <a href="{{$insurance->one_image}}"
                                                           data-toggle="lightbox">
                                                            <img class="slider_image"
                                                                 src="{{$insurance->one_image}}"
                                                                 onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                                 alt="">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{{$insurance->car_model}}</td>
                                                <td>{{$insurance->manufacturing_year}}</td>
                                                <td>{{\App\Models\Brand::find($insurance->brand_id)->name}}</td>
                                                <td>
                                                    <a href="{{route('organization.insurance_requests.show',$insurance->id)}}"
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

