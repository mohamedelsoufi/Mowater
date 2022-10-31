@extends('dashboard.layouts.standard')
@section('title','Mawatery | auctions')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>{{__('words.auctions')}} <small class="text-secondary">({{ $auctions->count() }}
                                )</small></h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">{{__('words.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('words.auctions')}}</li>
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
                            <a href="{{route('auctions.create')}}"
                               class="btn btn-outline-info"> {{__('words.create')}}</a>
                            {{--                            @include('dashboard.general.auctions.create')--}}
                        </div>
                        {{-- create modal end --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr class="text-center">
                                        <th>{{__('words.title')}}</th>
                                        <th>{{__('words.price')}}</th>
                                        <th>{{__('words.start_date_time')}}</th>
                                        <th>{{__('words.end_date_time')}}</th>
                                        <th>{{__('words.insurance_amount')}}</th>
                                        <th>{{__('words.status')}}</th>
                                        <th>{{__('words.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="display_data">
                                    @foreach($auctions as $auction)
                                        <tr class="text-center">
                                            <td>{{$auction->title?$auction->title:"--"}}</td>
                                            <td>{{$auction->price?$auction->price:"--"}}</td>
                                            <td>{{$auction->start_date ? $auction->start_date: $auction->created_at}}</td>
                                            <td>{{$auction->end_date ? $auction->end_date: $auction->updated_at}}</td>
                                            <td>{{$auction->insurance_amount ? $auction->insurance_amount : '--'}}</td>
                                            <td @if($auction->start_date > \Carbon\Carbon::now()->format('Y-m-d')) class="text-danger"
                                                @elseif($auction->end_date < \Carbon\Carbon::now()->format('Y-m-d'))
                                                class="text-secondary"
                                                @else
                                                class="text-success"
                                                @endif
                                            >{{$auction->status}}</td>
                                            <td>
                                                <a href="{{route('auctions.show',$auction->id)}}"
                                                   class="btn btn-outline-info"> {{__('words.show')}}</a>
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
    {{--    @include('dashboard.general.auctions.update')--}}
    {{--    @include('dashboard.general.auctions.delete')--}}
@endsection

@section('scripts')
    <script type="text/javascript">
        // $('.birth_date').val(data.data.show_organization.birth_date);

    </script>
@endsection

