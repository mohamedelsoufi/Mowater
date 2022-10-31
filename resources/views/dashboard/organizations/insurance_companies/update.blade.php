<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editinsurance_company" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editinsurance_companyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editinsurance_companyLabel">{{__('words.show_insurance_company')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="insurance_company_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_ar')}}</label>
                                    <input type="text" name="name_ar" id="name_ar" class="form-control @error('name_ar') is-invalid @enderror" placeholder="{{__('words.name_ar')}}">

                                    @error('name_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_en')}}</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control @error('name_en') is-invalid @enderror" placeholder="{{__('words.name_en')}}">

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
                                    <textarea name="description_ar" id="description_ar" class="form-control ckeditor @error('description_ar') is-invalid @enderror"></textarea>

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
                                    <textarea name="description_en" id="description_en" class="form-control ckeditor @error('description_en') is-invalid @enderror"></textarea>

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
                                    <input type="file" name="logo" class="form-control image @error('logo') is-invalid @enderror" placeholder="{{__('words.logo')}}">
                                    @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6 text-center pt-3">
                                    <img src="{{ asset('uploads/default_image.png') }}" id="logo" class="slider_image image-preview" alt="logo">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.tax_number')}}</label>
                                    <input type="text" name="tax_number" id="tax_number" class="form-control @error('tax_number') is-invalid @enderror" placeholder="{{__('words.tax_number')}}">
                                    @error('tax_number')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.year_founded')}}</label>
                                    <input type="text" name="year_founded" id="year_founded" class="yearpicker form-control @error('year_founded') is-invalid @enderror" placeholder="{{__('words.year_founded')}}">

                                    @error('year_founded')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.country')}}</label>
                                    <select name="country_id" class="form-control country_id @error('country_id') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
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
                                        <input class="form-check-input" id="active" name="active" value="0" type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.activity')}}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="reservation_active" name="reservation_active" value="0" type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.reservation_active')}}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="delivery_active" name="delivery_active" value="0" type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.delivery_active')}}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Organization user start --}}
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('words.email')}}</label>
                                    <select name="organization_user_id"
                                            class="form-control email-change @error('email') is-invalid @enderror">
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
                                           value="{{ old('user_name') }}" placeholder="{{__('words.user_name')}}">

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
                                           value="{{ old('password') }}" placeholder="{{__('words.password')}}">

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
                                           value="{{ old('password_confirmation') }}" placeholder="{{__('words.confirm_password')}}">

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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{__('words.close')}}
                    </button>
                    <button type="submit" class="btn btn-outline-primary">{{__('words.update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
