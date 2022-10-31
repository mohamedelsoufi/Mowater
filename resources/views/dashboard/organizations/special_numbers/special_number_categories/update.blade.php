<!-- Modal -->
<div class="modal fade" id="editSpecialNumberCategory" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editSpecialNumberCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editSpecialNumberCategoryLabel">{{__('words.show_special_number_category')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="special_number_category_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.count_of_numbers')}}</label>
                                    <input type="number" name="numbers" id="name_en"
                                           class="form-control @error('numbers') is-invalid @enderror"
                                           value="{{ old('numbers') }}" placeholder="{{__('words.count_of_numbers')}}">

                                    @error('numbers')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.main_category')}}</label>
                                    <select name="main_category" id="main_category"
                                            class="form-control @error('main_category') is-invalid @enderror">
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
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="active" id="active">
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
                    <button type="submit" class="btn btn-outline-primary">{{__('words.update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
