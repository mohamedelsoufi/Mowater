@extends('organization.layouts.app')
@section('title','Mawatery | ads')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.ads')}} <small class="text-secondary">({{ $ads->count() }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.ads')}}</li>
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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#storeAd">
                                {{__('words.create')}}
                            </button>
                            @include('organization.ads.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.images')}}</th>
                                        <th>{{__('words.title')}}</th>
                                        <th>{{__('words.price')}} ({{__('words.bhd')}})</th>
                                        <th>{{__('words.negotiable')}}</th>
                                        <th>{{__('words.country')}}</th>
                                        <th>{{__('words.city')}}</th>
                                        <th>{{__('words.area')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($ads as $ad)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$ad->files)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="">
                                                    </a>
                                                @else
                                                    <a href="{{$ad->one_image}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$ad->one_image}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$ad->title}}</td>
                                            <td>{{$ad->price?$ad->price:"--"}}</td>
                                            <th>{{$ad->getNegotiable()}}</th>
                                            <td>{{\App\Models\Country::find($ad->country_id)->name}}</td>
                                            <td>{{\App\Models\City::find($ad->city_id)->name}}</td>
                                            <td>{{\App\Models\Area::find($ad->area_id)->name}}</td>
                                            <td>
                                                {{--                                                <button type="button" id="show_ad"--}}
                                                {{--                                                        class="btn btn-outline-info"--}}
                                                {{--                                                        data-toggle="modal"--}}
                                                {{--                                                        data-target="#editAd"--}}
                                                {{--                                                        onclick="get_ad_data({{$ad->id}})">--}}
                                                {{--                                                    {{__('words.show')}}--}}
                                                {{--                                                </button>--}}
                                                <a href="{{route('organization.ads.show',$ad->id)}}"
                                                   class="btn btn-outline-info"> {{__('words.show')}}</a>
                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_ad_data({{$ad->id}})">
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
    {{--    @include('organization.ads.update')--}}
    @include('organization.ads.delete')
@endsection

@section('scripts')
    @include('organization.includes.change_files')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeAd').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editAd').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_ad_data({{$error}});

        @endforeach
        @endif

        function get_ad_data(id) {
            var url = "{{route('organization.ads.edit' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    console.log(data);
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

                        let destroy = "{{route('organization.ads.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_ad.id);
                        // $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_message').text(data.data.show_ad.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }


    </script>

@endsection

