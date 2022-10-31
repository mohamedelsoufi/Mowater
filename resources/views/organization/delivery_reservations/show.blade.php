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
                                            <div class="col-9">
                                                <span>{{$user->name ? $user->name : $user->user_name}}</span>
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
                            <div class="form-row">
                                <div class="card-header col-md-6 mb-4">
                                    <div class="welcome-text">
                                        <h4>{{__('words.reservation_details')}} : </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-personal-info">
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">

                                            <h5 class="f-w-500">{{__('words.name')}}<span class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9"><span>{{$reservation->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    @if(isset($reservation->phone))--}}
                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">
                                            <h5 class="f-w-500">{{__('words.phone')}}<span class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9">
                                                <span>{{$reservation->phone_number}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    @endif--}}
                                </div>

                                <div class="form-row">
                                    @if(isset($reservation->address))

                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.address')}}<span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9"><span>{{$reservation->address}}</span>
                                                </div>
                                                =
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6 mb-4">
                                        <div class="form-row">
                                            <h5 class="f-w-500">{{__('words.date')}} <span class="f-w-500">:</span>
                                            </h5>
                                            <div class="col-9">
                                                <span>{{$reservation->date ?$reservation->date :$reservation->created_at->toDateString() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    @if(isset($reservation->delivery_day))
                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.delivery_day')}} <span
                                                        class="f-w-500">:</span></h5>
                                                <div class="col-9"><span>{{$reservation->delivery_day}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(isset($reservation->delivery_fees))
                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.delivery_fees')}}<span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9"><span>{{$reservation->delivery_fees}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                @if($reservation->category)
                                    <div class="form-row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">

                                                <h5 class="f-w-500">{{__('words.category')}}<span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9"><span>{{$reservation->category->name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($reservation->delivery_count))
                                    <div class="form-row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.delivery_count')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9"><span>{{$reservation->delivery_count}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{--                                <div class="form-row">--}}
                                {{--                                    @if(isset($reservation->brand_id))--}}
                                {{--                                        <div class="col-md-6 mb-4">--}}
                                {{--                                            <div class="form-row">--}}
                                {{--                                                <h5 class="f-w-500">{{__('words.brand')}}<span--}}
                                {{--                                                        class="f-w-500">:</span>--}}
                                {{--                                                </h5>--}}
                                {{--                                                <div class="col-9">--}}
                                {{--                                                    <span>{{\App\Models\Brand::find($reservation->brand_id)->name}}</span>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    @endif--}}

                                {{--                                    @if(isset($reservation->car_model_id))--}}
                                {{--                                        <div class="col-md-6 mb-4">--}}
                                {{--                                            <div class="form-row">--}}
                                {{--                                                <h5 class="f-w-500">{{__('words.car_model')}}<span--}}
                                {{--                                                        class="f-w-500">:</span>--}}
                                {{--                                                </h5>--}}
                                {{--                                                <div class="col-9"><span>{{$reservation->car_model}}</span>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    @endif--}}

                                {{--                                </div>--}}
                                {{--                                <div class="form-row">--}}
                                {{--                                    @if(isset($reservation->old_license))--}}

                                {{--                                        <div class="col-md-6 mb-4">--}}
                                {{--                                            <div class="form-row">--}}
                                {{--                                                <h5 class="f-w-500">{{__('words.old_license')}} <span--}}
                                {{--                                                        class="f-w-500">:</span>--}}
                                {{--                                                </h5>--}}
                                {{--                                                <div class="col-9">--}}
                                {{--                                                    <span>{{$reservation->old_license==1? __('words.exist'):__('words.doesnot_exist')}}</span>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    @endif--}}
                                {{--                                </div>--}}
                                <div class="form-row">
                                    {{--                                    @if(isset($reservation->deposit))--}}

                                    {{--                                        <div class="col-md-6 mb-4">--}}
                                    {{--                                            <div class="form-row">--}}
                                    {{--                                                <h5 class="f-w-500">{{__('words.deposit')}} <span--}}
                                    {{--                                                        class="f-w-500">:</span></h5>--}}
                                    {{--                                                <div class="col-9"><span>{{$reservation->deposit}}</span>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    @endif--}}
                                    @if(isset($reservation->price)&&$reservation->price!=0)

                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.price')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$reservation->price}}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-row">
                                    @if(isset($reservation->country_id))

                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.country')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9">
                                                    <span>{{\App\Models\Country::find($reservation->country_id)->name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(isset($reservation->city_id))

                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.city')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9">
                                                    <span>{{\App\Models\City::find($reservation->city_id)->name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($reservation->area_id))

                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.area')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9">
                                                    <span>{{\App\Models\Area::find($reservation->area_id)->name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-row">
                                    @if(isset($reservation->from))

                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.from')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9"><span>{{$reservation->from}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($reservation->to))
                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.to')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9"><span>{{$reservation->to}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{--                                    @if(isset($reservation->manufacturing_year))--}}

                                    {{--                                        <div class="col-md-6 mb-4">--}}
                                    {{--                                            <div class="form-row">--}}
                                    {{--                                                <h5 class="f-w-500">{{__('words.manufacturing_year')}} <span--}}
                                    {{--                                                        class="f-w-500">:</span>--}}
                                    {{--                                                </h5>--}}
                                    {{--                                                <div class="col-9"><span>{{$reservation->manufacturing_year}}</span>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    @endif--}}

                                    @if(isset($reservation->vehicle_type))
                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.vehicle_type')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9">
                                                    <span>{{__('words.'.$reservation->vehicle_type)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <div class="form-row">
                                    @if(isset($reservation->day_to_go))

                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.day_to_go')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9"><span>{{$reservation->day_to_go}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($reservation->day_to_return))
                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.day_to_return')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9"><span>{{$reservation->day_to_return}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-row">
                                    @if(isset($reservation->days))
                                        <div class="col-md-6 mb-4">
                                            <div class="form-row">
                                                <h5 class="f-w-500">{{__('words.days')}} <span
                                                        class="f-w-500">:</span>
                                                </h5>
                                                <div class="col-9">
                                                    @foreach(explode(',',$reservation->days ) as $day)
                                                        <span>{{__('words.'.$day).','}}</span>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-4">
                                        <h5 class="f-w-500">{{__('words.status')}} <span
                                                class="f-w-500">:</span>
                                        </h5>
                                        <div class="col-md-6">
                                            <span>{{__('words.'.$reservation->status)}}</span><a
                                                href="{{route('organization.delivery_reservations.edit',$reservation->id)}}"
                                                class="btn btn-outline-info">     {{__('words.change_status')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                            @if($reservation->reservation_sessions)--}}

                    {{--                                <div class="row">--}}
                    {{--                                    <div class="col-12">--}}
                    {{--                                        <div class="card">--}}
                    {{--                                            <div class="card-header">--}}
                    {{--                                                <div class="col-sm-6 p-md-0">--}}
                    {{--                                                    <div class="welcome-text">--}}
                    {{--                                                        <h4>{{__('words.sessions_details')}}</h4>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                            <div class="card-body">--}}
                    {{--                                                <div class="table-responsive">--}}
                    {{--                                                    <table class="table table-bordered"--}}
                    {{--                                                           style="min-width: 845px">--}}
                    {{--                                                        <thead>--}}
                    {{--                                                        <tr class="text-center">--}}
                    {{--                                                            <th>{{__('words.time')}}</th>--}}
                    {{--                                                            <th>{{__('words.date')}}</th>--}}
                    {{--                                                        </tr>--}}
                    {{--                                                        </thead>--}}
                    {{--                                                        @foreach($reservation->reservation_sessions as $session)--}}
                    {{--                                                            <tbody id="display_data">--}}
                    {{--                                                            <tr class="text-center">--}}
                    {{--                                                                <td>{{$session->time}}</td>--}}
                    {{--                                                                <td>{{$session->date}}</td>--}}
                    {{--                                                            </tr>--}}
                    {{--                                                            </tbody>--}}
                    {{--                                                        @endforeach--}}
                    {{--                                                    </table>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            @endif--}}
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

{{--        @if(count($errors) > 0 && !$errors->has('update_modal'))--}}
{{--        $('#storeProduct').modal('show');--}}

{{--        @elseif($errors->has('update_modal'))--}}
{{--        $('#editProduct').modal('show');--}}
{{--        @foreach ($errors->get('update_modal') as $error)--}}
{{--        --}}{{----}}{{--console.log({{ $error }});--}}
{{--        get_product_data({{$error}});--}}

{{--        @endforeach--}}
{{--        @endif--}}

{{--    function get_product_data(id) {--}}
{{--        var url = "{{route('organization.delivery_reservations.edit' , ':id')}}";--}}
{{--        url = url.replace(':id', id);--}}
{{--        $.ajax({--}}
{{--            type: "Get",--}}
{{--            url: url,--}}
{{--            datatype: 'JSON',--}}
{{--            success: function (data) {--}}
{{--                // console.log(data);--}}
{{--                if (data.status == true) {--}}
{{--                    // $('#name_en').val(data.data.show_product.name_en);--}}
{{--                    // $('#name_ar').val(data.data.show_product.name_ar);--}}
{{--                    //--}}
{{--                    // CKEDITOR.instances.description_ar.setData(data.data.show_product.description_ar);--}}
{{--                    // CKEDITOR.instances.description_en.setData(data.data.show_product.description_en);--}}
{{--                    // // $('#brand_id').val(data.data.show_agency.brand_id);--}}
{{--                    // $('#price').val(data.data.show_product.price);--}}
{{--                    // $('#warranty').val(data.data.show_product.warranty_value);--}}
{{--                    $('#status').val(data.data.reservation.status);--}}
{{--                    // $('#is_new').val(data.data.show_product.is_new);--}}

{{--                    // console.log $('#images').attr("src", data.data.show_product.one_image);--}}
{{--                    //--}}
{{--                    //  if (data.data.show_reservation.active == 1) {--}}
{{--                    //      $('#active').prop('checked', true);--}}
{{--                    //  } else {--}}
{{--                    //      $('#active').prop('checked', false);--}}
{{--                    //  }--}}


{{--                    console.log($('#reservation_id').val(data.data.reservation.id));--}}

{{--                    let update = "{{route('organization.delivery_reservations.edit' , ':id')}}";--}}
{{--                    // destroy = destroy.replace(':id', data.data.show_product.id);/--}}
{{--                    $('#update_form').attr('action', update);--}}
{{--                    // $('#text_message').text(data.data.show_product.name);--}}
{{--                }--}}
{{--            },--}}
{{--            error: function (reject) {--}}
{{--                alert(reject);--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--</script>--}}

{{--@endsection--}}
