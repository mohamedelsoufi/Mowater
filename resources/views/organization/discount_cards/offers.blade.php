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
                    <form action="{{route('organization.discount-cards.create_offers')}}" method="post">
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
                                                                                   value="{{$vehicles[$i]->id}}"
                                                                                   type="checkbox">
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
{{--                                                                                class="form-control vehicle_number_of_uses_times @error('vehicle_number_of_uses_times') is-invalid @enderror">--}}
{{--                                                                            @foreach(number_of_uses_times_arr() as $key=>$value)--}}
{{--                                                                                <option--}}
{{--                                                                                    {{ old('vehicle_number_of_uses_times') == $key ? "selected" : "" }} value="{{$key}}">{{$value}}</option>--}}
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
                                                                               class="form-control mt-3 vehicle_specific_number @error('vehicle_specific_number.'.$i) is-invalid @enderror"
                                                                               value="{{ old('vehicle_specific_number') }}"
                                                                               placeholder="{{__('words.specific_number')}}">
                                                                        @error('vehicle_specific_number.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <select name="vehicle_discount_type[{{$i}}]"
                                                                                class="form-control @error('vehicle_discount_type') is-invalid @enderror">
                                                                            <option
                                                                                {{old('vehicle_discount_type') == 'percentage' ? 'selected' : ''}}
                                                                                value="percentage">{{__('words.percentage')}}</option>
                                                                            <option
                                                                                {{old('vehicle_discount_type') == 'amount' ? 'selected' : ''}}
                                                                                value="amount">{{__('words.amount')}}</option>
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
                                                                               min="0" id="price"
                                                                               class="form-control @error('vehicle_discount_value.'.$i) is-invalid @enderror"
                                                                               value="{{ old('vehicle_discount_value') }}"
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
                                    @endif

                                    @if(isset($products) && count($products) > 0)
                                        <hr style="border: 1px solid black;">
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
                                                        <table
                                                            class="table header-border table-hover verticle-middle">
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
{{--                                                                                class="form-control product_number_of_uses_times @error('product_number_of_uses_times') is-invalid @enderror">--}}
{{--                                                                            @foreach(number_of_uses_times_arr() as $key=>$value)--}}
{{--                                                                                <option--}}
{{--                                                                                    {{ old('product_number_of_uses_times') == $key ? "selected" : "" }} value="{{$key}}">{{$value}}</option>--}}
{{--                                                                            @endforeach--}}
{{--                                                                        </select>--}}
{{--                                                                        @error('product_number_of_uses_times')--}}
{{--                                                                        <span class="invalid-feedback" role="alert">--}}
{{--                                                                            <strong>{{ $message }}</strong>--}}
{{--                                                                        </span>--}}
{{--                                                                        @enderror--}}
{{--                                                                    </td>--}}

                                                                    <td>
                                                                        <input type="number"
                                                                               name="product_specific_number[{{$i}}]"
                                                                               min="1"
                                                                               class="form-control mt-3 product_specific_number @error('product_specific_number.'.$i) is-invalid @enderror"
                                                                               value="{{ old('product_specific_number') }}"
                                                                               placeholder="{{__('words.specific_number')}}">
                                                                        @error('product_specific_number.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <select name="product_discount_type[{{$i}}]"
                                                                                class="form-control @error('product_discount_type') is-invalid @enderror">
                                                                            <option
                                                                                {{old('product_discount_type') == 'percentage' ? 'selected' : ''}}
                                                                                value="percentage">{{__('words.percentage')}}</option>
                                                                            <option
                                                                                {{old('product_discount_type') == 'amount' ? 'selected' : ''}}
                                                                                value="amount">{{__('words.amount')}}</option>
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
                                                                               min="0" id="price"
                                                                               class="form-control @error('product_discount_value.'.$i) is-invalid @enderror"
                                                                               value="{{ old('product_discount_value') }}"
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

                                                                    <td>
                                                                        <input type="number"
                                                                               name="service_specific_number[{{$i}}]"
                                                                               min="1"
                                                                               class="form-control mt-3 service_specific_number @error('service_specific_number.'.$i) is-invalid @enderror"
                                                                               value="{{ old('service_specific_number') }}"
                                                                               placeholder="{{__('words.specific_number')}}">
                                                                        @error('service_specific_number.'.$i)
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </td>

                                                                    <td>
                                                                        <select name="service_discount_type[{{$i}}]"
                                                                                class="form-control @error('service_discount_type') is-invalid @enderror">
                                                                            <option
                                                                                {{old('service_discount_type') == 'percentage' ? 'selected' : ''}}
                                                                                value="percentage">{{__('words.percentage')}}</option>
                                                                            <option
                                                                                {{old('service_discount_type') == 'amount' ? 'selected' : ''}}
                                                                                value="amount">{{__('words.amount')}}</option>
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
                                                                               class="form-control @error('service_discount_value.'.$i) is-invalid @enderror"
                                                                               value="{{ old('service_discount_value') }}"
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
                                <button type="submit" class="btn btn-outline-primary">{{__('words.create')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

