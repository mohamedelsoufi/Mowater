@extends('organization.layouts.app')
@section('title','Mawatery | reservations')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.reservations')}} <small
                                class="text-secondary">({{$reservations ?  $reservations->count() : 0 }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.reservations')}}</li>
                    </ol>
                </div>
                @include('organization.includes.alerts.success')
                @include('organization.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        {{--                        <div class="card-header">--}}

                        {{--                            <a href="{{route('organization.products.create')}}"  class="btn btn-primary"> {{__('words.create')}}</a>--}}

                        {{--                        </div>--}}
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.date')}}</th>
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.phone')}}</th>
                                        <th>{{__('words.price')}} ({{__('words.bhd')}})</th>
                                        {{--                                        <th>{{__('words.time')}}</th>--}}
                                        <th>{{__('words.status')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($reservations as $reservation)
                                        <tr class="text-center">
                                            <td>{{$reservation->date ?$reservation->date :$reservation->created_at->toDateString() }}</td>
                                            <td>{{$reservation->name}}</td>
                                            @if($reservation->phone)
                                                <td>{{$reservation->phone}}</td>
                                            @elseif($reservation->phone_number)
                                                <td>{{$reservation->phone_number}}</td>
                                            @else
                                                <td>--</td>
                                            @endif
                                            <td>{{$reservation->price ?$reservation->price :"--"}}</td>
                                            <td>{{__('words.'.$reservation->status)}}</td>
                                            <td>
                                                <a href="{{route('organization.trainer_reservations.edit',$reservation->id)}}"
                                                   class="btn btn-outline-info">     {{__('words.change_status')}}</a>
                                                <a href="{{route('organization.trainer_reservations.show',$reservation->id)}}"
                                                   class="btn btn-outline-info"> {{__('words.show')}}</a>

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
    {{--    @include('organization.reservations.change_status')--}}
@endsection

{{--@section('scripts')--}}
{{--    <script type="text/javascript">--}}

{{--        --}}{{--        @if(count($errors) > 0 && !$errors->has('update_modal'))--}}
{{--        --}}{{--        $('#storeProduct').modal('show');--}}

{{--        --}}{{--        @elseif($errors->has('update_modal'))--}}
{{--        --}}{{--        $('#editProduct').modal('show');--}}
{{--        --}}{{--        @foreach ($errors->get('update_modal') as $error)--}}
{{--        --}}{{--        --}}{{----}}{{----}}{{----}}{{--console.log({{ $error }});--}}
{{--        --}}{{--        get_product_data({{$error}});--}}

{{--        --}}{{--        @endforeach--}}
{{--        --}}{{--        @endif--}}

{{--        function get_product_data(id) {--}}
{{--            var url = "{{route('organization.reservations.edit' , ':id')}}";--}}
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
{{--                        $('#status').val(data.data.reservation.status);--}}
{{--                        // $('#is_new').val(data.data.show_product.is_new);--}}

{{--                        // console.log $('#images').attr("src", data.data.show_product.one_image);--}}
{{--                        //--}}
{{--                        //  if (data.data.show_reservation.active == 1) {--}}
{{--                        //      $('#active').prop('checked', true);--}}
{{--                        //  } else {--}}
{{--                        //      $('#active').prop('checked', false);--}}
{{--                        //  }--}}


{{--                       $('#reservation_id').val(data.data.reservation.id);--}}

{{--                        let update = "{{route('organization.reservations.edit' , ':id')}}";--}}
{{--                        // destroy = destroy.replace(':id', data.data.show_product.id);/--}}
{{--                        $('#update_form').attr('action', update);--}}
{{--                        $('#text_message').text(data.data.show_product.name);--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function (reject) {--}}
{{--                    alert(reject);--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--    </script>--}}

{{--@endsection--}}

