<!-- Modal -->
<div class="modal fade" id="SubSection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('words.sub_section')}}</h5>
                <button type="button" class="close {{App::isLocale('ar') ? 'modal-x-sign' : ''}}" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive sub_section_table">
                    <table id="example2" class="display" style="width: 100%">
                        <thead>
                        <tr class="text-center text-black-50">
                            <th>{{__('words.image_s')}}</th>
                            <th>{{__('words.name_en')}}</th>
                            <th>{{__('words.name_ar')}}</th>
                            <th>{{__('words.ref_name')}}</th>
                            <th>{{__('words.reservation_cost_type')}}</th>
                            <th>{{__('words.reservation_cost')}}</th>
                            <th>{{__('words.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody id="display_data">

                        @foreach($sub_sections as $sub_section)

                            <tr class="text-center">
                                <td>
                                    <a href="{{$sub_section->file_url}}"
                                       data-toggle="lightbox">
                                        <img class="slider_image"
                                             src="{{$sub_section->file_url}}" alt="logo">
                                    </a>
                                </td>
                                <td>{{$sub_section->name_en}}</td>
                                <td>{{$sub_section->name_ar}}</td>
                                <td>{{$sub_section->ref_name}}</td>
                                <td>{{$sub_section->reservation_cost_type}}</td>
                                <td>{{$sub_section->reservation_cost}}</td>
                                <td>
                                    <button type="button" id="show_section"
                                            class="btn btn-sm m-1 btn-outline-info"
                                            data-toggle="modal"
                                            data-target="#editSection"
                                            onclick="get_section_data({{$sub_section->id}})">
                                        {{__('words.show')}}
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                            data-toggle="modal"
                                            data-target="#ModalDelete"
                                            onclick="get_section_data({{$sub_section->id}})">
                                        {{__('words.delete')}}
                                    </button>
                                </td>

                            </tr>


                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">
                    {{__('words.close')}}
                </button>
            </div>
        </div>
    </div>
</div>
