<!-- Modal -->
<div class="modal fade" id="editColor" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editColorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editColorLabel">{{__('words.show_color')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="color_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.color_name')}}</label>
                                    <input type="text" name="color_name" id="color_name"
                                           class="form-control @error('color_name') is-invalid @enderror"
                                            placeholder="Color name" >

                                    @error('color_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('words.color_name_ar')}}</label>
                                    <input type="text" name="color_name_ar" id="color_name_ar"
                                           class="form-control @error('color_name_ar') is-invalid @enderror"
                                            placeholder="إسم اللون" >
                                    @error('color_name_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>{{__('words.color_code')}}</label>
                                    <input type="color" name="color_code" id="color_code"
                                           class="form-control @error('color_code') is-invalid @enderror"
                                           value="" placeholder="{{__('words.color_code')}}">

                                    @error('color_code')
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
