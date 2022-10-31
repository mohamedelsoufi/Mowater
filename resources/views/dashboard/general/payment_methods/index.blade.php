@extends('dashboard.layouts.standard')
@section('title','Mawatery | Payment Methods')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.payment_methods')}} <small
                                class="text-secondary">({{ $payment_methods->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.payment_methods')}}</li>
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
                            <button type="button" class="btn btn-primary" id="create" data-toggle="modal"
                                    data-target="#storePaymentMethod">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.general.payment_methods.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($payment_methods as $payment_method)
                                        <tr class="text-center">
                                            <td>{{$payment_method->name_en}}</td>
                                            <td>{{$payment_method->name_ar}}</td>
                                            <td>
                                                <button type="button" id="show_brand" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editPaymentMethod"
                                                        onclick="get_payment_data({{$payment_method->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_payment_data({{$payment_method->id}})">
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
    @include('dashboard.general.payment_methods.update')
    @include('dashboard.general.payment_methods.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storePaymentMethod').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editPaymentMethod').modal('show');
            @foreach ($errors->get('update_modal') as $error)
                {{--console.log({{ $error }});--}}
                get_payment_data({{$error}});
            @endforeach
        @endif

        function get_payment_data(id) {
            var url = "{{route('payment-methods.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        // console.log(data);

                        var name_en = data.data.show_payment_method.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_payment_method.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_en').val(old_name_ar);

                        $('#payment_method_id').val(data.data.show_payment_method.id);

                        let update = "{{route('payment-methods.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_payment_method.id);

                        let destroy = "{{route('payment-methods.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_payment_method.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_payment_method.name);
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

