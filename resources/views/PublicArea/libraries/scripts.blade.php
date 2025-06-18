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
<script src="{{ asset('PublicArea/assets/js/product-filter.js') }}"></script>
<script src="{{ asset('PublicArea/assets/js/jquery.bootstrap-touchspin.js') }}"></script>


<!-- main-js -->
<script src="{{ asset('PublicArea/js/script.js') }}"></script>

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>

<!-- Local JS files -->
<script src="{{ asset('PublicArea/js/gmaps.js') }}"></script>
<script src="{{ asset('PublicArea/js/map-helper.js') }}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRxCvC_tYnWNUso0oJf-YAmRQVkh8204s&callback=initMap" async defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


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


<script>
    (function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="r3gjzx8lXT6lm9dl8CPoL";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
    </script>

    <script>
        const crypto = require('crypto');

const secret = 'r3gjzx8lXT6lm9dl8CPoL'; // Your verification secret key
const userId = current_user.id // A string UUID to identify your user

const hash = crypto.createHmac('sha256', secret).update(userId).digest('hex');
    </script>

@stack('js')
