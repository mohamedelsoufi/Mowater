<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="storeAd" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="storeAdLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="storeAdLabel">{{__('words.new_ad')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('organization.ads.store')}}" id="store_form" autocomplete="off"
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
                                           value="{{ old('title_ar') }}" placeholder="{{__('words.title_ar')}}">
                                    @error('title_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.title_en')}}</label>
                                    <input type="text" name="title_en"
                                           class="form-control @error('title_en') is-invalid @enderror"
                                           value="{{ old('title_en') }}" placeholder="{{__('words.title_en')}}">

                                    @error('title_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.description_ar')}}</label>
                                    <textarea name="description_ar"
                                              class="form-control ckeditor @error('description_ar') is-invalid @enderror">{{ old('description_ar') }}</textarea>

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
                                    <textarea name="description_en"
                                              class="form-control ckeditor @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>

                                    @error('description_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.images')}}</label>
                                    <input type="file" name="images[]" id="files"
                                           class="form-control image @error('images') is-invalid @enderror"
                                           placeholder="{{__('words.images')}}" multiple>
                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <output id='result' class="row"/>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.ad_type')}}</label>
                                    <select name="ad_type_id"
                                            class="form-control ad_type_id @error('ad_type_id') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        @foreach($ad_types as $ad_type)
                                            <option
                                                value="{{$ad_type->id}}">{{$ad_type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ad_type_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.negotiable')}}</label>
                                    <select name="negotiable"
                                            class="form-control @error('negotiable') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        <option
                                            value="1">{{__('words.accepted')}}
                                        </option>
                                        <option
                                            value="0">{{__('words.not_accepted')}}
                                        </option>
                                    </select>
                                    @error('negotiable')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.price')}}</label>
                                    <input type="text" name="price" value="{{old('price')}}"
                                           class="form-control @error('price') is-invalid @enderror"
                                           placeholder="{{__('words.price')}}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                    @enderror
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>{{__('words.country')}}</label>
                                        <select name="country_id"
                                                class="form-control country_id @error('country_id') is-invalid @enderror">
                                            {{--                                                <option value="" selected>{{__('words.choose')}}</option>--}}
                                            @foreach($countries as $country)
                                                <option
                                                    value="{{$country->id}}">{{$country->name}}</option>
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
                                            @foreach($cities as $city)

                                                <option
                                                    value="{{$city->id}}">{{$city->name}}</option>
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
                                            @foreach($areas as $area)

                                                <option
                                                    value="{{$area->id}}">{{$area->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('area_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="available" name="available" value=""
                                               type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.activity')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">

                        <a href="{{route('organization.ads.index')}}"
                           class="btn btn-outline-danger">{{__('words.close')}}</a>
                        <button type="submit" class="btn btn-outline-primary">{{__('words.create')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
