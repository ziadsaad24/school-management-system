<!-- jquery -->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>

<!-- plugins-jquery -->
<script src="{{ asset('assets/js/plugins-jquery.js') }}"></script>

<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = "{{ asset('assets/js/') }}/";

</script>

<!-- chart -->
<script src="{{ asset('assets/js/chart-init.js') }}"></script>

<!-- calendar -->
<script src="{{ asset('assets/js/calendar.init.js') }}"></script>

<!-- charts sparkline -->
<script src="{{ asset('assets/js/sparkline.init.js') }}"></script>

<!-- charts morris -->
<script src="{{ asset('assets/js/morris.init.js') }}"></script>

<!-- datepicker -->
<script src="{{ asset('assets/js/datepicker.js') }}"></script>

<!-- sweetalert2 -->
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

<!-- toastr -->
<script src="{{ asset('assets/js/toastr.js') }}"></script>
@yield('js')
<!-- Fallback: if php-flasher/toastr blades didn't render, show session messages here -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        try {
            @if(session('success'))
                if (typeof toastr !== 'undefined') {
                    toastr.success(@json(session('success')));
                } else {
                    console.log('Toastr not defined. Success: ' + @json(session('success')));
                }
            @endif

            @if(session('error'))
                if (typeof toastr !== 'undefined') {
                    toastr.error(@json(session('error')));
                } else {
                    console.log('Toastr not defined. Error: ' + @json(session('error')));
                }
            @endif
        } catch (e) {
            console.error('Fallback toastr error', e);
        }
    });
</script>

<!-- validation -->
<script src="{{ asset('assets/js/validation.js') }}"></script>

<!-- lobilist -->
<script src="{{ asset('assets/js/lobilist.js') }}"></script>

<!-- custom -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
