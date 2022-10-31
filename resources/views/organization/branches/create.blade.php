@extends('organization.layouts.app')
@section('title','Mawatery | Branches')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.create_branch')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.branches')}}</li>
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

                        <div class="card-body">
                          <form action="{{route('organization.branch.store')}}" method = "POST">
                              @csrf
                              <h3>{{__('words.main_data')}}</h3>
                              <br>
                              {{--Main Data --}}
                              <div class="row">

                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_en')}}</label>
                                    <input type="text" name = "name_en" value = "{{old('name_en')}}" class="form-control @error('name_en') is-invalid @enderror">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_ar')}}</label>
                                    <input type="text" name = "name_ar" value = "{{old('name_ar')}}" class="form-control @error('name_ar') is-invalid @enderror">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.address_ar')}}</label>
                                    <input type="text" name = "address_ar" value = "{{old('address_ar')}}" class="form-control @error('address_ar') is-invalid @enderror">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.address_en')}}</label>
                                    <input type="text" name = "address_en" value = "{{old('address_en')}}" class="form-control @error('address_en') is-invalid @enderror">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.longitude')}}</label>
                                    <input type="text" name = "longitude" value = "{{old('longitude')}}" class="form-control @error('longitude') is-invalid @enderror">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.latitude')}}</label>
                                    <input type="text" name = "latitude" value = "{{old('latitude')}}" class="form-control @error('latitude') is-invalid @enderror">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.category')}}</label>
                                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">{{__('words.category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}  >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.country')}}</label>
                                    <select name="country_id"
                                            class="form-control country_id @error('country_id') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" {{old('country_id') == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
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
                                    <select name="city_id"
                                            class="form-control city_id @error('city_id') is-invalid @enderror">
                                    </select>
                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{__('words.area')}}</label>
                                    <select name="area_id"
                                            class="form-control area_id @error('area_id') is-invalid @enderror">
                                    </select>
                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                              </div>

                                <h3>{{__('words.user_branch_data')}}</h3>
                                <br>
                                {{-- Organization user start --}}
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>{{__('words.email')}}</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{__('words.email')}}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('words.user_name')}}</label>
                                        <input type="text" name="user_name" class="form-control @error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" placeholder="{{__('words.user_name')}}">

                                        @error('user_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>{{__('words.password')}}</label>
                                        <input  type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('words.password')}}">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Organization user end --}}

                                {{--Work Time --}}
                                <h3>{{__('words.work_time')}}</h3>
                                <br>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.time_from')}}</label>
                                        <input type="time" name = "from" value = "{{old('from')}}" class="form-control @error('from') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.time_to')}}</label>
                                        <input type="time" name = "to" value = "{{old('to')}}" class="form-control @error('to') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>{{__('words.duration')}}</label>
                                        <input type="number" name = "duration" value = "{{old('duration')}}" class="form-control @error('duration') is-invalid @enderror">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>{{__('words.work_days')}}</label>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for = "Sat">{{__('words.Sat')}}</label>
                                                <input type = "checkbox" name = "work_days[]" value = "Sat" id = "Sat" {{ old('work_days') && in_array('Sat' , old('work_days')) ? 'checked' : ''   }}  >
                                            </div>

                                            <div class="col-md-2">
                                                <label for = "Sun">{{__('words.Sun')}}</label>
                                                <input type = "checkbox" name = "work_days[]" value = "Sun" id = "Sun" {{ old('work_days') && in_array('Sun' , old('work_days')) ? 'checked' : ''   }}  >
                                            </div>

                                            <div class="col-md-2">
                                                <label for = "Mon">{{__('words.Mon')}}</label>
                                                <input type = "checkbox" name = "work_days[]" value = "Mon" id = "Mon" {{ old('work_days') && in_array('Mon' , old('work_days')) ? 'checked' : ''   }}  >
                                            </div>

                                            <div class="col-md-2">
                                                <label for = "Tue">{{__('words.Tue')}}</label>
                                                <input type = "checkbox" name = "work_days[]" value = "Tue" id = "Tue" {{ old('work_days') && in_array('Tue' , old('work_days')) ? 'checked' : ''   }}  >
                                            </div>

                                            <div class="col-md-2">
                                                <label for = "Wed">{{__('words.Wed')}}</label>
                                                <input type = "checkbox" name = "work_days[]" value = "Wed" id = "Wed" {{ old('work_days') && in_array('Wed' , old('work_days')) ? 'checked' : ''   }}  >
                                            </div>

                                            <div class="col-md-2">
                                                <label for = "Thu">{{__('words.Thu')}}</label>
                                                <input type = "checkbox" name = "work_days[]" value = "Thu" id = "Thu" {{ old('work_days') && in_array('Thu' , old('work_days')) ? 'checked' : ''   }}  >
                                            </div>

                                            <div class="col-md-2">
                                                <label for = "Fri">{{__('words.Fri')}}</label>
                                                <input type = "checkbox" name = "work_days[]" value = "Fri" id = "Fri" {{ old('work_days') && in_array('Fri' , old('work_days')) ? 'checked' : ''   }}  >
                                            </div>

                                            @error('work_days')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- contact --}}
                                <h3>{{__('words.contact')}}</h3>
                                <br>
                                <div class="row">

                                        <div class="form-group col-md-6">
                                            <label>{{__('words.facebook_link')}}</label>
                                            <input type="text" name = "facebook_link" value = "{{old('facebook_link')}}" class="form-control @error('facebook_link') is-invalid @enderror">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>{{__('words.whatsapp_number')}}</label>
                                            <input type="text" name = "whatsapp_number" value = "{{old('whatsapp_number')}}" class="form-control @error('whatsapp_number') is-invalid @enderror">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>{{__('words.phone')}}</label>
                                            <input type="text" name = "phone" value = "{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>{{__('words.website')}}</label>
                                            <input type="text" name = "website" value = "{{old('website')}}" class="form-control @error('website') is-invalid @enderror">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>{{__('words.instagram_link')}}</label>
                                            <input type="text" name = "instagram_link" value = "{{old('instagram_link')}}" class="form-control @error('instagram_link') is-invalid @enderror">
                                        </div>
                                </div>

                                {{-- vehicles --}}
                                <h3>{{__('words.available_vehicles')}}</h3>
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="vehicles[]">{{__('words.available_vehicles')}}</label>
                                        <select name="vehicles[]" class = "form-control select2" multiple>
                                            @foreach($vehicles as $vehicle)
                                                <option value="{{$vehicle->id}}" {{ old('vehicles') && in_array($vehicle->id , old('vehicles')) ? 'selected': '' }}  >{{$vehicle->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                 {{-- products --}}
                                 <h3>{{__('words.available_products')}}</h3>
                                 <br>
                                 <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="products[]">{{__('words.available_products')}}</label>
                                        <select name="products[]" class = "form-control select2" multiple>
                                            @foreach($products as $vehicle)
                                                <option value="{{$vehicle->id}}" {{ old('products') && in_array($vehicle->id , old('products')) ? 'selected': '' }}  >{{$vehicle->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                  {{-- services --}}
                                <h3>{{__('words.available_services')}}</h3>
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="services[]">{{__('words.available_services')}}</label>
                                        <select name="services[]" class = "form-control select2" multiple>
                                            @foreach($services as $vehicle)
                                                <option value="{{$vehicle->id}}" {{ old('services') && in_array($vehicle->id , old('services')) ? 'selected': '' }}  >{{$vehicle->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="reservation_availability"
                                               name="reservation_availability" value="0"
                                               type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.reservation_availability')}}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="delivery_availability"
                                               name="delivery_availability" value="0"
                                               type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.delivery_availability')}}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 ">
                                    <div class="form-check">
                                        <input class="form-check-input" id="available" name="availability" value="0"
                                               type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.available')}}
                                        </label>
                                    </div>
                                </div>

                            </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-primary">{{__('words.create')}}</button>
                                </div>

                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('styles')
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice
{
    background-color: #343957;
}
</style>
@endsection


@section('scripts')
  <script>
      $(".select2").select2();
  </script>
@endsection

