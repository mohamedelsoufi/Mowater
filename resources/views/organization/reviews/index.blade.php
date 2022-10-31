@extends('organization.layouts.app')
@section('title','Mawatery | Reviews')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.reviews')}} <small class="text-secondary">({{ $reviews->count() }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('organization.home')}}">{{__('words.home')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('words.reviews')}}</li>
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
                           

                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.created_at')}}</th>
                                        <th>{{__('words.user')}}</th>
                                        <th>{{__('words.rate')}}</th>
                                        <th>{{__('words.review')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                        @foreach($reviews as $review)
                                            <tr class="text-center">
                                                <td>{{$review->created_at}}</td>
                                                <td>{{$review->user ? $review->user->name : '' }}</td>
                                                <td>{{$review->rate}}</td>
                                                <td>{{Str::limit($review->review , 20)}}</td>

                                                <td>
                                                    <button type="button" id="show_review"
                                                            class="btn btn-outline-info"
                                                            data-toggle="modal"
                                                            data-target="#editReview"
                                                            onclick="get_review_data({{$review->id}})">
                                                        {{__('words.show')}}
                                                    </button>

                                                    <button type="button" class="btn btn-outline-danger"
                                                            data-toggle="modal"
                                                            data-target="#ModalDelete"
                                                            onclick="get_review_data({{$review->id}})">
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
    @include('organization.reviews.update')
    @include('organization.reviews.delete')
@endsection

@section('scripts')
    <script type="text/javascript">

        @if(count($errors) > 0 && !$errors->has('update_modal'))
        $('#storereview').modal('show');

        @elseif($errors->has('update_modal'))
        $('#editreview').modal('show');
        @foreach ($errors->get('update_modal') as $error)
        {{--console.log({{ $error }});--}}
        get_review_data({{$error}});

        @endforeach
        @endif

        function get_review_data(id) {
            var url = "{{route('organization.review.show' , ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                type: "Get",
                url: url,
                datatype: 'JSON',
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        $('#created_at').val(data.data.created_at);
                        $('#user_name').val(data.data.user.name);
                        $('#rate').val(data.data.rate);
                        $('#review').val(data.data.review);
                       
                        let destroy = "{{route('organization.review.destroy' , ':id')}}";
                        
                        destroy = destroy.replace(':id', data.data.id);
                    
                        //$('#update_form').attr('action', update);
                        $('#delete_form').attr('action', destroy);


                        $('#text_meesage').text(data.data.show_review.name);
                    }
                },
                error: function (reject) {
                    alert(reject);
                }
            });
        }

    </script>

@endsection

