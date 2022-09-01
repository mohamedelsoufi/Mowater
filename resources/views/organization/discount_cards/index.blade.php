@extends('organization.layouts.app')
@section('title','Mawatery | Mawater Card')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.discount_cards')}}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item">{{__('words.discount_cards')}}
                        </li>
                    </ol>
                </div>
                @include('organization.includes.alerts.success')
                @include('organization.includes.alerts.errors')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- create modal start --}}
                        <div class="card-header">

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead class="text-dark">
                                    <tr class="text-center">
                                        <th>{{__('words.image_s')}}</th>
                                        <th>{{__('words.title')}}</th>
                                        <th>{{__('words.year')}}</th>
                                        <th>{{__('words.price')}}</th>
                                        <th>{{__('words.status')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($discount_cards as $discount_card)
                                        <tr class="text-center">
                                            <td>
                                                <a href="{{$discount_card->image}}"
                                                   data-toggle="lightbox">
                                                    <img class="slider_image"
                                                         src="{{$discount_card->image}}"
                                                         onerror="this.src='{{asset('uploads/default_image.png')}}'"
                                                         alt="logo">
                                                </a>

                                            </td>
                                            <td>{{$discount_card->title}}</td>
                                            <td>{{$discount_card->year}}</td>
                                            <td>{{$discount_card->price}}</td>
                                            <td>
                                                @foreach(discount_card_status_arr() as $key=>$val)
                                                    @if($discount_card->status === $key)
                                                        {{$val}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($discount_card->status == 'finished')
                                                    <button type="button" class="btn btn-outline-info">
                                                        <a href="{{route('organization.discount-cards.show_offer',$discount_card->id)}}">{{__('words.show')}}</a>
                                                    </button>
                                                @elseif($record->discount_cards()->where('discount_card_id',$discount_card->id)->first())
                                                    <button type="button" class="btn btn-outline-info">
                                                        <a href="{{route('organization.discount-cards.show_offer',$discount_card->id)}}">{{__('words.show')}}</a>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-outline-success"
                                                            data-toggle="modal"
                                                            data-target="#ModalSubscribe"
                                                            onclick="get_discount_card_data({{$discount_card->id}})">
                                                        {{__('words.subscribe')}}
                                                    </button>
                                                @endif
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
    @include('organization.discount_cards.subscribe')
@endsection

@section('scripts')
    <script type="text/javascript">
        function get_discount_card_data(id) {
            var url = "{{route('organization.discount-cards.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        console.log(data);
                        let subscribe = "{{route('organization.discount-cards.subscribe' , ':id')}}";
                        subscribe = subscribe.replace(':id', data.data.show_discount_card.id);
                        $('#subscribe_form').attr('action', subscribe);

                        $('#text_meesage').text(data.data.show_discount_card.title);
                        $('#discount_card_id').val(data.data.show_discount_card.id);
                    }
                }
            });
        }
    </script>

@endsection

