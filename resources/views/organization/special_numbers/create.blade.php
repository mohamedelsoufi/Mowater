<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="storeSpecialNumber" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="storeSpecialNumberLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="storeSpecialNumberLabel">{{__('words.new_special_number_category')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('organization.special-numbers.store')}}" id="store_form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.number')}}</label>
                                    <input type="text" name="number"
                                           class="form-control @error('number') is-invalid @enderror"
                                           value="{{ old('number') }}" placeholder="{{__('words.number')}}">

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.size')}}</label>
                                    <select name="size"
                                            class="form-control @error('size') is-invalid @enderror">
                                        <option value="">{{__('words.choose')}}</option>
                                        <option value="normal_plate">{{__('words.normal_plate')}}</option>
                                        <option value="special_plate">{{__('words.special_plate')}}</option>
                                    </select>
                                    @error('size')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.price')}}</label>
                                    <input type="text" name="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price') }}" placeholder="{{__('words.price')}}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
{{--                                <div class="form-group col-md-6">--}}
{{--                                    <label>{{__('words.Include_insurance')}}</label>--}}
{{--                                    <select name="Include_insurance"--}}
{{--                                            class="form-control @error('Include_insurance') is-invalid @enderror">--}}
{{--                                        <option value="">{{__('words.choose')}}</option>--}}
{{--                                        <option value="0">{{__('vehicle.no')}}</option>--}}
{{--                                        <option value="1">{{__('vehicle.yes')}}</option>--}}
{{--                                    </select>--}}
{{--                                    @error('Include_insurance')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

                                <div class="form-group col-md-6">
                                    <label>{{__('words.price_include_transfer')}}</label>
                                    <select name="price_include_transfer"
                                            class="form-control @error('price_include_transfer') is-invalid @enderror">
                                        <option value="">{{__('words.choose')}}</option>
                                        <option value="0">{{__('vehicle.no')}}</option>
                                        <option value="1">{{__('vehicle.yes')}}</option>
                                    </select>
                                    @error('price_include_transfer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.transfer_type')}}</label>
                                    <select name="transfer_type"
                                            class="form-control @error('transfer_type') is-invalid @enderror">
                                        <option value="">{{__('words.choose')}}</option>
                                        <option value="waiver">{{__('words.waiver')}}</option>
                                        <option value="own">{{__('words.own')}}</option>
                                    </select>
                                    @error('transfer_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.main_category')}}</label>
                                    <select name="main_category"
                                            class="form-control main_category @error('main_category') is-invalid @enderror">
                                        <option value="">{{__('words.choose')}}</option>
                                        @foreach(special_number_main_category_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('main_category')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.special_numbers_category')}}</label>
                                    <select name="special_number_category_id"
                                            class="form-control special_number_category_id @error('special_number_category_id') is-invalid @enderror">
                                    </select>
                                    @error('special_number_category_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="availability" value="0" type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.available_prop')}}
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
