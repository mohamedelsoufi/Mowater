@extends('dashboard.layouts.standard')
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">

                    <div class="welcome-text">
                        <div class="col-md-3 {{app()->getLocale() == 'ar' ? 'col-md-push-9' :  'col-md-3'}}">
                            <h4>{{__('sentences.welcome_back')}}</h4>
                            <p class="mb-0 stat-digit">{{__('app.dashboard')}}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
