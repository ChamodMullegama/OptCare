
<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @include('PublicArea.libraries.styles')
  <title>Ayur Assence-Admin</title>
  <!-- plugins:css -->


</head>
<body>
     <div class="boxed_wrapper">
    @include('PublicArea.Layout.navBar')
    @yield('Publiccontainer')
    @include('PublicArea.Layout.footer')
     </div>
@include('PublicArea.libraries.scripts')
</body>
</html>
