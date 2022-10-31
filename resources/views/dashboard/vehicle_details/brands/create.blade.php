<!-- Modal -->
<div class="modal fade" id="storeBrand" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="storeBrandLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="storeBrandLabel">{{__('words.new_brand')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('brands.store')}}" id="store_form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_en')}}</label>
                                    <input type="text" name="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           value="{{ old('name_en') }}" placeholder="Brand name">

                                    @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_ar')}}</label>
                                    <input type="text" name="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                           value="{{ old('name_ar') }}" placeholder="إسم البراند">
                                    @error('name_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.country')}}</label>
                                    <select id="inputState" name="manufacture_country_id"
                                            class="form-control @error('manufacture_country_id') is-invalid @enderror"
                                            value="{{ old('manufacture_country_id') }}">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        @foreach($countries as $manufacture_country)
                                            <option
                                                value="{{$manufacture_country->id}}">{{$manufacture_country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('manufacture_country_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="active" value="0" type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.activity')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{__('words.close')}}
                    </button>
                    <button type="submit" class="btn btn-outline-primary">{{__('words.create')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
