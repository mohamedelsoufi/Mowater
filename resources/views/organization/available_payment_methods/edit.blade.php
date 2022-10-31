<!-- Modal -->
<div class="modal fade" id="editrental_law" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editrental_lawLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editrental_lawLabel">{{__('words.show_rental_law')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="rental_law_id" value="">
                
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-group col-md-12">
                                <label>{{__('words.title_en')}}</label>
                                <input id = "title_en" type="text" name="title_en" class="form-control @error('title_en') is-invalid @enderror" value="" placeholder="">
                                @error('title_en')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label>{{__('words.title_ar')}}</label>
                                <input  id = "title_ar" type="text" name="title_ar" class="form-control @error('title_ar') is-invalid @enderror" value="" placeholder="">
                                @error('title_ar')
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
