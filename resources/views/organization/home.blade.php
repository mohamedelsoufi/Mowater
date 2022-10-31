@extends('organization.layouts.app')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-12 p-md-0">

                    <div class="welcome-text">
                        <div class="col">
                            <h4 class="mb-2">
                                {{__('sentences.welcome_back')}}
                                <span class="text-info">( {{Auth::guard('web')->user()->user_name}} )</span>
                            </h4>
                            <p class="mb-0 stat-digit">{{__('app.dashboard')}}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
