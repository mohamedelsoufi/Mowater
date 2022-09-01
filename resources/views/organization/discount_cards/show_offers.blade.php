@extends('organization.layouts.app')
@section('title','Mawatery | Mawater Card Offer')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{$discount_cad->title}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{route('organization.discount-cards.index')}}">{{__('words.discount_cards')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.discount_card_offers')}}</li>
                    </ol>
                </div>
                @include('organization.includes.alerts.success')
                @include('organization.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{route('organization.discount-cards.update_offers',$discount_cad->id)}}"
                          method="post">
                        @csrf
                        <input type="hidden" name="discount_card_id" value="{{$discount_cad->id}}">
                        <div class="card">
                            {{-- create modal start --}}
                            <div class="card-header">

                            </div>
                            {{-- create modal end --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if(isset($vehicles) && count($vehicles) > 0)
                                        <div class="container mb-4">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h4>* {{__('words.vehicles')}}</h4>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div>
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="table-responsive" style="max-height: 400px;">
                                                        <table class="table header-border table-hover verticle-middle">
                                                            <thead class="text-dark">
                                                            <tr class="text-center">
                                                                <th>
                                                                    <i class="fas fa-check-circle"></i> {{__('words.select')}}
                                                                </th>
                                                                <th>{{__('words.image_s')}}</th>
                                                                <th>{{__('words.name')}}</th>
                                                                <th>{{__('words.number_of_uses_times')}}</th>
                                                                <th>{{__('words.discount_type')}}</th>
                                                                <th>{{__('words.value')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="display_data">

                                                            @for($i = 0 ; $i < count($vehicles); $i++)
                                                                <tr class="text-center">
                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                   name="vehicle_id[{{$i}}]"
                                                                                   {{$vehicles[$i]->offers->first() ? 'checked' :''}}
                                                                                   {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                                   {{ (is_array(old('vehicle_id')) && in_array($vehicles[$i]->id,old('vehicle_id.*'))) ? ' checked' : '' }}
                                                                                   value="{{$vehicles[$i]->id}}"
                                                                                   type="checkbox">
                                                                            @error('vehicle_id')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{$vehicles[$i]->one_image}}"
                                                                           data-toggle="lightbox">
                                                                            <img class="slider_image"
                                                                                 src="{{$vehicles[$i]->one_image}}"
                                                                                 onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                                                 alt="logo">
                                                                        </a>
                                                                    </td>

                                                                    <td>{{$vehicles[$i]->name}}</td>

                                                                    {{--                                                                    <td>--}}
                                                                    {{--                                                                        <select name="vehicle_number_of_uses_times[{{$i}}]"--}}
                                                                    {{--                                                                                {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}--}}
                                                                    {{--                                                                                class="form-control vehicle_number_of_uses_times @error('vehicle_number_of_uses_times') is-invalid @enderror">--}}
                                                                    {{--                                                                            @foreach(number_of_uses_times_arr() as $key=>$value)--}}
                                                                    {{--                                                                                <option--}}
                                                                    {{--                                                                                    @if($vehicles[$i]->get_offer($discount_cad->id))--}}
                                                                    {{--                                                                                    {{ old('vehicle_number_of_uses_times') == $key ? "selected" : "" }}--}}
                                                                    {{--                                                                                    value="{{$key}}"--}}
                                                                    {{--                                                                                    {{$vehicles[$i]->get_offer($discount_cad->id)->number_of_uses_times == $key ? "selected" : ""}}--}}
                                                                    {{--                                                                                    @else--}}
                                                                    {{--                                                                                    {{old('vehicle_discount_type') == $key ? 'selected' : ''}}--}}
                                                                    {{--                                                                                    value="{{$key}}"--}}
                                                                    {{--                                                                                    @endif>{{$value}}</option>--}}
                                                                    {{--                                                                            @endforeach--}}
                                                                    {{--                                                                        </select>--}}
                                                                    {{--                                                                        @error('vehicle_number_of_uses_times')--}}
                                                                    {{--                                                                        <span class="invalid-feedback" role="alert">--}}
                                                                    {{--                                                                            <strong>{{ $message }}</strong>--}}
                                                                    {{--                                                                        </span>--}}
                                                                    {{--                                                                        @enderror--}}

                                                                    {{--                                                                    </td>--}}

                                                                    <td class="vehicle_specific_number">
                                                                        <input type="number"
                                                                               name="vehicle_specific_number[{{$i}}]"
                                                                               min="1"
                                                                               {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                               class="form-control mt-3 vehicle_specific_number @error('vehicle_specific_number.'.$i) is-invalid @enderror"
                                                                               value="{{ old('vehicle_specific_number',$vehicles[$i]->get_offer($discount_cad->id) ? $vehicles[$i]->get_offer($discount_cad->id)->specific_number : '')}}"
                                                                               placeholder="{{__('words.specific_number')}}">
                                                                        @error('vehicle_specific_number.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <select name="vehicle_discount_type[{{$i}}]"
                                                                                {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                                class="form-control @error('vehicle_discount_type') is-invalid @enderror">
                                                                            <option
                                                                                @if($vehicles[$i]->get_offer($discount_cad->id))
                                                                                {{old('vehicle_discount_type') == $vehicles[$i]->get_offer($discount_cad->id)->discount_type ? "selected" : ""}}
                                                                                value="percentage"
                                                                                {{$vehicles[$i]->get_offer($discount_cad->id)->discount_type == "percentage" ? "selected" : ""}}
                                                                                @else
                                                                                {{old('vehicle_discount_type') == 'amount' ? 'selected' : ''}}
                                                                                value="percentage"
                                                                                @endif
                                                                            >{{__('words.percentage')}}</option>

                                                                            <option
                                                                                @if($vehicles[$i]->get_offer($discount_cad->id))
                                                                                {{old('vehicle_discount_type') == $vehicles[$i]->get_offer($discount_cad->id)->discount_type ? "selected" : ""}}
                                                                                value="amount"
                                                                                {{$vehicles[$i]->get_offer($discount_cad->id)->discount_type == "amount" ? "selected" : ""}}
                                                                                @else
                                                                                {{old('vehicle_discount_type') == 'amount' ? 'selected' : ''}}
                                                                                value="amount"
                                                                                @endif
                                                                            >{{__('words.amount')}}</option>
                                                                        </select>
                                                                        @error('vehicle_discount_type')
                                                                        <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <input type="number"
                                                                               name="vehicle_discount_value[{{$i}}]"
                                                                               step="0.01"
                                                                               {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                               min="0" id="price"
                                                                               class="form-control @error('vehicle_discount_value.'.$i) is-invalid @enderror"
                                                                               value="{{old('vehicle_discount_value',$vehicles[$i]->get_offer($discount_cad->id) ? $vehicles[$i]->get_offer($discount_cad->id)->discount_value : '') }}"
                                                                               placeholder="{{__('words.discount_value')}}">
                                                                        @error('vehicle_discount_value.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr style="border: 1px solid black;">
                                    @endif

                                    @if(isset($products) && count($products) > 0)
                                        <div class="container mt-4">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h4>* {{__('words.products')}}</h4>
                                                    <hr>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="table-responsive" style="max-height: 400px;">
                                                        <table class="table header-border table-hover verticle-middle">
                                                            <thead class="text-dark">
                                                            <tr class="text-center">
                                                                <th>
                                                                    <i class="fas fa-check-circle"></i> {{__('words.select')}}
                                                                </th>
                                                                <th>{{__('words.image_s')}}</th>
                                                                <th>{{__('words.name')}}</th>
                                                                <th>{{__('words.number_of_uses_times')}}</th>
                                                                <th>{{__('words.discount_type')}}</th>
                                                                <th>{{__('words.value')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="display_data">
                                                            @for($i = 0 ; $i < count($products); $i++)
                                                                <tr class="text-center">
                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                   name="product_id[{{$i}}]"
                                                                                   {{$products[$i]->offers->first() ? 'checked' :''}}
                                                                                   {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                                   value="{{$products[$i]->id}}"
                                                                                   type="checkbox">
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

                                                                    {{--                                                                    <td>--}}
                                                                    {{--                                                                        <select name="product_number_of_uses_times[{{$i}}]"--}}
                                                                    {{--                                                                                {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}--}}
                                                                    {{--                                                                                class="form-control product_number_of_uses_times @error('product_number_of_uses_times') is-invalid @enderror">--}}
                                                                    {{--                                                                            @foreach(number_of_uses_times_arr() as $key=>$value)--}}
                                                                    {{--                                                                                <option--}}
                                                                    {{--                                                                                    @if($products[$i]->get_offer($discount_cad->id))--}}
                                                                    {{--                                                                                    {{ old('product_number_of_uses_times') == $key ? "selected" : "" }}--}}
                                                                    {{--                                                                                    value="{{$key}}"--}}
                                                                    {{--                                                                                    {{$products[$i]->get_offer($discount_cad->id)->number_of_uses_times == $key ? "selected" : ""}}--}}
                                                                    {{--                                                                                    @else--}}
                                                                    {{--                                                                                    {{old('product_number_of_uses_times') == $key ? 'selected' : ''}}--}}
                                                                    {{--                                                                                    value="{{$key}}"--}}
                                                                    {{--                                                                                    @endif>{{$value}}</option>--}}
                                                                    {{--                                                                            @endforeach--}}
                                                                    {{--                                                                        </select>--}}
                                                                    {{--                                                                        @error('product_number_of_uses_times')--}}
                                                                    {{--                                                                        <span class="invalid-feedback" role="alert">--}}
                                                                    {{--                                                                            <strong>{{ $message }}</strong>--}}
                                                                    {{--                                                                        </span>--}}
                                                                    {{--                                                                        @enderror--}}

                                                                    {{--                                                                    </td>--}}

                                                                    <td class="product_specific_number">
                                                                        <input type="number"
                                                                               name="product_specific_number[{{$i}}]"
                                                                               min="1"
                                                                               {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                               class="form-control mt-3 vehicle_specific_number @error('product_specific_number.'.$i) is-invalid @enderror"
                                                                               value="{{ old('product_specific_number',$products[$i]->get_offer($discount_cad->id) ? $products[$i]->get_offer($discount_cad->id)->specific_number : '')}}"
                                                                               placeholder="{{__('words.specific_number')}}">
                                                                        @error('product_specific_number.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <select name="product_discount_type[{{$i}}]"
                                                                                {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                                class="form-control @error('product_discount_type') is-invalid @enderror">
                                                                            <option
                                                                                @if($products[$i]->get_offer($discount_cad->id))
                                                                                {{old('product_discount_type') == $products[$i]->get_offer($discount_cad->id)->discount_type ? "selected" : ""}}
                                                                                value="percentage"
                                                                                {{$products[$i]->get_offer($discount_cad->id)->discount_type == "percentage" ? "selected" : ""}}
                                                                                @else
                                                                                {{old('product_discount_type') == 'percentage' ? 'selected' : ''}}
                                                                                value="percentage"
                                                                                @endif
                                                                            >{{__('words.percentage')}}</option>

                                                                            <option
                                                                                @if($products[$i]->get_offer($discount_cad->id))
                                                                                {{old('product_discount_type') == $products[$i]->get_offer($discount_cad->id)->discount_type ? "selected" : ""}}
                                                                                value="amount"
                                                                                {{$products[$i]->get_offer($discount_cad->id)->discount_type == "amount" ? "selected" : ""}}
                                                                                @else
                                                                                {{old('product_discount_type') == 'amount' ? 'selected' : ''}}
                                                                                value="amount"
                                                                                @endif
                                                                            >{{__('words.amount')}}</option>
                                                                        </select>
                                                                        @error('product_discount_type')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <input type="number"
                                                                               name="product_discount_value[{{$i}}]"
                                                                               step="0.01"
                                                                               {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                               min="0" id="price"
                                                                               class="form-control @error('product_discount_value.'.$i) is-invalid @enderror"
                                                                               value="{{ old('product_discount_value',$products[$i]->get_offer($discount_cad->id) ? $products[$i]->get_offer($discount_cad->id)->discount_value : '') }}"
                                                                               placeholder="{{__('words.discount_value')}}">
                                                                        @error('product_discount_value.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr style="border: 1px solid black;">
                                    @endif

                                    @if(isset($services) && count($services) > 0)
                                        <div class="container mt-4">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h4>* {{__('words.services')}}</h4>
                                                    <hr>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="table-responsive" style="max-height: 400px;">
                                                        <table class="table header-border table-hover verticle-middle">
                                                            <thead class="text-dark">
                                                            <tr class="text-center">
                                                                <th>
                                                                    <i class="fas fa-check-circle"></i> {{__('words.select')}}
                                                                </th>
                                                                <th>{{__('words.image_s')}}</th>
                                                                <th>{{__('words.name')}}</th>
                                                                <th>{{__('words.number_of_uses_times')}}</th>
                                                                <th>{{__('words.discount_type')}}</th>
                                                                <th>{{__('words.value')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="display_data">
                                                            @for($i =0 ; $i < count($services); $i++)
                                                                <tr class="text-center">
                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                   name="service_id[{{$i}}]"
                                                                                   {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                                   {{$services[$i]->offers->first() ? 'checked' :''}}
                                                                                   value="{{$services[$i]->id}}"
                                                                                   type="checkbox">
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{$services[$i]->one_image}}"
                                                                           data-toggle="lightbox">
                                                                            <img class="slider_image"
                                                                                 src="{{$services[$i]->one_image}}"
                                                                                 onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                                                 alt="logo">
                                                                        </a>
                                                                    </td>

                                                                    <td>{{$services[$i]->name}}</td>

                                                                    {{--                                                                    <td>--}}
                                                                    {{--                                                                        <select name="service_number_of_uses_times[{{$i}}]"--}}
                                                                    {{--                                                                                {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}--}}
                                                                    {{--                                                                                class="form-control service_number_of_uses_times @error('service_number_of_uses_times') is-invalid @enderror">--}}
                                                                    {{--                                                                            @foreach(number_of_uses_times_arr() as $key=>$value)--}}
                                                                    {{--                                                                                <option--}}
                                                                    {{--                                                                                    @if($services[$i]->get_offer($discount_cad->id))--}}
                                                                    {{--                                                                                    {{ old('service_number_of_uses_times') == $key ? "selected" : "" }}--}}
                                                                    {{--                                                                                    value="{{$key}}"--}}
                                                                    {{--                                                                                    {{$services[$i]->get_offer($discount_cad->id)->number_of_uses_times == $key ? "selected" : ""}}--}}
                                                                    {{--                                                                                    @else--}}
                                                                    {{--                                                                                    {{old('service_number_of_uses_times') == $key ? 'selected' : ''}}--}}
                                                                    {{--                                                                                    value="{{$key}}"--}}
                                                                    {{--                                                                                    @endif>{{$value}}</option>--}}
                                                                    {{--                                                                            @endforeach--}}
                                                                    {{--                                                                        </select>--}}
                                                                    {{--                                                                        @error('service_number_of_uses_times')--}}
                                                                    {{--                                                                        <span class="invalid-feedback" role="alert">--}}
                                                                    {{--                                                                            <strong>{{ $message }}</strong>--}}
                                                                    {{--                                                                        </span>--}}
                                                                    {{--                                                                        @enderror--}}

                                                                    {{--                                                                    </td>--}}

                                                                    <td class="service_specific_number">
                                                                        <input type="number"
                                                                               name="service_specific_number[{{$i}}]"
                                                                               min="1"
                                                                               {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                               class="form-control mt-3 vehicle_specific_number @error('service_specific_number.'.$i) is-invalid @enderror"
                                                                               value="{{ old('service_specific_number',$services[$i]->get_offer($discount_cad->id) ? $services[$i]->get_offer($discount_cad->id)->specific_number : '')}}"
                                                                               placeholder="{{__('words.specific_number')}}">
                                                                        @error('service_specific_number.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <select name="service_discount_type[{{$i}}]"
                                                                                {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                                class="form-control @error('service_discount_type') is-invalid @enderror">
                                                                            <option
                                                                                @if($services[$i]->get_offer($discount_cad->id))
                                                                                {{old('service_discount_type') == $services[$i]->get_offer($discount_cad->id)->discount_type ? "selected" : ""}}
                                                                                value="percentage"
                                                                                {{$services[$i]->get_offer($discount_cad->id)->discount_type == "percentage" ? "selected" : ""}}
                                                                                @else
                                                                                {{old('service_discount_type') == 'percentage' ? 'selected' : ''}}
                                                                                value="percentage"
                                                                                @endif
                                                                            >{{__('words.percentage')}}</option>

                                                                            <option
                                                                                @if($services[$i]->get_offer($discount_cad->id))
                                                                                {{old('service_discount_type') == $services[$i]->get_offer($discount_cad->id)->discount_type ? "selected" : ""}}
                                                                                value="amount"
                                                                                {{$services[$i]->get_offer($discount_cad->id)->discount_type == "amount" ? "selected" : ""}}
                                                                                @else
                                                                                {{old('service_discount_type') == 'amount' ? 'selected' : ''}}
                                                                                value="amount"
                                                                                @endif
                                                                            >{{__('words.amount')}}</option>
                                                                        </select>
                                                                        @error('service_discount_type')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <input type="number"
                                                                               name="service_discount_value[{{$i}}]"
                                                                               step="0.01" min="0" id="price"
                                                                               {{$discount_cad->status != 'not_started' ? 'disabled' : ''}}
                                                                               class="form-control @error('service_discount_value.'.$i) is-invalid @enderror"
                                                                               value="{{ old('service_discount_value',$services[$i]->get_offer($discount_cad->id) ? $services[$i]->get_offer($discount_cad->id)->discount_value : '') }}"
                                                                               placeholder="{{__('words.discount_value')}}">
                                                                        @error('service_discount_value.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                    </span>
                                                                        @enderror
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-primary">{{__('words.update')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        console.log("{{old('vehicle_id.*.')}}");
    </script>

@endsection

