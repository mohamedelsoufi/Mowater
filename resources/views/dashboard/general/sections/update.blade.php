<!-- Modal -->
<div class="modal fade" id="editSection" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editSectionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editSectionLabel">{{__('words.show_section')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_en')}}</label>
                                    <input type="text" name="name_en" id="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           placeholder="Section name">

                                    @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_ar')}}</label>
                                    <input type="text" name="name_ar" id="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                           placeholder="إسم القسم">
                                    @error('name_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.reservation_cost_type')}}</label>
                                    <select id="reservation_cost_type" name="reservation_cost_type"
                                            class="form-control @error('reservation_cost_type') is-invalid @enderror">
                                        <option value="amount">Amount</option>
                                        <option value="discount">Discount</option>
                                    </select>
                                    @error('reservation_cost_type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group d-none reservation_cost col-md-6">
                                    <label>{{__('words.reservation_cost')}}</label>
                                    <input type="text" name="reservation_cost" id="reservation_cost"
                                           class="form-control @error('reservation_cost') is-invalid @enderror"
                                           placeholder="تكلفة الحجز">
                                    @error('reservation_cost')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 d-none hour_price">
                                    <label>{{__('words.hour_price')}}</label>
                                    <input type="text" name="reservation_cost" id="hour_price"
                                           class="form-control @error('reservation_cost') is-invalid @enderror"
                                           placeholder="{{__('words.hour_price')}}">
                                    @error('reservation_cost')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.section_parent')}}</label>
                                    <select id="section_id" name="section_id"
                                            class="form-control @error('section_id') is-invalid @enderror">
                                        <option
                                            value="">{{__('words.none')}}</option>
                                        @foreach($sections as $section)
                                            <option
                                                value="{{$section->id}}">{{$section->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.logo')}}</label>
                                    <input type="file" name="image"
                                           class="form-control image @error('image') is-invalid @enderror"
                                           placeholder="{{__('words.image')}}">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6 text-center pt-3">
                                    <img src="{{ asset('uploads/default_image.png') }}" id="image"
                                         class="slider_image image-preview" alt="image">
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
