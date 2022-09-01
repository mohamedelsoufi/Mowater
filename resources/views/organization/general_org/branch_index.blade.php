@extends('organization.layouts.app')
@section('title','Mawatery | Branch Data')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{$branch->name}}
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{$branch->name}}</li>
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

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">

                            <form action="{{route('organization.update_branch_data' , $branch->id)}}" method = "POST">
                                @csrf
                                @method('PUT')
                                <h3>{{__('words.main_data')}}</h3>
                                <br>
                                {{--Main Data --}}
                                <div class="row">

                                  <div class="form-group col-md-6">
                                      <label>{{__('words.name_en')}}</label>
                                      <input type="text" name = "name_en" value = "{{$branch->name_en}}" class="form-control @error('name_en') is-invalid @enderror">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label>{{__('words.name_ar')}}</label>
                                      <input type="text" name = "name_ar" value = "{{$branch->name_ar}}" class="form-control @error('name_ar') is-invalid @enderror">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label>{{__('words.address_ar')}}</label>
                                      <input type="text" name = "address_ar" value = "{{$branch->address_ar}}" class="form-control @error('address_ar') is-invalid @enderror">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label>{{__('words.address_en')}}</label>
                                      <input type="text" name = "address_en" value = "{{$branch->address_en}}" class="form-control @error('address_en') is-invalid @enderror">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label>{{__('words.longitude')}}</label>
                                      <input type="text" name = "longitude" value = "{{$branch->longitude}}" class="form-control @error('longitude') is-invalid @enderror">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label>{{__('words.latitude')}}</label>
                                      <input type="text" name = "latitude" value = "{{$branch->latitude}}" class="form-control @error('latitude') is-invalid @enderror">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label>{{__('words.category')}}</label>
                                      <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                          <option value="">{{__('words.category')}}</option>
                                          @foreach($categories as $category)
                                              <option value="{{$category->id}}" {{$branch->category_id == $category->id ? 'selected' : ''}}  >{{$category->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>

                                  <div class="form-group col-md-4">
                                      <label>{{__('words.country')}}</label>
                                      <select name="country_id"
                                              class="form-control country_id @error('country_id') is-invalid @enderror">
                                          <option value="" selected>{{__('words.choose')}}</option>
                                          @foreach($countries as $country)
                                              <option value="{{$country->id}}" {{$branch->city && $branch->city->country_id == $country->id  ? 'selected' : '' }}  >{{$country->name}}</option>
                                          @endforeach
                                      </select>
                                      @error('country_id')
                                      <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>

                                  <div class="form-group col-md-4">
                                      <label>{{__('words.city')}}</label>
                                      <select name="city_id" class="form-control city_id @error('city_id') is-invalid @enderror">
                                          @foreach($cities as $city)
                                              <option value="{{$city->id}}" {{$branch->city_id == $city->id  ? 'selected' : '' }}>{{$city->name}}</option>
                                          @endforeach
                                      </select>
                                      @error('city_id')
                                      <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                  <div class="form-group col-md-4">
                                      <label>{{__('words.area')}}</label>
                                      <select name="area_id" class="form-control area_id @error('area_id') is-invalid @enderror">
                                          @foreach($areas as $area)
                                              <option value="{{$area->id}}" {{$branch->area_id == $area->id  ? 'selected' : '' }}>{{$area->name}}</option>
                                          @endforeach
                                      </select>
                                      @error('area_id')
                                      <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   name="reservation_availability" value="0" {{$branch->reservation_availability ? 'checked' : ''}}
                                                   type="checkbox">
                                            <label class="form-check-label">
                                                {{__('words.test_reservation_availability')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" id="delivery_availability" {{$branch->delivery_availability ? 'checked' : ''}}
                                                   name="delivery_availability" value="0"
                                                   type="checkbox">
                                            <label class="form-check-label">
                                                {{__('words.delivery_availability')}}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 ">
                                        <div class="form-check">
                                            <input class="form-check-input" id="available" name="availability" value="0" {{$branch->availability ? 'checked' : ''}}
                                                   type="checkbox">
                                            <label class="form-check-label">
                                                {{__('words.available')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                  <div class="modal-footer">
                                      <button type="submit" class="btn btn-outline-primary">{{__('words.edit')}}</button>
                                  </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection

