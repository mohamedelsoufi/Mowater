<!-- Modal -->
<div class="modal fade" id="storeavailable_payment_method" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="storeavailable_payment_methodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="storeavailable_payment_methodLabel">{{__('words.new_available_payment_method')}} <i class="fas fa-solid fa-money-bill"></i></h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('organization.available_payment_method.store')}}" id="store_form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label>{{__('words.available_payment_methods')}}</label>
                                    <select name="available_payment_methods[]" class = "select2 form-control" multiple>
                                        @foreach($payment_methods as $payment_method)
                                        <option value="{{$payment_method->id}}" {{ in_array($payment_method->id , $available_payment_methods->pluck('id')->toArray()) ? 'selected'  :'' }} >{{$payment_method->name}}</option>
                                        @endforeach
                                    </select>
                                   
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
