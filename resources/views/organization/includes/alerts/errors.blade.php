@if(Session::has('error'))
    <script>
        toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true,
                "positionClass": 'toast-top-left',
            }
        toastr.error("{{ Session::get('error') }}");
    </script>
@endif

@if ($errors->any())

    <script>
        toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true,
                "positionClass": 'toast-top-left',
            }
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script>

@endif



