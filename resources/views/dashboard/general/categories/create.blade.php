<!-- Modal -->
<div class="modal fade" id="storeCategory" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="storeCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="storeCategoryLabel">{{__('words.new_category')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('categories.store')}}" id="store_form" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_en')}}</label>
                                    <input type="text" name="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           value="{{ old('name_en') }}" placeholder="Category name">

                                    @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('words.name_ar')}}</label>
                                    <input type="text" name="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                           value="{{ old('name_ar') }}" placeholder="إسم القائمة">
                                    @error('name_ar')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{__('words.section')}}</label>
                                    <select id="inputState" name="section_id"
                                            class="form-control @error('section_id') is-invalid @enderror"
                                            value="{{ old('section_id') }}">
                                        <option value="" selected>{{__('words.choose')}}</option>
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

                                <div class="form-group col-md-6">
                                    <label>{{__('words.ref_name_category')}}</label>
                                    <select name="ref_name" class="form-control @error('ref_name') is-invalid @enderror">
                                        <option value="" selected>{{__('words.choose')}}</option>
                                        <option value="products" {{old('ref_name') == 'products' ? 'selected' : ''}} >{{__('words.products')}}</option>
                                        <option value="services" {{old('ref_name') == 'services' ? 'selected' : ''}} >{{__('words.services')}}</option>
                                    </select>
                                    @error('ref_name')
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
