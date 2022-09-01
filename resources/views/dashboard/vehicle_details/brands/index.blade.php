@extends('dashboard.layouts.standard')
@section('title','Mawatery | Brands')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.brands')}} <small class="text-secondary">({{ $brands->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.brands')}}</li>
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
                                    data-target="#storeBrand">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.vehicle_details.brands.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.manufacture_country')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($brands as $brand)
                                        <tr class="text-center">
                                            <td>{{$brand->name_en}}</td>
                                            <td>{{$brand->name_ar}}</td>
                                            <td>{{$brand->getActive()}}</td>
                                            <td>{{$brand->manufacture_country->name}}</td>
                                            <td>
                                                <button type="button" id="show_brand" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editBrand"
                                                        onclick="get_brand_data({{$brand->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_brand_data({{$brand->id}})">
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
    @include('dashboard.vehicle_details.brands.update')
    @include('dashboard.vehicle_details.brands.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeBrand').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editBrand').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_brand_data({{$error}});

        @endforeach
        @endif

        function get_brand_data(id) {
            var url = "{{route('brands.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        $('#name_en').val(data.data.show_brand.name_en);
                        $('#name_ar').val(data.data.show_brand.name_ar);
                        $('#manufacture_country_id').val(data.data.show_brand.manufacture_country_id);
                        if (data.data.show_brand.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }
                        $('#brand_id').val(data.data.show_brand.id);

                        let update = "{{route('brands.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_brand.id);

                        let destroy = "{{route('brands.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_brand.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_brand.name);
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

