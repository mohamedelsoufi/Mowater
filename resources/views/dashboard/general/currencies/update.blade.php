<!-- Modal -->
<div class="modal fade" id="editCurrency" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editCurrencyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editCurrencyLabel">{{__('words.show_currency')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="currency_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.currency_name_en')}}</label>
                                    <input type="text" name="name_en" id="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                            placeholder="Currency name" >

                                    @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('words.currency_name_ar')}}</label>
                                    <input type="text" name="name_ar" id="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                            placeholder="إسم العملة" >
                                    @error('color_name_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.currency_code')}}</label>
                                    <select name="code" id="single-select"
                                            class="form-control code @error('code') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        @foreach(currency_code_arr() as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>

                                    @error('code')
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
