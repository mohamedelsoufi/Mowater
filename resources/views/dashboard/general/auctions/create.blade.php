@extends('dashboard.layouts.standard')
@section('title','Mawatery | auctions')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.auctions')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.auctions')}}</li>
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
                                    <h4>{{__('words.new_auction')}}</h4>
                                </div>
                            </div>
                        </div>
                        @if(session()->has('error'))
                            <div class="alert alert-danger col-md-6">
                                <div>{{ session()->get('error') }}</div>
                            </div>
                        @endif
                        <form method="POST" action="{{route('auctions.store')}}" id="store_form"
                              autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.title_ar')}}</label>
                                                <input type="text" name="title_ar"
                                                       class="form-control @error('title_ar') is-invalid @enderror"
                                                       value="{{ old('title_ar') }}"
                                                       placeholder="{{__('words.title_ar')}}">
                                                @error('title_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>{{__('words.title_en')}}</label>
                                                <input type="text" name="title_en"
                                                       class="form-control @error('title_en') is-invalid @enderror"
                                                       value="{{ old('title_en') }}"
                                                       placeholder="{{__('words.title_en')}}">

                                                @error('title_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.start_price')}} {{__('words.bhd')}}</label>
                                                <input type="text" name="price" id="price"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       value="{{ old('price') }}"
                                                       placeholder="{{__('words.start_price')}}">

                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.insurance_amount')}}</label>
                                                <input type="text" name="insurance_amount" id="insurance_amount"
                                                       class="form-control @error('insurance_amount') is-invalid @enderror"
                                                       value="{{ old('insurance_amount') }}"
                                                       placeholder="{{__('words.insurance_amount')}}">
                                                @error('insurance_amount')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 ">
                                                <label>{{__('words.start_date_time')}}</label>
                                                <input class="form-control  @error('start_date') is-invalid @enderror"
                                                       type="datetime-local" id="start_date"
                                                       name="start_date">
                                                @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label>{{__('words.end_date_time')}}</label>
                                                <input class="form-control @error('end_date') is-invalid @enderror"
                                                       type="datetime-local" id="end_date"
                                                       name="end_date">
                                                @error('end_date')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="active"
                                                       type="checkbox">
                                                <label class="form-check-label">
                                                    {{__('words.activity')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label>{{__('words.type')}}</label>
                                            <select name="type"
                                                    class="form-control type @error('type') is-invalid @enderror">
                                                <option value="" selected>{{__('words.choose')}}</option>
                                                <option value="Product">{{__('words.Product')}}</option>
                                                <option
                                                    value="SpecialNumber">{{__('words.special_number')}}</option>
                                                <option
                                                    value="Vehicle">{{__('words.vehicle')}}</option>
                                            </select>

                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 d-none special_number">
                                            <div class="table-responsive" style="max-height: 400px;">
                                                <table
                                                    class="table header-border table-hover verticle-middle">
                                                    <thead class="text-dark">
                                                    <tr class="text-center">
                                                        <th>
                                                            <i class="fas fa-check-circle"></i> {{__('words.select')}}
                                                        </th>
                                                        <th>{{__('words.number')}}</th>
                                                        <th>{{__('words.price')}}</th>
                                                    </tr>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="display_data">
                                                    @for($i = 0 ; $i < count($specialnumbers); $i++)
                                                        <tr class="text-center">
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input"
                                                                           class="special_number_id"
                                                                           name="special_number_id"
                                                                           value="{{$specialnumbers[$i]->id}}"
                                                                           type="radio">
                                                                </div>
                                                            </td>
                                                            <td>{{$specialnumbers[$i]->number}}</td>
                                                            <td>{{$specialnumbers[$i]->price ? $specialnumbers[$i]->price : '--'}}</td>
                                                        </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row d-none vehicle">

                                        <div class="col-md-6 ">
                                            <label>{{__('words.organizations')}}</label>

                                            <select class="form-control vehicles_org" name="vehicles_org">
                                                <option value="" selected>{{__('words.choose')}}</option>

                                                @for($i=0;$i<count($vehicles_organizations);$i++)
                                                    <option
                                                        value="{{$vehicles_organizations[$i]['object']['id'].",".$vehicles_organizations[$i]['type']}}">{{$vehicles_organizations[$i]['object']->name}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-12 d-none v-table">
                                            <div class="table-responsive " style="max-height: 400px;">
                                                <table id="vehicledata"
                                                       class="table header-border table-hover verticle-middle">
                                                    <thead class="text-dark">
                                                    <tr class="text-center">
                                                        <th>
                                                            <i class="fas fa-check-circle"></i> {{__('words.select')}}
                                                        </th>
                                                        <th>{{__('words.brand')}}</th>
                                                        <th>{{__('words.car_model')}}</th>
                                                        <th>{{__('words.car_class')}}</th>
                                                        <th>{{__('words.price')}}</th>
                                                    </tr>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="vehicle_display_data">
                                                    {{--                                                    @for($i = 0 ; $i < count($vehicles); $i++)--}}
                                                    {{--                                                        <tr class="text-center">--}}
                                                    {{--                                                            <td>--}}
                                                    {{--                                                                <div class="form-check">--}}
                                                    {{--                                                                    <input--}}
                                                    {{--                                                                        class="form-check-input vehicle_id"--}}
                                                    {{--                                                                        name="vehicle_id"--}}

                                                    {{--                                                                        type="radio"--}}
                                                    {{--                                                                        value="{{$vehicles[$i]->id}}">--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </td>--}}
                                                    {{--                                                            <td>{{$vehicles[$i]->brand->name}}</td>--}}
                                                    {{--                                                            <td>{{$vehicles[$i]->car_model->name}}</td>--}}
                                                    {{--                                                            <td>{{$vehicles[$i]->car_class->name}}</td>--}}
                                                    {{--                                                            <td>{{$vehicles[$i]->manufacturing_year}}</td>--}}
                                                    {{--                                                            <td>{{$vehicles[$i]->price ? $vehicles[$i]->price : '--'}}</td>--}}
                                                    {{--                                                        </tr>--}}

                                                    {{--                                                    @endfor--}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 d-none product">
                                            <label>{{__('words.organizations')}}</label>
                                            <select class="form-control products_org" name="products_org">
                                                <option value="" selected>{{__('words.choose')}}</option>
                                                @for($i=0;$i<count($products_organizations);$i++)
                                                    <option
                                                        value="{{$products_organizations[$i]['object']['id'].",".$products_organizations[$i]['type']}}">{{$products_organizations[$i]['object']->name}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-12 p-table d-none">
                                            <div class="table-responsive" style="max-height: 400px;">

                                                <table id="tbdata"
                                                       class="table header-border table-hover verticle-middle">
                                                    <thead class="text-dark">
                                                    <tr class="text-center">
                                                        <th>
                                                            <i class="fas fa-check-circle"></i> {{__('words.select')}}
                                                        </th>
                                                        <th>{{__('words.image')}}</th>
                                                        <th>{{__('words.name')}}</th>
                                                        <th>{{__('words.price')}}</th>
                                                    </tr>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="product_display_data">

                                                    {{--                                                                </div>
                                                    {{--                                                    @for($c = 0 ; $c< count($products); $c++)--}}
                                                    {{--                                                                                                            <tr class="text-center">--}}
                                                    {{--                                                            <td>--}}
                                                    {{--                                                                <div class="form-check">--}}
                                                    {{--                                                                    <input class="form-check-input"--}}
                                                    {{--                                                                           class="product_id"--}}
                                                    {{--                                                                           name="product_id"--}}
                                                    {{--                                                                           value="{{$products[$c]->id}}"--}}
                                                    {{--                                                                           type="radio">--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </td>--}}

                                                    {{--                                                            <td>--}}
                                                    {{--                                                                <a href="{{$products[$c]->one_image}}"--}}
                                                    {{--                                                                   data-toggle="lightbox">--}}
                                                    {{--                                                                    <img class="slider_image"--}}
                                                    {{--                                                                         src="{{$products[$c]->one_image}}"--}}
                                                    {{--                                                                         onerror="this.src='{{asset('uploads/default_image.png')}}'"--}}
                                                    {{--                                                                         alt="logo">--}}
                                                    {{--                                                                </a>--}}
                                                    {{--                                                            </td>--}}

                                                    {{--                                                            <td>{{$products[$c]->name}}</td>--}}
                                                    {{--                                                            <td>{{$products[$c]->price ? $products[$c]->price : '--'}}</td>--}}

                                                    {{--                                                    @endfor--}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('auctions.index')}}"
                                           class="btn btn-outline-danger">{{__('words.back')}}</a>
                                        <button type="submit"
                                                class="btn btn-outline-primary">{{__('words.create')}}</button>
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

@section('scripts')
    <script>
        $(document).ready(function () {
            $(".type").change(function () {
                var selectedSubject = $(".type option:selected").val();
                if (selectedSubject == "Product") {
                    $('.product').removeClass('d-none');
                    $('.special_number').addClass('d-none');
                    $('.vehicle').addClass('d-none');
                    $('.v-table').addClass('d-none');
                    $(".products_org").change(function () {
                        var object = $(".products_org option:selected").val();
                        // console.log(object);
                        var url = "{{route('auctions.org_products' , ':object')}}";
                        url = url.replace(':object', object);
                        // console.log(url);
                        $.ajax({
                            type: "Get",
                            url: url,
                            // data: object,
                            datatype: 'JSON',
                            success: function (data) {
                                // console.log(data.data);
                                if (data.status == true) {
                                    console.log(data.data);
                                    $('.p-table').removeClass('d-none');
                                    $('#product_display_data').children('tr').remove();

                                    function formatItem(item) {
                                        return '      <td><div class="form-check"><input class="form-check-input" class="product_id"name="product_id"value="' + item.id + '"type="radio"></div></td><td>' + '<a href=' + item.one_image + 'data-toggle = "lightbox" >' +
                                            '<img class="slider_image" src ="' + item.one_image + '"onerror = "this.src="{{asset('uploads/default_image.png')}}""alt = "logo" > </a></td> <td> ' + item.name + ' </td><td>' + item.price + '</td > ';
                                    }


                                    var data = data.data.products;
                                    $.each(data, function (key, item) {

                                        $('<tr>', {html: formatItem(item)}).appendTo($("#tbdata"));
                                    });
                                }
                            }
                        });
                    });
                } else if (selectedSubject == "SpecialNumber") {
                    $('.special_number').removeClass('d-none');
                    $('.product').addClass('d-none');
                    $('.vehicle').addClass('d-none');

                    $('.v-table').addClass('d-none');
                    $('.p-table').addClass('d-none');

                } else if (selectedSubject == "Vehicle") {
                    $('.vehicle').removeClass('d-none');
                    $('.product').addClass('d-none');
                    $('.special_number').addClass('d-none');
                    // $('.v-table').addClass('d-none');
                    $('.p-table').addClass('d-none');

                    $(".vehicles_org").change(function () {
                        var object = $(".vehicles_org option:selected").val();
                        console.log(object);
                        var url = "{{route('auctions.org_vehicles' , ':object')}}";
                        url = url.replace(':object', object);
                        console.log(url);
                        $.ajax({
                            type: "Get",
                            url: url,
                            // data: object,
                            datatype: 'JSON',
                            success: function (data) {
                                console.log(data.data);
                                if (data.status == true) {
                                    console.log(data.data);
                                    $('.v-table').removeClass('d-none');
                                    $('#vehicle_display_data').children('tr').remove();

                                    function formatItem(item) {
                                        return '<td><div class="form-check"><input class="form-check-input" class="vehicle_id"name="vehicle_id"value="'
                                            + item.id + '"type="radio"></div></td><td>' + item.brand.name + '</td><td>' +
                                            +item.car_class.name + '</td> <td> ' + item.car_class.name + ' </td><td>' + item.price + '</td > ';
                                    }

                                    //
                                    // function formatItem(item) {
                                    //     return '<td>' + item.brand.name + '</td><td>' + item.car_model.name + '</td><td>' + item.car_class.name + '</td><td>' + item.price + '</td>';
                                    // }


                                    var data = data.data.vehicles;
                                    $.each(data, function (key, item) {

                                        $('<tr>', {html: formatItem(item)}).appendTo($("#vehicledata"));
                                    });
                                }
                            }
                        });
                    });
                }
            });

        });
    </script>
@endsection
