<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="editUser" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="editUserLabel">{{__('words.edit_user')}} </h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="update_form" autocomplete="off" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" name="id" id="user_id" value="">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.email')}}</label>
                                    <input type="email" name="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" placeholder="{{__('words.email')}}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.name')}}</label>
                                    <input type="text" name="name" id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" placeholder="{{__('words.name')}}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.password')}}</label>
                                    <input type="password" name="password" autocomplete="new-password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           value="{{ old('password') }}" placeholder="{{__('words.password')}}">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{__('words.confirm_password')}}</label>
                                    <input type="password" name="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           value="{{ old('password_confirmation') }}"
                                           placeholder="{{__('words.confirm_password')}}">

                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

{{--                            <div class="form-row">--}}
{{--                                <div class="form-group col-md-4">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" id="active" name="active" value="0" type="checkbox">--}}
{{--                                        <label class="form-check-label">--}}
{{--                                            {{__('words.activity')}}--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
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
