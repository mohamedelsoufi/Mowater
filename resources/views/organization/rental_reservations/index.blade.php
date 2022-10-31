@extends('organization.layouts.app')
@section('title','Mawatery | Rental Reservations')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.rental_reservations')}}  <small class="text-secondary">({{ $rental_reservations->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.rental_reservations')}}</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storerental_reservation">{{__('words.create')}}
                            </button>
                            @include('organization.rental_reservations.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.created_at')}}</th>
                                        <th>{{__('words.user_data')}}</th>
                                        <th>{{__('words.rental_type')}}</th>
                                        <th>{{__('words.rental_car')}}</th>
                                        <th>{{__('words.status')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($rental_reservations as $rental_reservation)
                                        <tr class="text-center">
                                            <td>{{$rental_reservation->created_at}}</td>
                                            <td>{{$rental_reservation->name }} <br> {{$rental_reservation->phone }} <br> {{$rental_reservation->address }}</td>
                                            <td>{{__('words.' . $rental_reservation->rental_type)}}</td>
                                           
                                            <td>{{$rental_reservation->car_name}}</td>
                                            <td>{{__('words.' . $rental_reservation->status)}}</td>
                                            <td>
                                                <a href = "{{route('organization.rental_reservation.show' , $rental_reservation->id)}}" type="button" class="btn btn-outline-info">{{__('words.show')}}</a>

                                                {{-- <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalDelete" onclick="get_rental_reservation_data({{$rental_reservation->id}})">{{__('words.delete')}} </button> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.rental_reservations.edit')
                                @include('organization.rental_reservations.delete')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
   
<script type="text/javascript">

    @if(count($errors) > 0 && !$errors->has('update_modal'))
    $('#storerental_reservation').modal('show');

    @elseif($errors->has('update_modal'))
    $('#editrental_reservation').modal('show');
    @foreach ($errors->get('update_modal') as $error)
    {{--console.log({{ $error }});--}}
    get_rental_reservation_data({{$error}});

    @endforeach
    @endif

    function get_rental_reservation_data(id) {
        var url = "{{route('organization.rental_reservation.show' , ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: "Get",
            url: url,
            datatype: 'JSON',
            success: function (data) {
                if (data.status == true) {
                    console.log(data);
                    $('#title_en').val(data.data.rental_reservation.title_en);
                    $('#title_ar').val(data.data.rental_reservation.title_ar);
                    $('#rental_reservation_id').val(data.data.rental_reservation.id);
                    
                    let update = "{{route('organization.rental_reservation.update' , ':id')}}";
                    update = update.replace(':id', data.data.rental_reservation.id);

                    let destroy = "{{route('organization.rental_reservation.destroy' , ':id')}}";
                    destroy = destroy.replace(':id', data.data.rental_reservation.id);
                    $('#update_form').attr('action', update);
                    $('#delete_form').attr('action', destroy);
                    $('#text_meesage').text(data.data.rental_reservation.title);
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

