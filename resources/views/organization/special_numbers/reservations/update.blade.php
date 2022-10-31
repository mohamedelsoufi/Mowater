<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editSpecialNumberReservation" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editSpecialNumberLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editSpecialNumberLabel">{{__('words.show_reservation')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
{{--                @method('put')--}}
                @csrf
                <input type="hidden" name="id" id="reservation_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <h6 class="text-primary">{{__('words.special_number_data')}}</h6>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('words.number')}}</label>
                                    <p id="number" class="text-dark"></p>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('words.size')}}</label>
                                    <p id="size" class="text-dark"></p>
                                </div>

{{--                                <div class="form-group col-md-3">--}}
{{--                                    <label>{{__('words.Include_insurance')}}</label>--}}
{{--                                    <p id="Include_insurance" class="text-dark"></p>--}}
{{--                                </div>--}}

                                <div class="form-group col-md-3">
                                    <label>{{__('words.transfer_type')}}</label>
                                    <p id="transfer_type" class="text-dark"></p>
                                </div>
                            </div>

                            <h6 class="text-primary">{{__('words.user_data')}}</h6>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>{{__('words.email')}}</label>
                                    <p id="email" class="text-dark"></p>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('words.name')}}</label>
                                    <p id="name" class="text-dark"></p>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('words.phone')}}</label>
                                    <p id="phone" class="text-dark"></p>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>{{__('words.address')}}</label>
                                    <p id="address" class="text-dark"></p>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" disabled name="availability" id="availability" value="0" type="checkbox">
                                        <label class="form-check-label">
                                            {{__('words.available_prop')}}
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.status')}}</label>
                                    <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                        <option value="">{{__('words.choose')}}</option>
                                        <option value="pending">{{__('words.pending')}}</option>
                                        <option value="approved">{{__('words.approved')}}</option>
                                        <option value="rejected">{{__('words.rejected')}}</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
