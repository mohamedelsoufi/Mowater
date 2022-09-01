@extends('dashboard.layouts.standard')
@section('title','Mawatery | Mawater Card')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.discount_cards')}} <small class="text-secondary">({{ $discount_cards->count() }})</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.discount_cards')}}</li>
                    </ol>
                </div>
                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#storeDiscountCard">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.general.discount_cards.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.image_s')}}</th>
                                        <th>{{__('words.title')}}</th>
                                        <th>{{__('words.year')}}</th>
                                        <th>{{__('words.price')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($discount_cards as $discount_card)
                                        <tr class="text-center">
                                            <td>
                                                @if(!$discount_card->image)
                                                    <a href="{{asset('uploads/default_image.png')}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{asset('uploads/default_image.png')}}" alt="image">
                                                    </a>
                                                @else
                                                    <a href="{{$discount_card->image}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$discount_card->image}}"
                                                             onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                             alt="image">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$discount_card->title}}</td>
                                            <td>{{$discount_card->year}}</td>
                                            <td>{{$discount_card->price}}</td>
                                            <td>{{$discount_card->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_discount_card" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editDiscountCard"
                                                        onclick="get_discount_card_data({{$discount_card->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_discount_card_data({{$discount_card->id}})">
                                                    {{__('words.delete')}}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('dashboard.general.discount_cards.update')
        @include('dashboard.general.discount_cards.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeDiscountCard').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editDiscountCard').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_discount_card_data({{$error}});

        @endforeach
        @endif

        function get_discount_card_data(id) {
            var url = "{{route('discount-cards.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {
                        var title_en = data.data.show_discount_card.title_en;
                        var old_title_en = "{{old('title_en','current')}}";
                        old_title_en = old_title_en.replace("current",title_en);
                        $('#title_en').val(old_title_en);

                        var title_ar = data.data.show_discount_card.title_ar;
                        var old_title_ar = "{{old('title_ar','current')}}";
                        old_title_ar = old_title_ar.replace("current",title_ar);
                        $('#title_ar').val(old_title_ar);

                        var status = data.data.show_discount_card.status;
                        var old_status = "{{old('status','current')}}";
                        old_status = old_status.replace("current",status);
                        $('#status').val(old_status);

                        {{--var description_ar = data.data.show_discount_card.description_ar;--}}
                        {{--var old_description_ar = "{{old('description_ar','current')}}";--}}
                        {{--old_description_ar = old_description_ar.replace("current",description_ar);--}}
                        CKEDITOR.instances.description_ar.setData(data.data.show_discount_card.description_ar);

                        CKEDITOR.instances.description_en.setData(data.data.show_discount_card.description_en);
                        $('#image').attr("src",data.data.show_discount_card.image);

                        if (data.data.show_discount_card.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }

                        var year = data.data.show_discount_card.year;
                        var old_year = "{{old('year','current')}}";
                        old_year = old_year.replace("current",year);
                        $('#year').val(old_year);

                        var price = data.data.show_discount_card.price;
                        var old_price = "{{old('price','current')}}";
                        old_price = old_price.replace("current",price);
                        $('#price').val(old_price);

                        $('#discount_card_id').val(data.data.show_discount_card.id);

                        let update = "{{route('discount-cards.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_discount_card.id);

                        let destroy = "{{route('discount-cards.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_discount_card.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_discount_card.title);


                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection

