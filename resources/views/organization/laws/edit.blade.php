<!-- Modal -->
<div class="modal fade" id="editlaw" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editlawLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-law text-primary" id="editlawLabel">{{__('words.show_law')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="law_id" value="">
                
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-group col-md-12">
                                <label>{{__('words.title_en')}}</label>
                                <input id = "law_en" type="text" name="law_en" class="form-control @error('law_en') is-invalid @enderror" value="" placeholder="">
                                @error('law_en')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{__('words.title_ar')}}</label>
                                <input  id = "law_ar" type="text" name="law_ar" class="form-control @error('law_ar') is-invalid @enderror" value="" placeholder="">
                                @error('law_ar')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
