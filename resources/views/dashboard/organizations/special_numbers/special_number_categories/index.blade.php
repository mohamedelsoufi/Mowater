@extends('dashboard.layouts.standard')
@section('title','Mawatery | Special Number Categories')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.special_numbers_categories')}} <small
                                class="text-secondary">({{ $special_number_categories->count() }})</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.special_numbers_categories')}}</li>
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
                                    data-target="#storeSpecialNumberCategory">
                                {{__('words.create')}}
                            </button>
                            @include('dashboard.organizations.special_numbers.special_number_categories.create')
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.count_of_numbers')}}</th>
                                        <th>{{__('words.main_category')}}</th>
                                        <th>{{__('words.activity')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($special_number_categories as $special_number_category)
                                        <tr class="text-center">
                                            <td>{{$special_number_category->name_en .' '. __('words.numbers')}}</td>
                                            <td>

                                                {{$special_number_category->main_category}}

                                            </td>
                                            <td>{{$special_number_category->getActive()}}</td>
                                            <td>
                                                <button type="button" id="show_special_number_category"
                                                        class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#editSpecialNumberCategory"
                                                        onclick="get_special_number_category_data({{$special_number_category->id}})">
                                                    {{__('words.show')}}
                                                </button>

                                                <button type="button" class="btn btn-outline-danger"
                                                        data-toggle="modal"
                                                        data-target="#ModalDelete"
                                                        onclick="get_special_number_category_data({{$special_number_category->id}})">
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
    @include('dashboard.organizations.special_numbers.special_number_categories.update')
    @include('dashboard.organizations.special_numbers.special_number_categories.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeSpecialNumberCategory').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editSpecialNumberCategory').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_special_number_category_data({{$error}});

        @endforeach
        @endif

        function get_special_number_category_data(id) {
            var url = "{{route('special-number-categories.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        console.log(data);
                        var name_en = data.data.show_special_number_category.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_special_number_category.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_ar').val(old_name_ar);

                        var main_category = data.data.main_category;
                        var old_main_category = "{{old('main_category','current')}}";
                        old_main_category = old_main_category.replace("current",main_category);
                        $('#main_category').val(old_main_category);

                        if (data.data.show_special_number_category.active == 1) {
                            $('#active').prop('checked', true);
                        } else {
                            $('#active').prop('checked', false);
                        }
                        $('#special_number_category_id').val(data.data.show_special_number_category.id);

                        let update = "{{route('special-number-categories.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_special_number_category.id);

                        let destroy = "{{route('special-number-categories.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_special_number_category.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_special_number_category.name);
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

