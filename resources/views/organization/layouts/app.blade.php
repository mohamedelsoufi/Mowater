<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Mawatery-Dashboard')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dashboard/images/favicon.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    {{--  select2  --}}
    <link rel="stylesheet" href="{{asset('/public/dashboard/vendor/select2/css/select2.min.css')}}">
    @if(App::isLocale('ar'))
        <link rel="stylesheet" href="{{asset('/public/dashboard/vendor/owl-carousel/css/owl.carousel-ar.min.css')}}">
        <link rel="stylesheet" href="{{asset('/public/dashboard/vendor/owl-carousel/css/owl.theme.default-ar.min.css')}}">
        <link href="{{asset('/public/dashboard/vendor/jqvmap/css/jqvmap-ar.min.css')}}" rel="stylesheet">
        <link href="{{asset('/public/dashboard/vendor/datatables/css/jquery.dataTables-ar.min.css')}}" rel="stylesheet">
        <link href="{{asset('/public/dashboard/css/style-ar.css')}}" rel="stylesheet">
        <link href="{{asset('/public/dashboard/css/custom-ar.css')}}" rel="stylesheet">
    @else
        <link rel="stylesheet" href="{{asset('/public/dashboard/vendor/owl-carousel/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('/public/dashboard/vendor/owl-carousel/css/owl.theme.default.min.css')}}">
        <link href="{{asset('/public/dashboard/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
        <link href="{{asset('/public/dashboard/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
        <link href="{{asset('/public/dashboard/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('/public/dashboard/css/custom.css')}}" rel="stylesheet">
    @endif
    {{--  fontawesome  --}}
    <link href="{{asset('/public/dashboard/icons/fontawesome-free-5.15.4-web/css/all.css')}}" rel="stylesheet">
    {{-- toastr   --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{--  lightbox  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
          integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="{{asset('/public/dashboard/css/yearpicker.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" href="{{asset('dashboard/vendor/pickadate/themes/default.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendor/pickadate/themes/default.date.css')}}">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Readex+Pro:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@700&display=swap');
        /* @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@600&display=swap'); */
        @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@900&display=swap');

        * {
            /*font-family: 'Readex Pro', sans-serif;*/
            /*font-family: 'IBM Plex Sans Arabic', sans-serif;*/
            font-family: 'Noto Kufi Arabic', sans-serif;
        }
    </style>

    @yield('styles')
</head>

<body dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}">

<!-- Preloader start -->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!-- Preloader end -->

<!-- Main wrapper start -->
<div id="main-wrapper">
    <!-- Side Nav header start -->
    <div class="nav-header">
        <a href="{{route('organization.home')}}" class="brand-logo">
            <h5 style="color: white">  {{__('words.mawatery')}}</h5>
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
    </div>
    <!-- Side Nav header end -->

    <!-- Navbar Header start -->
@include('organization.includes.navbar')
<!-- Navbar Header end -->

    <!-- Sidebar start -->
@include('organization.includes.sidebar')
<!-- Sidebar end -->

@yield('content')

<!-- Footer start -->
@include('organization.includes.footer')
<!-- Footer end -->
</div>

<!-- Scripts -->
<!-- Required vendors -->
<script src="{{asset('/public/dashboard/vendor/global/global.min.js')}}"></script>
<script src="{{asset('/public/dashboard/js/quixnav-init.js')}}"></script>
<script src="{{asset('/public/dashboard/js/custom.min.js')}}"></script>

{{-- lightbox --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
{{--<script src="{{asset('dashboard/vendor/select2/js/select2.full.min.js')}}"></script>--}}
{{--<script src="{{asset('dashboard/js/plugins-init/select2-init.js')}}"></script>--}}
<script>
    $(document).ready(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    });
</script>

<!-- Vectormap -->
<script src="{{asset('/public/dashboard/vendor/raphael/raphael.min.js')}}"></script>
<script src="{{asset('/public/dashboard/vendor/morris/morris.min.js')}}"></script>


<script src="{{asset('/public/dashboard/vendor/circle-progress/circle-progress.min.js')}}"></script>
<script src="{{asset('/public/dashboard/vendor/chart.js/Chart.bundle.min.js')}}"></script>

<script src="{{asset('/public/dashboard/vendor/gaugeJS/dist/gauge.min.js')}}"></script>

<!--  flot-chart js -->
<script src="{{asset('/public/dashboard/vendor/flot/jquery.flot.js')}}"></script>
<script src="{{asset('/public/dashboard/vendor/flot/jquery.flot.resize.js')}}"></script>

<!-- Owl Carousel -->
<script src="{{asset('/public/dashboard/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>

<!-- Counter Up -->
<script src="{{asset('/public/dashboard/vendor/jqvmap/js/jquery.vmap.min.js')}}"></script>
<script src="{{asset('/public/dashboard/vendor/jqvmap/js/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('/public/dashboard/vendor/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('/public/dashboard/js/dashboard/dashboard-1.js')}}"></script>

<!-- Datatable -->
<script src="{{asset('/public/dashboard/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/public/dashboard/js/plugins-init/datatables.init.js')}}"></script>

{{-- custom Js --}}
<script src="{{asset('/public/dashboard/js/custom/image-preview.js')}}"></script>

{{--Select 2--}}
<script src="{{asset('/public/dashboard/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('/public/dashboard/js/plugins-init/select2-init.js')}}"></script>

<!-- CkEditor js -->
<script src="{{asset('dashboard/js/ckeditor/ckeditor.js')}}"></script>
<!-- yearpicker.js -->
<script src="{{asset('dashboard/js/yearpicker.js')}}"></script>
{{--datepicker--}}
<script src="{{asset('dashboard/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('dashboard/vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('dashboard/vendor/pickadate/picker.date.js')}}"></script>

<script src="{{asset('dashboard/js/plugins-init/material-date-picker-init.js')}}"></script>
{{--<script src="/js/plugins-init/material-date-picker-init.js"></script>--}}
<script src="{{asset('dashboard/js/plugins-init/pickadate-init.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    CKEDITOR.config.language = "{{App()->getLocale()}}";
    CKEDITOR.config.removeButtons = 'Maximize,ShowBlocks,NewPage,BidiLtr,BidiRtl,Language,Source,CreateDiv,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,About';
    $('.yearpicker').yearpicker();
</script>

@include('location')

@yield('scripts');
</body>

</html>
