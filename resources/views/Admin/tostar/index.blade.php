<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
    function showToastr() {
        @if (Session::has('message') || Session::has('error') || Session::has('info') || Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }

            @if (Session::has('message'))
                toastr.success("{{ session('message') }}");
            @endif

            @if (Session::has('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if (Session::has('info'))
                toastr.info("{{ session('info') }}");
            @endif

            @if (Session::has('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif
        @endif
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
