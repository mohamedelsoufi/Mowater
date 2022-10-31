@extends('dashboard.layouts.standard')
@section('title','Mawatery | Users')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.users')}} <small class="text-secondary">({{ $users->count() }})</small></h4>
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
                                    data-target="#storeUser">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.general.users.create')

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.email')}}</th>
                                        <th>{{__('words.name')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($users as $user)
                                        <tr class="text-center">
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->name}}</td>
                                            </td>

                                            <td>

                                                <button type="button" id="show_user" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editUser"
                                                        onclick="get_User_data({{$user->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_User_data({{$user->id}})">
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

    @include('dashboard.general.users.delete')
    @include('dashboard.general.users.update')

@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeUser').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editUser').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_User_data({{$error}});

        @endforeach
        @endif

        function get_User_data(id) {
            var url = "{{route('users.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {

                        var email = data.data.show_user.email;
                        var old_email = "{{old('email','current')}}";
                        old_email = old_email.replace("current", email);
                        $('#email').val(old_email);

                        var name = data.data.show_user.name;
                        var old_name = "{{old('name','current')}}";
                        old_name = old_name.replace("current", name);
                        $('#name').val(old_name);


                        if (data.data.show_user.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }


                        $('#user_id').val(data.data.show_user.id);

                        let update = "{{route('users.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_user.id);

                        let destroy = "{{route('users.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_user.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_user.email);


                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }
    </script>
@endsection

