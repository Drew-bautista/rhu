
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
    };

    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        console.log("Success message: {{ Session::get('success') }}"); // For debugging
    @endif

    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        console.log("Error message: {{ Session::get('error') }}"); // For debugging
    @endif

    @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
        console.log("Info message: {{ Session::get('info') }}"); // For debugging
    @endif

    @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
        console.log("Warning message: {{ Session::get('warning') }}"); // For debugging
    @endif
</script>