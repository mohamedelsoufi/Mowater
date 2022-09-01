@extends('dashboard.layouts.standard')
@section('title','Mawatery | Categories')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.categories')}} <small class="text-secondary">({{ $categories->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.categories')}}</li>
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
                                    data-target="#storeCategory">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.general.categories.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.name_en')}}</th>
                                        <th>{{__('words.name_ar')}}</th>
                                        <th>{{__('words.section')}}</th>
                                        <th>{{__('words.ref_name_category')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($categories as $category)
                                        <tr class="text-center">
                                            <td>{{$category->name_en}}</td>
                                            <td>{{$category->name_ar}}</td>
                                            <td>{{$category->section ? $category->section->name : '--'}}</td>
                                            <td>{{$category->ref_name ? __('words.' . $category->ref_name) : '--'}}</td>
                                            <td>
                                                <button type="button" id="show_category" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editCategory"
                                                        onclick="get_category_data({{$category->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_category_data({{$category->id}})">
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
    @include('dashboard.general.categories.update')
    @include('dashboard.general.categories.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeCategory').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editCategory').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_category_data({{$error}});

        @endforeach
        @endif

        function get_category_data(id) {
            var url = "{{route('categories.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        var name_en = data.data.show_category.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_category.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);

                        var section_id = data.data.show_category.section_id;
                        var old_section_id = "{{old('section_id','current')}}";
                        old_section_id = old_section_id.replace("current",section_id);
                        $('#section_id').val(old_section_id);

                        var ref_name = data.data.show_category.ref_name;
                        var old_ref_name = "{{old('ref_name','current')}}";
                        old_ref_name = old_ref_name.replace("current",ref_name);
                        $('#ref_name').val(old_ref_name);

                        $('#category_id').val(data.data.show_category.id);

                        let update = "{{route('categories.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_category.id);

                        let destroy = "{{route('categories.destroy' , ':id')}}";
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

