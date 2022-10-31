<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editDiscountCard" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editDiscountCardLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editDiscountCardLabel">{{__('words.show_discount_card')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="discount_card_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.title_ar')}}</label>
                                    <input type="text" name="title_ar" id="title_ar"
                                           class="form-control @error('title_ar') is-invalid @enderror"
                                           placeholder="{{__('words.title_ar')}}">
                                    @error('title_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.title_en')}}</label>
                                    <input type="text" name="title_en" id="title_en"
                                           class="form-control @error('title_en') is-invalid @enderror"
                                           placeholder="{{__('words.title_en')}}">

                                    @error('title_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.description_ar')}}</label>
                                    <textarea name="description_ar" id="description_ar"
                                              class="form-control ckeditor @error('description_ar') is-invalid @enderror"></textarea>

                                    @error('description_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="form-group col-md-12">
                                    <label>{{__('words.description_en')}}</label>
                                    <textarea name="description_en" id="description_en"
                                              class="form-control ckeditor @error('description_en') is-invalid @enderror"></textarea>

                                    @error('description_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.image_s')}}</label>
                                    <input type="file" name="image"
                                           class="form-control image @error('image') is-invalid @enderror"
                                           placeholder="{{__('words.image_s')}}">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6 text-center pt-3">
                                    <img src="{{ asset('uploads/default_image.png') }}" id="image"
                                         class="slider_image image-preview" alt="logo">
                                </div>
                            </div>

                            <div class="form-row  mb-3">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.price')}}</label>
                                    <input type="number" name="price" step="0.01" min="0" id="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price') }}" placeholder="{{__('words.price')}}">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.year')}}</label>
                                    <input type="number" name="year" id="year"
                                           class="yearpicker form-control @error('year') is-invalid @enderror"
                                           value="{{ old('year') }}" placeholder="">

                                    @error('year')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{__('words.status')}}</label>
                                    <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                        @foreach(discount_card_status_arr() as $key=>$value)
                                            <option
                                                {{ old('status') == $key ? "selected" : "" }} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" id="active" name="active" value="0" type="checkbox">
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
