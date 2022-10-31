@extends('dashboard.layouts.standard')
@section('title','Mawatery | Areas')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.areas')}} <small class="text-secondary">({{ $areas->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.areas')}}</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#storeArea">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.location.areas.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.city')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($areas as $area)
                                        <tr class="text-center">
                                            <td>{{$area->name_en}}</td>
                                            <td>{{$area->name_ar}}</td>
                                            <td>{{$area->city->name}}</td>
                                            <td>
                                                <button type="button" id="$show_area" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editArea"
                                                        onclick="get_area_data({{$area->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_area_data({{$area->id}})">
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
    @include('dashboard.location.areas.update')
    @include('dashboard.location.areas.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeArea').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editArea').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_area_data({{$error}});

        @endforeach
        @endif

        function get_area_data(id) {
            var url = "{{route('areas.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {

                        var name_en = data.data.show_area.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_area.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);

                        var city_id = data.data.show_area.city_id;
                        var old_city_id = "{{old('city_id','current')}}";
                        old_city_id = old_city_id.replace("current",city_id);
                        $('#city_id').val(old_city_id);


                        $('#area_id').val(data.data.show_area.id);

                        let update = "{{route('areas.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_area.id);

                        let destroy = "{{route('areas.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_area.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_area.name);
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

