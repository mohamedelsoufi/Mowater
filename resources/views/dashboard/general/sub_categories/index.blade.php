@extends('dashboard.layouts.standard')
@section('title','Mawatery | Sub Categories')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.sub_categories')}} <small class="text-secondary">({{ $sub_categories->count() }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.sub_categories')}}</li>
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
                                    data-target="#storeSubCategory">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.general.sub_categories.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.main_category')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($sub_categories as $sub_category)
                                        <tr class="text-center">
                                            <td>{{$sub_category->name_en}}</td>
                                            <td>{{$sub_category->name_ar}}</td>
                                            <td>{{$sub_category->category ? $sub_category->category->name : '--'}}</td>
                                            <td>
                                                <button type="button" id="show_category" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editSubCategory"
                                                        onclick="get_category_data({{$sub_category->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_category_data({{$sub_category->id}})">
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
    @include('dashboard.general.sub_categories.update')
    @include('dashboard.general.sub_categories.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeSubCategory').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editSubCategory').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_category_data({{$error}});

        @endforeach
        @endif

        function get_category_data(id) {
            var url = "{{route('sub-categories.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        $('#name_en').val(data.data.show_category.name_en);
                        $('#name_ar').val(data.data.show_category.name_ar);
                        $('#category_id').val(data.data.show_category.category_id);

                        $('#sub_category_id').val(data.data.show_category.id);

                        let update = "{{route('sub-categories.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_category.id);

                        let destroy = "{{route('sub-categories.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_category.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_category.name);
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

