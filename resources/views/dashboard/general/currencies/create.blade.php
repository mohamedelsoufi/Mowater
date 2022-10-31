<!-- Modal -->
<div class="modal fade" id="storeCurrency" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="storeCurrencyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="storeCurrencyLabel">{{__('words.new_currency')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('currencies.store')}}" id="store_form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.currency_name_en')}}</label>
                                    <input type="text" name="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           value="{{ old('name_en') }}" placeholder="Currency name">

                                    @error('color_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('words.currency_name_ar')}}</label>
                                    <input type="text" name="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                           value="{{ old('name_ar') }}" placeholder="إسم العملة">
                                    @error('name_ar')
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
                                            class="form-control @error('code') is-invalid @enderror">
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
                    <button type="submit" class="btn btn-outline-primary">{{__('words.create')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
