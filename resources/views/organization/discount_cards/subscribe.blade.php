<!-- Modal -->
<div class="modal fade" id="ModalSubscribe" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="SubscribeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="SubscribeLabel">{{__('words.subscribe')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="subscribe_form" autocomplete="off">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <input type="hidden" name="id" id="discount_card_id" value="">
                            <span>{{__('message.subscribe_message')}} <b class="text-danger" id="text_meesage"></b></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">{{__('words.close')}}
                    </button>
                    <button type="submit" class="btn btn-outline-success">{{__('words.subscribe')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>




