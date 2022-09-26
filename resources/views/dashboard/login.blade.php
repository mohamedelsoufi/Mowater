<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Mawatry</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/public/dashboard/images/favicon.png')}}">
    <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">

    @if(App::isLocale('ar'))
        <link href="{{asset('/public/dashboard/css/style-ar.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('/public/dashboard/css/style.css')}}" rel="stylesheet">
    @endif
</head>

<body dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}" class="h-100">
<div class="authincation h-100">
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">

                                <h4 class="text-center mb-4">{{__('words.sign_in_your_account')}}</h4>
                                <form action="{{route('authenticate')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label><strong>{{__('words.email')}}</strong></label>
                                        <input type="email" class="form-control" name="email"/>

                                    </div>
                                    <div class="form-group">
                                        <label><strong>{{__('words.password')}}</strong></label>
                                        <input type="password" class="form-control" autocomplete="new-password" name="password">

                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            {{-- <div class="form-check ml-2">
                                                <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                <label class="form-check-label" for="basic_checkbox_1">{{__('words.remember_me')}}</label>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="form-group">
                                            <a href="page-forgot-password.html">{{__('words.forgot_password')}}</a>
                                        </div> --}}
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">{{__('words.sign_in')}}</button>
                                    </div>
                                </form>
                                {{-- <div class="new-account mt-3">
                                    <p>{{__('words.dont_have_account')}} <a class="text-primary" href="./page-register.html">{{__('words.sign_up')}}</a></p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{asset('dashboard/vendor/global/global.min.js')}}"></script>
<script src="{{asset('dashboard/js/quixnav-init.js')}}"></script>
<script src="{{asset('dashboard/js/custom.min.js')}}"></script>

</body>

</html>
