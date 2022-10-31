@extends('dashboard.layouts.standard')
@section('title','Mawatery | Colors')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.colors')}} <small
                                class="text-secondary">({{ $colors->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.colors')}}</li>
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
                                    data-target="#storeColor">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.general.colors.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.color_name')}}</th>
                                        <th>{{__('words.color_name_ar')}}</th>
                                        <th>{{__('words.color_code')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($colors as $color)
                                        <tr class="text-center">
                                            <td>{{$color->color_name}}</td>
                                            <td>{{$color->color_name_ar}}</td>
                                            <td>{{$color->color_code}}</td>
                                            <td>
                                                <button type="button" id="show_brand" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editColor"
                                                        onclick="get_color_data({{$color->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_color_data({{$color->id}})">
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
    @include('dashboard.general.colors.update')
    @include('dashboard.general.colors.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeColor').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editColor').modal('show');
            @foreach ($errors->get('update_modal') as $error)
                {{--console.log({{ $error }});--}}
                get_color_data({{$error}});
            @endforeach
        @endif

        function get_color_data(id) {
            var url = "{{route('colors.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        var color_name = data.data.show_color.color_name;
                        var old_color_name = "{{old('color_name','current')}}";
                        old_color_name = old_color_name.replace("current",color_name);
                        $('#color_name').val(old_color_name);

                        var color_name_ar = data.data.show_color.color_name_ar;
                        var old_color_name_ar = "{{old('color_name_ar','current')}}";
                        old_color_name_ar = old_color_name_ar.replace("current",color_name_ar);
                        $('#color_name_ar').val(old_color_name_ar);

                        var color_code = data.data.show_color.color_code;
                        var old_color_code = "{{old('color_code','current')}}";
                        old_color_code = old_color_code.replace("current",color_code);
                        $('#color_code').val(old_color_code);

                        $('#color_id').val(data.data.show_color.id);

                        let update = "{{route('colors.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_color.id);

                        let destroy = "{{route('colors.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_color.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_color.name);
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

