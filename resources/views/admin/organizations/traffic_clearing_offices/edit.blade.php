@extends('admin.layouts.standard')
@section('title', __('words.edit_traffic_clearing_office'))
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{__('words.admin_dashboard')}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb {{app()->getLocale() == 'ar' ? 'float-sm-left' :  'float-sm-right'}}">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('traffic-clearing-offices.index')}}">{{__('words.show_traffic_clearing_offices')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('words.edit_traffic_clearing_office')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @include('admin.includes.alerts.success')
        @include('admin.includes.alerts.errors')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">{{__('words.edit_traffic_clearing_office')}}</h3>
                            </div>
                            <form method="post"
                                  action="{{route('traffic-clearing-offices.update',$office->id)}}"
                                  autocomplete="off"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{$office->id}}">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.name_ar')}}</label>
                                                <input type="text" name="name_ar" dir="rtl"
                                                       class="form-control @error('name_ar') is-invalid @enderror"
                                                       value="{{ old('name_ar',$office->name_ar) }}"
                                                       placeholder="{{__('words.name_ar')}}">
                                                @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>{{__('words.name_en')}}</label>
                                                <input type="text" name="name_en" dir="ltr"
                                                       class="form-control @error('name_en') is-invalid @enderror"
                                                       value="{{ old('name_en',$office->name_en) }}"
                                                       placeholder="{{__('words.name_en')}}">

                                                @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>{{__('words.description_ar')}}</label>
                                                <textarea name="description_ar" dir="rtl"
                                                          class="form-control @error('description_ar') is-invalid @enderror">{{ old('description_ar',$office->description_ar) }}</textarea>

                                                @error('description_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>{{__('words.description_en')}}</label>
                                                <textarea name="description_en" dir="ltr"
                                                          class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en',$office->description_en) }}</textarea>

                                                @error('description_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.logo')}}</label>
                                                <input type="file" name="logo"
                                                       class="form-control image @error('logo') is-invalid @enderror"
                                                       placeholder="{{__('words.logo')}}">
                                                @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-6 text-center pt-3">
                                                <img src="{{ old('logo',$office->logo) }}"
                                                     class="index_image image-preview" alt="logo">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('words.tax_number')}}</label>
                                                <input type="text" name="tax_number"
                                                       class="form-control @error('tax_number') is-invalid @enderror"
                                                       value="{{ old('tax_number',$office->tax_number) }}"
                                                       placeholder="{{__('words.tax_number')}}">
                                                @error('tax_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>{{__('words.country')}}</label>
                                                <select name="country_id"
                                                        class="form-control country_id @error('country_id') is-invalid @enderror">
                                                    <option value="" selected>{{__('words.choose')}}</option>
                                                    @foreach($countries as $country)
                                                        @if (Input::old('country_id') == $country->id)
                                                            <option
                                                                selected
                                                                value="{{$country->id}}">{{$country->name}}</option>
                                                        @else
                                                            <option
                                                                value="{{$country->id}}" {{$office->country_id == $country->id ? "selected" : ""}}>{{$country->name}}</option>
                                                        @endif
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
                                                    @foreach(\App\Models\City::where('country_id',old('country_id'))->get() as $model)
                                                        @if (Input::old('city_id') == $model->id)

                                                            <option value="{{ $model->id }}"
                                                                    selected>{{ $model->name }}</option>
                                                        @else
                                                            <option value="{{ $model->id }}"
                                                            >{{ $model->name }}</option>
                                                        @endif
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
                                                <select name="area_id"
                                                        class="form-control area_id @error('area_id') is-invalid @enderror">
                                                    @foreach(\App\Models\Area::where('city_id',old('city_id'))->get() as $model)
                                                        @if (Input::old('area_id') == $model->id)

                                                            <option value="{{ $model->id }}"
                                                                    selected>{{ $model->name }}</option>
                                                        @else
                                                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                                                        @endif
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
                                                    <input class="form-check-input" name="active" value="0"
                                                           {{$office->active == 1 ? 'checked' : ''}} type="checkbox">
                                                    <label class="form-check-label">
                                                        {{__('words.activity')}}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="active_number_of_views"
                                                           value="0"
                                                           {{$office->active_number_of_views == 1 ? 'checked' : ''}} type="checkbox">
                                                    <label class="form-check-label">
                                                        {{__('words.active_number_of_views')}}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="reservation_active" value="0"
                                                           {{$office->reservation_active == 1 ? 'checked' : ''}} type="checkbox">
                                                    <label class="form-check-label">
                                                        {{__('words.reservation_active')}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <hr>

                                        {{-- Organization user start --}}
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>{{__('words.email')}}</label>
                                                <select name="organization_user_id"
                                                        class="form-control email-change @error('email') is-invalid @enderror">
                                                    <option value="" selected>{{__('words.choose')}}</option>
                                                </select>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label>{{__('words.user_name')}}</label>
                                                <input type="text" name="user_name"
                                                       class="form-control username @error('user_name') is-invalid @enderror"
                                                       value="{{ old('user_name') }}"
                                                       placeholder="{{__('words.user_name')}}">

                                                @error('user_name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label>{{__('words.password')}}</label>
                                                <input type="password" name="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       value="{{ old('password') }}"
                                                       placeholder="{{__('words.password')}}">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label>{{__('words.confirm_password')}}</label>
                                                <input type="password" name="password_confirmation"
                                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                                       value="{{ old('password_confirmation') }}"
                                                       placeholder="{{__('words.confirm_password')}}">

                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Organization user end --}}
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-block btn-outline-info">
                                                {{__('words.update')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>

    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            get_cities("{{$office->country_id}}", "{{$office->city_id}}", "{{$office->area_id}}");
            get_areas("{{$office->city_id}}", "{{$office->area_id}}");

            let url = "{{route('traffic.users' , ':id')}}"
            url = url.replace(':id', "{{$office->id}}");
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        data.data.users.forEach(function (user) {
                            var option = `<option value ="${user.id}" >${user.email}</option>`;
                            $('.email-change').append(option);
                        });
                    }
                },
                error: function (reject) {
                    alert("{{__('message.something_wrong')}}");
                }
            });
        });

        $('.email-change').on('change', function () {
            let user_id = $('.email-change').val();
            let get_user_url = "{{route('traffic.user',[$office->id,':user'])}}";
            get_user_url = get_user_url.replace(':user', user_id);

            $.ajax({
                type: "Get",
                url: get_user_url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        $('.username').val(data.data.user.user_name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        });
    </script>
@endsection