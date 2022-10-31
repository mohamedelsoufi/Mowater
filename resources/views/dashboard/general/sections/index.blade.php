@extends('dashboard.layouts.standard')
@section('title','Mawatery | Sections')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.sections')}} <small class="text-secondary">({{ $sections->count() }})</small>
                        </h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.sections')}}</li>
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

                            {{-- create modal end --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                        <tr class="text-center">
                                            <th>{{__('words.image_s')}}</th>
                                            <th>{{__('words.name_en')}}</th>
                                            <th>{{__('words.name_ar')}}</th>
                                            <th>{{__('words.ref_name')}}</th>
                                            {{--                                        <th>{{__('words.section')}}</th>--}}
                                            <th>{{__('words.reservation_cost_type')}}</th>
                                            <th>{{__('words.reservation_cost')}}</th>
                                            <th>{{__('words.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="display_data">

                                        @foreach($sections as $section)

                                            <tr class="text-center">
                                                <td>
                                                    <a href="{{$section->file_url}}"
                                                       data-toggle="lightbox">
                                                        <img class="slider_image"
                                                             src="{{$section->file_url}}" alt="logo">
                                                    </a>
                                                </td>
                                                <td>{{$section->name_en}}</td>
                                                @if($section->getSubSection() != null && $section->getSubSection() === $section->name_ar)
                                                    <td>
                                                        <button class="btn btn-primary" type="button"
                                                                data-toggle="modal" data-target="#SubSection"
                                                                aria-expanded="false" aria-controls="collapseExample">
                                                            {{$section->getSubSection()}}
                                                        </button>

                                                    </td>
                                                @else
                                                    <td>{{$section->name_ar}}</td>
                                                @endif

                                                <td>{{$section->ref_name}}</td>
                                                {{--                                            <td>{{$section->parent ? $section->parent->name : ''}}</td>--}}
                                                <td>{{$section->reservation_cost_type}}</td>
                                                <td>{{$section->reservation_cost}}</td>
                                                <td>
                                                    <button type="button" id="show_section"
                                                            class="btn btn-sm btn-block btn-outline-info"
                                                            data-toggle="modal"
                                                            data-target="#editSection"
                                                            onclick="get_section_data({{$section->id}})">
                                                        {{__('words.show')}}
                                                    </button>

                                                    {{-- <button type="button" class="btn btn-sm btn-block btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#ModalDelete"
                                                            onclick="get_section_data({{$section->id}})">
                                                        {{__('words.delete')}}
                                                    </button> --}}
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
    </div>
    @include('dashboard.general.sections.sub_section')
    @include('dashboard.general.sections.update')
    @include('dashboard.general.sections.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storeSection').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editSection').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_section_data({{$error}});

        @endforeach
        @endif

        function get_section_data(id) {
            var url = "{{route('sections.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    if (data.status == true) {
                        // console.log(data);
                        var name_en = data.data.show_section.name_en;
                        var old_name_en = "{{old('name_en','current')}}";
                        old_name_en = old_name_en.replace("current",name_en);
                        $('#name_en').val(old_name_en);

                        var name_ar = data.data.show_section.name_ar;
                        var old_name_ar = "{{old('name_ar','current')}}";
                        old_name_ar = old_name_ar.replace("current",name_ar);
                        $('#name_en').val(old_name_ar);

                        var section_id = data.data.show_section.section_id;
                        var old_section_id = "{{old('section_id','current')}}";
                        old_section_id = old_section_id.replace("current",section_id);
                        $('#section_id').val(old_section_id);

                        if (data.data.show_section.ref_name == "DrivingInstructors") {
                            $('#reservation_cost_type').val("amount");

                            // console.log($('#reservation_cost_type').val());
                            // $('#reservation_cost_type').prop("disabled", true);
                            $('.hour_price').removeClass('d-none');
                            $('.reservation_cost').addClass('d-none');
                            $('#hour_price').val(data.data.show_section.reservation_cost);

                        } else {
                            $('.hour_price').addClass('d-none');
                            $('.reservation_cost').removeClass('d-none');

                            $('#reservation_cost').val(data.data.show_section.reservation_cost);

                        }                                // console.log(data);

                        $('#id').val(data.data.show_section.id);
                        $('#image').attr("src", data.data.show_section.file_url);

                        let update = "{{route('sections.update' , ':id')}}";
                        update = update.replace(':id', data.data.show_section.id);

                        let destroy = "{{route('sections.destroy' , ':id')}}";
                        destroy = destroy.replace(':id', data.data.show_section.id);
                        $('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);

                        $('#text_meesage').text(data.data.show_section.name);
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

