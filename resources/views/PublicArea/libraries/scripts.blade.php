<!-- jQuery plugins -->
<script src="{{ asset('PublicArea/js/jquery.js') }}"></script>
<script src="{{ asset('PublicArea/js/popper.min.js') }}"></script>
<script src="{{ asset('PublicArea/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('PublicArea/js/owl.js') }}"></script>
<script src="{{ asset('PublicArea/js/wow.js') }}"></script>
<script src="{{ asset('PublicArea/js/validation.js') }}"></script>
<script src="{{ asset('PublicArea/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('PublicArea/js/appear.js') }}"></script>
<script src="{{ asset('PublicArea/js/scrollbar.js') }}"></script>
<script src="{{ asset('PublicArea/js/isotope.js') }}"></script>
<script src="{{ asset('PublicArea/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('PublicArea/js/jquery-ui.js') }}"></script>
<script src="{{ asset('PublicArea/js/text_animation.js') }}"></script>
<script src="{{ asset('PublicArea/js/text_plugins.js') }}"></script>
<script src="{{ asset('PublicArea/js/jquery.countTo.js') }}"></script>
<script src="{{ asset('PublicArea/js/calander.js') }}"></script>


<!-- main-js -->
<script src="{{ asset('PublicArea/js/script.js') }}"></script>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>

<!-- Local JS files -->
<script src="{{ asset('PublicArea/js/gmaps.js') }}"></script>
<script src="{{ asset('PublicArea/js/map-helper.js') }}"></script>

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
