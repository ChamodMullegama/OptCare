<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('AdminArea/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('AdminArea/vendors/js/vendor.bundle.addons.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('AdminArea/js/off-canvas.js') }}"></script>
<script src="{{ asset('AdminArea/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('AdminArea/js/misc.js') }}"></script>
<script src="{{ asset('AdminArea/js/settings.js') }}"></script>
<script src="{{ asset('AdimnArea/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('AdminArea/js/dashboard.js') }}"></script>
<!-- End custom js for this page-->
<script src="{{ asset('AdminArea/js/data-table.js') }}"></script>
<script src="{{ asset('AdminArea/js/modal-demo.js') }}"></script>
<script src="{{ asset('AdminArea/js/file-upload.js') }}"></script>
  <script src="{{ asset('AdminArea/js/typeahead.js') }}"></script>
  <script src="{{ asset('AdminArea/js/select2.js') }}"></script>
  <script src="{{ asset('AdminArea/js/wizard.js') }}"></script>
  <script src="{{ asset('AdminArea/js/editorDemo.js') }}"></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRxCvC_tYnWNUso0oJf-YAmRQVkh8204s&callback=initMap" async defer></script>

  @if (session('success'))
  <script>
      toastr.success("{{ session('success') }}", '', {
          closeButton: true,
          progressBar: true,
          positionClass: 'toast-top-right'
      });
  </script>
@endif

@if ($errors->any())
  @foreach ($errors->all() as $error)
      <script>
          toastr.error("{{ $error }}", '', {
              closeButton: true,
              progressBar: true,
              positionClass: 'toast-top-right'
          });
      </script>
  @endforeach
@endif

@if (session('error'))
  <script>
      toastr.error("{{ session('error') }}", '', {
          closeButton: true,
          progressBar: true,
          positionClass: 'toast-top-right'
      });
  </script>
@endif




@stack('js')
