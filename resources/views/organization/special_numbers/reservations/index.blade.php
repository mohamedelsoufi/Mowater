@extends('organization.layouts.app')
@section('title','Mawatery | Special Number Reservation')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.special_number_reservations')}} <small
                                class="text-secondary"></small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item">{{__('words.special_numbers')}}</li>
                        <li class="breadcrumb-item active">{{__('words.special_number_reservations')}}</li>
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
{{--                            {!! $reservations !!}--}}
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.special_number')}}</th>
                                        <th>{{__('words.user_name')}}</th>
                                        <th>{{__('words.phone')}}</th>
                                        <th>{{__('words.status')}}</th>
                                        <th>{{__('words.reservation_time')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($reservations as $reservation)
                                            <tr class="text-center">
                                                <td>{{$reservation->special_number->number}}</td>
                                                <td>{{$reservation->name}}</td>
                                                <td>{{$reservation->phone}}</td>
                                                <td>
                                                    @if($reservation->status == 'pending')
                                                        {{__('words.pending')}}
                                                    @elseif($reservation->status == 'approved')
                                                        {{__('words.approved')}}
                                                    @elseif($reservation->status == 'rejected')
                                                        {{__('words.rejected')}}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ date('l d-m-Y', strtotime($reservation->created_at)) }}<br>
                                                    {{ date('h:i A', strtotime($reservation->created_at)) }}
                                                </td>
                                                <td>
                                                    <button type="button" id="show_reservation"
                                                            class="btn btn-outline-info"
                                                            data-toggle="modal"
                                                            data-target="#editSpecialNumberReservation"
                                                            onclick="get_resrvation_data({{$reservation->id}})">
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
    @include('organization.special_numbers.reservations.update')
@endsection

@section('scripts')
    <script type="text/javascript">

        function get_resrvation_data(id) {
            var url = "{{route('organization.show-special-number-reservations' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        // console.log(data);
                        $('#number').text(data.data.show_reservation.special_number.number);

                        if (data.data.show_reservation.special_number.size == 'normal_plate') {
                            $('#size').text("{{__('words.normal_plate')}}");
                        } else if(data.data.show_reservation.special_number.size == 'special_plate') {
                            $('#size').text("{{__('words.special_plate')}}");
                        }

                        if (data.data.show_reservation.special_number.transfer_type == 'waiver') {
                            $('#transfer_type').text("{{__('words.waiver')}}");
                        } else if(data.data.show_reservation.special_number.transfer_type == 'own') {
                            $('#transfer_type').text("{{__('words.own')}}");
                        }

                        $('#price').text(data.data.show_reservation.special_number.price);
                        if (data.data.show_reservation.special_number.Include_insurance == 1) {
                            $('#Include_insurance').text("{{__('vehicle.yes')}}");
                        } else {
                            $('#Include_insurance').text("{{__('vehicle.no')}}");
                        }

                        $('#email').text(data.data.show_reservation.user.email);
                        $('#name').text(data.data.show_reservation.name);
                        $('#phone').text(data.data.show_reservation.phone);
                        $('#address').text(data.data.show_reservation.address);
                        $('#status').val(data.data.show_reservation.status);

                        if($('#status').val() === 'pending'){
                            $('#status').prop('disabled', false);
                        }else{
                            $('#status').prop('disabled', true);
                        }

                        if (data.data.show_reservation.special_number.availability == 1) {
                            $('#availability').prop('checked', true);
                        } else {
                            $('#availability').prop('checked', false);
                        }
                        $('#reservation_id').val(data.data.show_reservation.id);

                        let update = "{{route('organization.update-special-number-reservations' , ':id')}}";
                        update = update.replace(':id', data.data.show_reservation.id);

                        $('#update_form').attr('action', update);

                        $('#text_meesage').text(data.data.show_reservation.number);
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



