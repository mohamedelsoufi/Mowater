<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editSpecialNumber" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editSpecialNumberLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editSpecialNumberLabel">{{__('words.show_special_number')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="special_number_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.number')}}</label>
                                    <input type="text" name="number" id="number"
                                           class="form-control @error('number') is-invalid @enderror"
                                           placeholder="{{__('words.number')}}">

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.size')}}</label>
                                    <select name="size" id="size"
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
                                    <input type="text" name="price" id="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           placeholder="{{__('words.price')}}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
{{--                                <div class="form-group col-md-4">--}}
{{--                                    <label>{{__('words.Include_insurance')}}</label>--}}
{{--                                    <select name="Include_insurance" id="Include_insurance"--}}
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
                                <div class="form-group col-md-4">
                                    <label>{{__('words.price_include_transfer')}}</label>
                                    <select name="price_include_transfer" id="price_include_transfer"
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

                                <div class="form-group col-md-4">
                                    <label>{{__('words.transfer_type')}}</label>
                                    <select name="transfer_type" id="transfer_type"
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

                                <div class="form-group col-md-4">
                                    <label>{{__('words.user')}}</label>
                                    <input type="text" name="user_id" id="user_id" disabled
                                           class="form-control bg-info @error('price') is-invalid @enderror">
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
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

                                <div class="form-group col-md-4">
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


                                <div class="form-group col-md-4">
                                    <label>{{__('words.special_numbers_organization')}}</label>
                                    <select name="special_number_organization_id" id="special_number_organization_id"
                                            class="form-control @error('special_number_organization_id') is-invalid @enderror">
                                        <option value="">{{__('words.choose')}}</option>
                                        @foreach($special_number_organizations as $special_number_organization)
                                            <option value="{{$special_number_organization->id}}">{{$special_number_organization->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('special_number_organization_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="availability" id="availability" value="0" type="checkbox">
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
                    <button type="submit" class="btn btn-outline-primary">{{__('words.update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
