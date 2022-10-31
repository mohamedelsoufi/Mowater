<!-- Modal -->
<div class="modal fade" id="storelaw" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="storelawLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="storelawLabel">{{__('words.new_law')}} <i class="fas fa-solid fa-gavel"></i></h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('organization.law.store')}}" id="store_form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label>{{__('words.title_en')}}</label>
                                    <input type="text" name="law_en" class="form-control @error('law_en') is-invalid @enderror" value="{{ old('law_en') }}" placeholder="">
                                    @error('law_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>{{__('words.title_ar')}}</label>
                                    <input type="text" name="law_ar" class="form-control @error('law_ar') is-invalid @enderror" value="{{ old('law_ar') }}" placeholder="">
                                    @error('law_ar')
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
