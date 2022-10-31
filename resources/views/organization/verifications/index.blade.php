@extends('organization.layouts.app')
@section('title','Mawatery | Verifications')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>
                        </h4>
                        <h4>{{__('words.verifications')}} <small
                                class="text-secondary">({{$verifications->count()}}) >>> {{$record->name}}</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.verifications')}}</li>
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
                                        <th>{{__('words.number')}}</th>
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.status')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($verifications as $verification)
                                        <tr class="text-center">
                                            <td>{{$verification->model->number}}</td>
                                            <td>{{$verification->user->name}}</td>
                                            <td>
                                                @if($verification->status == 'pending')
                                                    {{__('words.pending')}}
                                                @elseif($verification->status == 'available')
                                                    {{__('words.available_prop')}}
                                                @elseif($verification->status == 'not_available')
                                                    {{__('words.not_available_prop')}}
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" id="show_verification"
                                                        class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editVerification"
                                                        onclick="get_verification_data({{$verification->id}})">
                                                    {{__('words.show')}}
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
    @include('organization.verifications.update')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if($errors->has('update_modal'))
        $('#editVerification').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        console.log({{ $error }});
        get_verification_data({{$error}});

        @endforeach
        @endif

        function get_verification_data(id) {
            var url = "{{route('organization.verifications.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {
                        $('#number').text(data.data.show_verification.model.number);
                        if (data.data.show_verification.model.size == 'normal_plate') {
                            $('#size').text("{{__('words.normal_plate')}}");
                        } else if(data.data.show_verification.model.size == 'special_plate') {
                            $('#size').text("{{__('words.special_plate')}}");
                        }

                        if (data.data.show_verification.model.transfer_type == 'waiver') {
                            $('#transfer_type').text("{{__('words.waiver')}}");
                        } else if(data.data.show_verification.model.transfer_type == 'own') {
                            $('#transfer_type').text("{{__('words.own')}}");
                        }
                        $('#price').text(data.data.show_verification.model.price);

                        if (data.data.show_verification.model.Include_insurance == 1) {
                            $('#Include_insurance').text("{{__('vehicle.yes')}}");
                        } else {
                            $('#Include_insurance').text("{{__('vehicle.no')}}");
                        }

                        if (data.data.show_verification.model.availability == 1) {
                            $('#availability').prop('checked', true);
                        } else {
                            $('#availability').prop('checked', false);
                        }

                        $('#status').val(data.data.show_verification.status);

                        if($('#status').val() === 'pending'){
                            $('#status').prop('disabled', false);
                        }else{
                            $('#status').prop('disabled', true);
                        }



                        $('#name').text(data.data.show_verification.user.name);
                        $('#phone').text(data.data.show_verification.user.phone);
                        $('#email').text(data.data.show_verification.user.email);

                        $('#verification_id').val(data.data.show_verification.id);

                        let update = "{{route('organization.verifications.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_verification.id);

                        $('#update_form').attr('action', update);

                        $('#text_meesage').text(data.data.show_verification.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection

