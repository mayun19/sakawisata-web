{{-- <script src="{{ url('js/jquery-3.5.1.min.js') }}"></script> --}}
<script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  AOS.init();
  $(document).ready(function() {
    // Format mata uang.
    if ($(".uang").length) {
        $('.uang').mask('000.000.000', {
            reverse: true
        });
    }
  });
</script>