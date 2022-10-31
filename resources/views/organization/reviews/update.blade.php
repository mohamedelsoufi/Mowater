<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editReview" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editReviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editReviewLabel">{{__('words.show_review')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="review_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>{{__('words.created_at')}}</label>
                                    <input type="text" id="created_at" class="form-control" disabled>                         
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.user')}}</label>
                                    <input type="text" id="user_name" class="form-control" disabled>                         
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.rate')}}</label>
                                    <input type="text" id="rate" class="form-control" disabled>                         
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.review')}}</label>
                                    <textarea class = "form-control" id = "review" disabled></textarea>                     
                                </div>
                            </div>

                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger"
                                        data-dismiss="modal">{{__('words.close')}}
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
