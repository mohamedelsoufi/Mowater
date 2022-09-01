@extends('organization.layouts.app')
@section('title','Mawatery | Rental Laws')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.laws')}}  <small class="text-secondary">({{ $laws->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.laws')}}</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storelaw">{{__('words.create')}}
                            </button>
                            @include('organization.laws.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.law')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($laws as $law)
                                        <tr class="text-center">
                                            <td>{{Str::limit($law->law , 60)}}</td>
                                            <td>
                                                <button type="button" id="show_laws" class="btn btn-outline-info" data-toggle="modal" data-target="#editlaw" onclick="get_law_data({{$law->id}})">{{__('words.show')}}</button>

                                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#ModalDelete" onclick="get_law_data({{$law->id}})">{{__('words.delete')}} </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                @include('organization.laws.edit')
                                @include('organization.laws.delete')
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
    $('#storelaw').modal('show');

    @elseif($errors->has('update_modal'))
    $('#editlaw').modal('show');
    @foreach ($errors->get('update_modal') as $error)
    {{--console.log({{ $error }});--}}
    get_law_data({{$error}});

    @endforeach
    @endif

    function get_law_data(id) {
        var url = "{{route('organization.law.show' , ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: "Get",
            url: url,
            datatype: 'JSON',
            success: function (data) {
                if (data.status == true) {
                    console.log(data);
                    $('#law_en').val(data.data.law.law_en);
                    $('#law_ar').val(data.data.law.law_ar);
                    $('#law_id').val(data.data.law.id);
                    
                    let update = "{{route('organization.law.update' , ':id')}}";
                    update = update.replace(':id', data.data.law.id);

                    let destroy = "{{route('organization.law.destroy' , ':id')}}";
                    destroy = destroy.replace(':id', data.data.law.id);
                    $('#update_form').attr('action', update);
                    $('#delete_form').attr('action', destroy);
                    $('#text_meesage').text(data.data.law.law);
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

