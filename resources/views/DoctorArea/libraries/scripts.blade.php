<!-- ========== JAVASCRIPT SECTION ========== -->

<!--  jQuery (Load once only) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!--  Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Bootstrap Bundle -->
<script src="{{ asset('DoctorArea/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Moment.js -->
<script src="{{ asset('DoctorArea/js/moment.min.js') }}"></script>

<!-- Overlay Scrollbars -->
<script src="{{ asset('DoctorArea/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

<!-- Dropzone -->
<script src="{{ asset('DoctorArea/vendor/dropzone/dropzone.min.js') }}"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<!-- Quill -->
<script src="{{ asset('DoctorArea/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/quill/custom.js') }}"></script>

<!-- Apex Charts -->
<script src="{{ asset('DoctorArea/vendor/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/apex/custom/home/patients.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/apex/custom/home/treatment.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/apex/custom/home/available-beds.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/apex/custom/home/earnings.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/apex/custom/home/gender-age.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/apex/custom/home/claims.js') }}"></script>

<!--  DataTables (Ensure jQuery loaded before these) -->
<script src="{{ asset('DoctorArea/vendor/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('DoctorArea/vendor/datatables/custom/custom-datatables.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('DoctorArea/js/custom.js') }}"></script>

<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRxCvC_tYnWNUso0oJf-YAmRQVkh8204s&callback=initMap" async defer></script>


    <!-- Input Tags JS -->
    <script src="{{ asset('AdminArea/vendor/input-tags/tagsinput.min.js') }}"></script>
    <script src="{{ asset('AdminArea/vendor/input-tags/typeahead.js') }}"></script>
    <script src="{{ asset('AdminArea/vendor/input-tags/tagsinput-custom.js') }}"></script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRxCvC_tYnWNUso0oJf-YAmRQVkh8204s&callback=initMap" async defer></script>

<!--  Toastr Notifications -->
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
