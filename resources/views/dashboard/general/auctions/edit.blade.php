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
                                    <h4>{{__('words.edit_auction')}}</h4>
                                </div>
                            </div>
                        </div>
                        @if(session()->has('error'))
                            <div class="alert alert-danger col-md-6">
                                <div>{{ session()->get('error') }}</div>
                            </div>
                        @endif
                        <form method="POST" action="{{route('auctions.update',$auction->id)}}" id="store_form"
                              autocomplete="off"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.title_ar')}}</label>
                                                <input type="text" name="title_ar"
                                                       class="form-control @error('title_ar') is-invalid @enderror"
                                                       value="{{ $auction->title_ar }}"
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
                                                       value="{{ $auction->title_ar}}"
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
                                                <label>{{__('words.start_price')}}</label>
                                                <input type="text" name="price" id="price"
                                                       class="form-control @error('price') is-invalid @enderror"
                                                       value="{{ $auction->price }}"
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
                                                       value="{{ $auction->insurance_amount }}"
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
                                                <input class="form-control" type="datetime-local" id="start_date"
                                                       value="{{$auction->start_date->format('Y-m-d\TH:i:s')}}"
                                                       name="start_date">
                                                @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label>{{__('words.end_date_time')}}</label>
                                                <input class="form-control" type="datetime-local" id="end_date"
                                                       value="{{$auction->end_date->format('Y-m-d\TH:i:s')}}"
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
                                                       @if($auction->active==1)
                                                       checked="checked"
                                                       @endif
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
                                                <option value="">{{__('words.choose')}}</option>
                                                <option
                                                    @if($auction->type=="Product")
                                                    selected
                                                    @endif
                                                    value="Product">{{__('words.Product')}}</option>
                                                <option
                                                    @if($auction->type=="SpecialNumber")
                                                    selected
                                                    @endif
                                                    value="SpecialNumber">{{__('words.special_number')}}</option>
                                                <option
                                                    @if($auction->type=="Vehicle")
                                                    selected
                                                    @endif
                                                    value="Vehicle">{{__('words.vehicle')}}</option>
                                            </select>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{--                                        @if($auction->type=="SpecialNumber")--}}
                                        <div class="col-md-12 d-none special_number">
                                            <div class="table-responsive" style="max-height: 400px;">
                                                <table
                                                    class="table header-border table-hover verticle-middle">
                                                    <thead class="text-dark">
{{--                                                    <tr class="text-center">--}}
                                                        <th>
                                                            <i class="fas fa-check-circle"></i> {{__('words.select')}}
                                                        </th>
                                                        <th>{{__('words.number')}}</th>
                                                        <th>{{__('words.price')}}</th>
{{--                                                    </tr>--}}
                                                    </tr>
                                                    </thead>
                                                    <tbody id="display_data">
                                                    @for($i = 0 ; $i < count($specialnumbers); $i++)
                                                        <tr class="text-center">
                                                            <td>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input special_number_id"
                                                                        name="special_number_id"
                                                                        @if($auction->type=="SpecialNumber"&&$specialnumbers[$i]->id==$auction->auctionable_id)
                                                                        checked="checked"
                                                                        @endif
                                                                        type="radio"
                                                                        value="{{$specialnumbers[$i]->id}}">
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
                                        {{--                                        @endif--}}
                                    </div>
                                    @if($auction->type=="Product")
                                        <div class="form-row">
                                            <div class="col-md-6 org-product">
                                                <label>{{__('words.organizations')}}</label>
                                                <select class="form-control products_org" name="products_org">
                                                    <option value="" selected>{{__('words.choose')}}</option>
                                                    @for($i=0;$i<count($products_organizations);$i++)
                                                        <option
                                                            {{$model=new $auction->auctionable_type}}
                                                            @if($auction->type=="Product"&&$model->find($auction->auctionable_id)->productable_type==$products_organizations[$i]->productable_type&&$model->find($auction->auctionable_id)->productable_id==$products_organizations[$i]->productable_id)
                                                            selected
                                                            @endif
                                                            value="{{$products_organizations[$i]['object']['id'].",".$products_organizations[$i]['type']}}">{{$products_organizations[$i]['object']->name}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-12 old-table">
                                                <div class="table-responsive" style="max-height: 400px;">

                                                    <table
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
                                                        </thead>
                                                        <tbody id="display_data">
                                                        @for($i = 0 ; $i < count($products); $i++)
                                                            <tr class="text-center">
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input"
                                                                               class="product_id"
                                                                               name="product_id"
                                                                               @if($products[$i]->id==$auction->auctionable_id &&$auction->auctionable_type=="App\\Models\\Product")
                                                                               checked="checked"
                                                                               @endif
                                                                               value="{{$products[$i]->id}}"
                                                                               type="radio">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="{{$products[$i]->one_image}}"
                                                                       data-toggle="lightbox">
                                                                        <img class="slider_image"
                                                                             src="{{$products[$i]->one_image}}"
                                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                                             alt="logo">
                                                                    </a>
                                                                </td>
                                                                <td>{{$products[$i]->name}}</td>
                                                                <td>{{$products[$i]->price}}</td>
                                                                @endfor
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                    @else--}}

                                    @endif
                                    <div class="form-row">
                                        <div class="col-md-6 d-none product">
                                            <label>{{__('words.organizations')}}</label>
                                            <select class="form-control products_org" name="products_org">
                                                <option value="" selected>{{__('words.choose')}}</option>
                                                @for($i=0;$i<count($products_organizations);$i++)
                                                    <option
                                                        {{$model=new $auction->auctionable_type}}
                                                        @if($auction->type=="Product"&&$model->find($auction->auctionable_id)->productable_type==$products_organizations[$i]->productable_type&&$model->find($auction->auctionable_id)->productable_id==$products_organizations[$i]->productable_id)
                                                        selected
                                                        @endif
                                                        value="{{$products_organizations[$i]['object']['id'].",".$products_organizations[$i]['type']}}">{{$products_organizations[$i]['object']->name}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-none p-table ">
                                        <div class="table-responsive" style="max-height: 400px;">
                                            <table id="tbdata"
                                                   class="table header-border table-hover verticle-middle">
                                                <thead class="text-dark">
                                                <th>
                                                    <i class="fas fa-check-circle"></i> {{__('words.select')}}
                                                </th>
                                                <th>{{__('words.image')}}</th>
                                                <th>{{__('words.name')}}</th>
                                                <th>{{__('words.price')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody id="product_display_data">
                                                <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    @if($auction->type=="Vehicle")
                                        <div class="form-row org-vehicle">
                                            <div class=" col-md-6">
                                                <label>{{__('words.organizations')}}</label>
                                                <select class="form-control vehicles_org"
                                                        name="vehicles_org">
                                                    <option value=""
                                                            selected>{{__('words.choose')}}</option>
                                                    @for($i=0;$i<count($vehicles_organizations);$i++)
                                                        <option
                                                            {{$model=new $auction->auctionable_type}}
                                                            @if($auction->type=="Vehicle"&&$model->find($auction->auctionable_id)->vheicable_type==$vehicles_organizations[$i]->vheicable_type&&$model->find($auction->auctionable_id)->vheicable_id==$vehicles_organizations[$i]->vheicable_id)
                                                            selected
                                                            @endif
                                                            value="{{$vehicles_organizations[$i]['object']['id'].",".$vehicles_organizations[$i]['type']}}">{{$vehicles_organizations[$i]['object']->name}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 old-v-table">
                                            <div class="table-responsive "
                                                 style="max-height: 400px;">
                                                <table
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
                                                    </thead>
                                                    <tbody id="display_data">
                                                    @foreach($vehicles as $vehicle)
                                                        <td>
                                                            <div class="form-check">
                                                                <input
                                                                    class="form-check-input vehicle_id"
                                                                    name="vehicle_id"
                                                                    @if($vehicle->id==$auction->auctionable_id &&$auction->auctionable_type=="App\\Models\\Vehicle")
                                                                    checked="checked"
                                                                    @endif
                                                                    type="radio"
                                                                    value="{{$vehicle->id}}">
                                                            </div>
                                                        </td>
                                                        <td>{{$vehicle->brand->name}}</td>
                                                        <td>{{$vehicle->car_model->name}}</td>
                                                        <td>{{$vehicle->car_class->name}}</td>
                                                        <td>{{$vehicle->manufacturing_year}}</td>
                                                        <td>{{$vehicle->price ? $vehicle->price : '--'}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-row">
                                        <div class="col-md-6 d-none vehicle">
                                            <label>{{__('words.organizations')}}</label>
                                            <select class="form-control vehicles_org"
                                                    name="vehicles_org">
                                                <option value=""
                                                        selected>{{__('words.choose')}}</option>
                                                @for($i=0;$i<count($vehicles_organizations);$i++)
                                                    <option
                                                        {{$model=new $auction->auctionable_type}}
                                                        @if($auction->type=="Vehicle"&&$model->find($auction->auctionable_id)->vheicable_type==$vehicles_organizations[$i]->vheicable_type&&$model->find($auction->auctionable_id)->vheicable_id==$vehicles_organizations[$i]->vheicable_id)
                                                        selected
                                                        @endif
                                                        value="{{$vehicles_organizations[$i]['object']['id'].",".$vehicles_organizations[$i]['type']}}">{{$vehicles_organizations[$i]['object']->name}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 d-none v-table">
                                        <div class="table-responsive "
                                             style="max-height: 400px;">
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
                                                </thead>
                                                <tbody id="vehicle_display_data">
                                                <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{--                                    <div class="form-row">--}}
                                    <div class="modal-footer">
                                        <a href="{{route('auctions.index')}}"
                                           class="btn btn-outline-danger">{{__('words.back')}}</a>
                                        <button type="submit"
                                                class="btn btn-outline-primary">{{__('words.update')}}</button>
                                    </div>
                                    {{--                                    </div>--}}
                                </div>
                            </div>

                        </form>
                    </div>
                    @if(count($auction->bids)>0)
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="col-sm-6 p-md-0">
                                            <div class="welcome-text">
                                                <h4>{{__('words.bids') .":"}} </h4>
                                                <h5> {{__('message.max_bid'). " ( ".
                                                                   $auction->bids()->max('price'). __('words.bhd')." )"}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered"
                                                   style="min-width: 845px">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>{{__('words.user')}}</th>
                                                    <th>{{__('words.price')}} ({{__('words.bhd')}})</th>
                                                    <th>{{__('words.bid_date')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody id="display_data">
                                                @foreach($auction->bids()->orderBy('price', 'desc')->get() as $bid)
                                                    <tr class="text-center">
                                                        <td>{{$bid->user->name}}</td>
                                                        <td>{{$bid->price}}</td>
                                                        <td>{{$bid->created_at->toDateString()}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var selectedSubject = $(".type option:selected").val();
            if (selectedSubject == "SpecialNumber")
                $('.special_number').removeClass('d-none');
            $(".products_org").change(function () {
                var object = $(".products_org option:selected").val();
                // console.log(object);
                var url = "{{route('auctions.org_products' , ':object')}}";
                url = url.replace(':object', object);
                $.ajax({
                    type: "Get",
                    url: url,
                    // data: object,
                    datatype: 'JSON',
                    success: function (data) {
                        if (data.status == true) {
                            console.log(data.data);

                            function formatItem(item) {
                                return '<td><div class="form-check"><input class="form-check-input" class="product_id"name="product_id" value="' + item.id + '"type="radio"></div></td>' + '<td><a href=' + item.one_image + 'data-toggle = "lightbox" >' +
                                    '<img class="slider_image" src ="' + item.one_image + '"onerror = "this.src="{{asset('uploads/default_image.png')}}""alt = "logo" > </a></td> <td> ' + item.name + ' </td><td>' + item.price + '</td > ';
                            }

                            $('.p-table').removeClass('d-none');
                            $('.old-table').addClass('d-none');
                            $('#product_display_data').children('tr').remove();
                            var data = data.data.products;
                            $.each(data, function (key, item) {
                                $('<tr>', {html: formatItem(item)}).appendTo($("#tbdata"));
                            });
                        }
                    }
                });
            });
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
                        // console.log(data.data);
                        if (data.status == true) {
                            $('.v-table').removeClass('d-none');

                            function formatItem(item) {
                                return '<td><div class="form-check"><input class="form-check-input" class="vehicle_id"name="vehicle_id"value="' + item.id + '"type="radio"></div></td><td>' + item.brand.name + '</td><td>' +
                                    +item.car_model.name + '</td> <td> ' + item.car_class.name + ' </td><td>' + item.price + '</td >';
                            }

                            $('.old-v-table').addClass('d-none');
                            $('#vehicle_display_data').children('tr').remove();
                            var data = data.data.vehicles;
                            $.each(data, function (key, item) {
                                // console.log(item.car_class.name);
                                $('<tr>', {html: formatItem(item)}).appendTo($("#vehicledata"));
                            });
                        }
                    }
                });
            });
            $(".type").change(function () {
                var selectedSubject = $(".type option:selected").val();
                if (selectedSubject == "Product") {
                    $('.product').removeClass('d-none');
                    $('.p-table').removeClass('d-none');

                    $('.special_number').addClass('d-none');
                    $('.vehicle').addClass('d-none');
                    $('.v-table').addClass('d-none');
                    $('.org-vehicle').addClass('d-none');
                    // $('.old-special_number').addClass('d-none');
                    $('.old-v-table').addClass('d-none');
                } else if (selectedSubject == "SpecialNumber") {
                    $('.special_number').removeClass('d-none');
                    $('.product').addClass('d-none');
                    $('.vehicle').addClass('d-none');
                    $('.v-table').addClass('d-none');
                    // $('.p-table').addClass('d-none');
                    $('.org-vehicle').addClass('d-none');
                    $('.old-table').addClass('d-none');
                    $('.old-v-table').addClass('d-none');
                    $('.org-product').addClass('d-none');
                } else if (selectedSubject == "Vehicle") {
                    $('.vehicle').removeClass('d-none');
                    $('.old-product').addClass('d-none');
                    // $('.old-vehicle').addClass('d-none');
                    $('.product').addClass('d-none');
                    $('.special_number').addClass('d-none');
                    $('.old-table').addClass('d-none');
                    // $('.p-table').addClass('d-none');
                    $('.org-product').addClass('d-none');

                }
            });
            //
        });


    </script>
@endsection
