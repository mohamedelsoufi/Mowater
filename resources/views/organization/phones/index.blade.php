@extends('organization.layouts.app')
@section('title','Mawatery | phones')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.phones')}}  <small class="text-secondary">({{ $phones->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.phones')}}</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storePhone">{{__('words.create')}}
                            </button>
                            @include('organization.phones.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.phone')}}</th>
                                        <th>{{__('words.phone_title')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($phones as $phone)
                                        <tr class="text-center">
                                            <td dir="ltr">{{$phone->country_code . '-' . $phone->phone}}</td>
                                            <td>{{$phone->title}}</td>

                                            <td>
                                                <button type="button" id="show_phones" class="btn btn-outline-info" data-toggle="modal" data-target="#editPhone" onclick="get_phone_data({{$phone->id}})">{{__('words.show')}}</button>

                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalDelete" onclick="get_phone_data({{$phone->id}})">{{__('words.delete')}} </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.phones.edit')
                                @include('organization.phones.delete')
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
    $('#storePhone').modal('show');

    @elseif($errors->has('update_modal'))
    $('#editPhone').modal('show');
    @foreach ($errors->get('update_modal') as $error)
    {{--console.log({{ $error }});--}}
    get_phone_data({{$error}});

    @endforeach
    @endif

    function get_phone_data(id) {
        var url = "{{route('organization.phone.show' , ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: "Get",
            url: url,
            datatype: 'JSON',
            success: function (data) {
                if (data.status == true) {
                    console.log(data);
                    $('#country_code').val(data.data.phone.country_code);
                    $('#phone').val(data.data.phone.phone);
                    $('#title_en').val(data.data.phone.title_en);
                    $('#title_ar').val(data.data.phone.title_ar);
                    $('#phone_id').val(data.data.phone.id);

                    let update = "{{route('organization.phone.update' , ':id')}}";
                    update = update.replace(':id', data.data.phone.id);

                    let destroy = "{{route('organization.phone.destroy' , ':id')}}";
                    destroy = destroy.replace(':id', data.data.phone.id);
                    $('#update_form').attr('action', update);
                    $('#delete_form').attr('action', destroy);
                    $('#text_meesage').text(data.data.phone.phone);
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

