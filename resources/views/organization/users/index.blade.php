@extends('organization.layouts.app')
@section('title','Mawatery | Users')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.users')}} <small class="text-secondary">({{ $org_users->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.users')}}</li>
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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#storeOrgUser">
                                {{__('words.create')}}
                            </button>
                            @include('organization.users.create')

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.email')}}</th>
                                        <th>{{__('words.user_name')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($org_users as $user)
                                        <tr class="text-center">
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->user_name}}</td>
                                            </td>

                                            <td>

                                                <button type="button" id="show_org_user" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editOrgUser"
                                                        onclick="get_OrgUser_data({{$user->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_OrgUser_data({{$user->id}})">
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

    @include('organization.users.delete')
    @include('organization.users.update')

@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeOrgUser').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editOrgUser').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_OrgUser_data({{$error}});

        @endforeach
        @endif

        function get_OrgUser_data(id) {
            var url = "{{route('organization.users.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {

                        var email = data.data.show_org_user.email;
                        var old_email = "{{old('email','current')}}";
                        old_email = old_email.replace("current", email);
                        $('#email').val(old_email);

                        var user_name = data.data.show_org_user.user_name;
                        var old_user_name = "{{old('user_name','current')}}";
                        old_user_name = old_user_name.replace("current", user_name);
                        $('#user_name').val(old_user_name);


                        if (data.data.show_org_user.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }


                        $('#user_id').val(data.data.show_org_user.id);

                        let update = "{{route('organization.users.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_org_user.id);

                        let destroy = "{{route('organization.users.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_org_user.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_org_user.email);


                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }
    </script>
@endsection

