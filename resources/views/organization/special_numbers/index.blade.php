@extends('organization.layouts.app')
@section('title','Mawatery | Special Numbers')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.special_numbers')}} <small
                                class="text-secondary">({{ $special_numbers->count() }}) >>> {{ $record->name }}</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a></li>
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
                            @include('organization.special_numbers.create')
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
                                                        onclick="get_special_number_data({{$special_number->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_special_number_data({{$special_number->id}})">
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
    @include('organization.special_numbers.update')
    @include('organization.special_numbers.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeSpecialNumber').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editSpecialNumber').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_special_number_data({{$error}});

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

        function get_special_number_data(id) {
            var url = "{{route('organization.special-numbers.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        // console.log(data);
                        $('.main_category').val(data.data.main_category);
                        get_categories(data.data.main_category,data.data.show_special_number.special_number_category_id);

                        $('#number').val(data.data.show_special_number.number);
                        $('#size').val(data.data.size);
                        $('#transfer_type').val(data.data.transfer_type);
                        $('#price').val(data.data.show_special_number.price);
                        $('#price_include_transfer').val(data.data.show_special_number.price_include_transfer);
                        $('#Include_insurance').val(data.data.show_special_number.Include_insurance);
                        $('#special_number_category_id').val(data.data.show_special_number.special_number_category_id);

                        if (data.data.show_special_number.availability == 1) {
                            $('#availability').prop('checked', true);
                        } else {
                            $('#availability').prop('checked', false);
                        }
                        $('#special_number_id').val(data.data.show_special_number.id);

                        let update = "{{route('organization.special-numbers.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_special_number.id);

                        let destroy = "{{route('organization.special-numbers.destroy', ':id')}}";
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

