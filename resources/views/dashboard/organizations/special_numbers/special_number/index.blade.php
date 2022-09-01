@extends('dashboard.layouts.standard')
@section('title','Mawatery | Special Numbers')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.special_numbers')}} <small
                                class="text-secondary">({{ $special_numbers->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.special_numbers')}}</li>
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
                                    data-target="#storeSpecialNumber">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.organizations.special_numbers.special_number.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.number')}}</th>
                                        <th>{{__('words.size')}}</th>
                                        <th>{{__('words.price')}}</th>
                                        <th>{{__('words.transfer_type')}}</th>
{{--                                        <th>{{__('words.Include_insurance')}}</th>--}}
                                        <th>{{__('words.available')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($special_numbers as $special_number)
                                        <tr class="text-center">
                                            <td>{{$special_number->number}}</td>
                                            <td>
                                                {{$special_number->size}}
                                            </td>
                                            <td>{{$special_number->price}}</td>
                                            <td>
                                                {{$special_number->transfer_type}}
                                            </td>
{{--                                            <td>{{$special_number->getIncludeInsurance()}}</td>--}}
                                            <td>{{$special_number->getAvailable()}}</td>
                                            <td>
                                                <button type="button" id="show_special_number"
                                                        class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editSpecialNumber"
                                                        onclick="get_special_number_category_data({{$special_number->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_special_number_category_data({{$special_number->id}})">
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
    @include('dashboard.organizations.special_numbers.special_number.update')
    @include('dashboard.organizations.special_numbers.special_number.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeSpecialNumber').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editSpecialNumber').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_special_number_category_data({{$error}});

        @endforeach
        @endif

        $('.main_category').on('change', function () {
            get_categories($(this).val());
        });

        function get_categories(arg, special_number_category_id = null){
            let url = "{{route('main-category' , ':main_category')}}"
            url = url.replace(':main_category', arg);

            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {

                        $('.special_number_category_id').empty();
                        let equal;
                        data.data.categories.forEach(function (category) {
                            equal = special_number_category_id == category.id ? "selected" : "";
                            var option = `<option value ="${category.id}" ${equal}>${category.name}</option>`;
                            $('.special_number_category_id').append(option);
                        });
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

        function get_special_number_category_data(id) {
            var url = "{{route('special-numbers.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        // console.log(data);
                        var main_category = data.data.main_category;
                        var old_main_category = "{{old('main_category','current')}}";
                        old_main_category = old_main_category.replace("current",main_category);
                        $('.main_category').val(old_main_category);

                        get_categories(data.data.main_category,data.data.show_special_number.special_number_category_id);
                        // console.log(get_categories(data.data.show_special_number.main_category));
                        var number = data.data.show_special_number.number;
                        var old_number = "{{old('number','current')}}";
                        old_number = old_number.replace("current",number);
                        $('#number').val(old_number);

                        var size = data.data.size;
                        var old_size = "{{old('size','current')}}";
                        old_size = old_size.replace("current",size);
                        $('#size').val(old_size);

                        var transfer_type = data.data.transfer_type;
                        var old_transfer_type = "{{old('transfer_type','current')}}";
                        old_transfer_type = old_transfer_type.replace("current",transfer_type);
                        $('#transfer_type').val(old_transfer_type);

                        var price = data.data.show_special_number.price;
                        var old_price = "{{old('price','current')}}";
                        old_price = old_price.replace("current",price);
                        $('#price').val(old_price);

                        var price_include_transfer = data.data.show_special_number.price_include_transfer;
                        var old_price_include_transfer = "{{old('price_include_transfer','current')}}";
                        old_price_include_transfer = old_price_include_transfer.replace("current",price_include_transfer);
                        $('#price_include_transfer').val(old_price_include_transfer);

                        var Include_insurance = data.data.show_special_number.Include_insurance;
                        var old_Include_insurance = "{{old('Include_insurance','current')}}";
                        old_Include_insurance = old_Include_insurance.replace("current",Include_insurance);
                        $('#Include_insurance').val(old_Include_insurance);

                        var special_number_organization_id = data.data.show_special_number.special_number_organization_id;
                        var old_special_number_organization_id = "{{old('special_number_organization_id','current')}}";
                        old_special_number_organization_id = old_special_number_organization_id.replace("current",special_number_organization_id);
                        $('#special_number_organization_id').val(old_special_number_organization_id);

                        if (data.data.show_special_number.user_id != null) {
                            $('#user_id').val(data.data.show_special_number.user.name);
                        }
                        if (data.data.show_special_number.availability == 1) {
                            $('#availability').prop('checked', true);
                        } else {
                            $('#availability').prop('checked', false);
                        }
                        $('#special_number_id').val(data.data.show_special_number.id);

                        let update = "{{route('special-numbers.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_special_number.id);

                        let destroy = "{{route('special-numbers.destroy', ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_special_number.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_special_number.number);
                    }
                    // alert(data);
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }



    </script>
@endsection

