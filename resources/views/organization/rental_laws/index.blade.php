@extends('organization.layouts.app')
@section('title','Mawatery | Rental Laws')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.rental_laws')}}  <small class="text-secondary">({{ $rental_laws->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.rental_laws')}}</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storerental_law">{{__('words.create')}}
                            </button>
                            @include('organization.rental_laws.create')
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
                                    @foreach($rental_laws as $rental_law)
                                        <tr class="text-center">
                                            <td>{{Str::limit($rental_law->title , 60)}}</td>
                                            <td>
                                                <button type="button" id="show_rental_laws" class="btn btn-outline-info" data-toggle="modal" data-target="#editrental_law" onclick="get_rental_law_data({{$rental_law->id}})">{{__('words.show')}}</button>

                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalDelete" onclick="get_rental_law_data({{$rental_law->id}})">{{__('words.delete')}} </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.rental_laws.edit')
                                @include('organization.rental_laws.delete')
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
    $('#storerental_law').modal('show');

    @elseif($errors->has('update_modal'))
    $('#editrental_law').modal('show');
    @foreach ($errors->get('update_modal') as $error)
    {{--console.log({{ $error }});--}}
    get_rental_law_data({{$error}});

    @endforeach
    @endif

    function get_rental_law_data(id) {
        var url = "{{route('organization.rental_law.show' , ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: "Get",
            url: url,
            datatype: 'JSON',
            success: function (data) {
                if (data.status == true) {
                    console.log(data);
                    $('#title_en').val(data.data.rental_law.title_en);
                    $('#title_ar').val(data.data.rental_law.title_ar);
                    $('#rental_law_id').val(data.data.rental_law.id);
                    
                    let update = "{{route('organization.rental_law.update' , ':id')}}";
                    update = update.replace(':id', data.data.rental_law.id);

                    let destroy = "{{route('organization.rental_law.destroy' , ':id')}}";
                    destroy = destroy.replace(':id', data.data.rental_law.id);
                    $('#update_form').attr('action', update);
                    $('#delete_form').attr('action', destroy);
                    $('#text_meesage').text(data.data.rental_law.title);
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

