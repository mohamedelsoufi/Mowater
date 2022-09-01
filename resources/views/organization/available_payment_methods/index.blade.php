@extends('organization.layouts.app')
@section('title','Mawatery | Rental Laws')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.available_payment_methods')}}  <small class="text-secondary">({{ $available_payment_methods->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.available_payment_methods')}}</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeavailable_payment_method">{{__('words.create')}}
                            </button>
                            @include('organization.available_payment_methods.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.title')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($available_payment_methods as $available_payment_method)
                                        <tr class="text-center">
                                            <td>{{$available_payment_method->name}}</td>
                                            <td>
                                                {{-- <button type="button" id="show_available_payment_methods" class="btn btn-outline-info" data-toggle="modal" data-target="#editavailable_payment_method" onclick="get_available_payment_method_data({{$available_payment_method->id}})">{{__('words.show')}}</button> --}}

                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalDelete" onclick="get_available_payment_method_data({{$available_payment_method->id}})">{{__('words.delete')}} </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{-- @include('organization.available_payment_methods.edit') --}}
                                @include('organization.available_payment_methods.delete')
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

    $(".select2").select2();

    @if(count($errors) > 0 && !$errors->has('update_modal'))
    $('#storeavailable_payment_method').modal('show');

    @elseif($errors->has('update_modal'))
    $('#editavailable_payment_method').modal('show');
    @foreach ($errors->get('update_modal') as $error)
    {{--console.log({{ $error }});--}}
    get_available_payment_method_data({{$error}});

    @endforeach
    @endif

    function get_available_payment_method_data(id) {
        var url = "{{route('organization.available_payment_method.show' , ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: "Get",
            url: url,
            datatype: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.status == true) {
                   
                    //let update = "{{route('organization.available_payment_method.update' , ':id')}}";
                    //update = update.replace(':id', data.data.available_payment_method.id);

                    let destroy = "{{route('organization.available_payment_method.destroy' , ':id')}}";
                    destroy = destroy.replace(':id', data.data.available_payment_method.id);
                    //$('#update_form').attr('action', update);
                    $('#delete_form').attr('action', destroy);
                    $('#text_meesage').text(data.data.available_payment_method.name);
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

