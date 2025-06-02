
<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @include('AdminArea.libraries.styles')
  <title>Ayur Assence-Admin</title>
  <!-- plugins:css -->


</head>
<body>
    @include('AdminArea.Layout.sideBar')
    @yield('Admincontainer')
    @include('AdminArea.Layout.footer')

@include('AdminArea.libraries.scripts')
</body>
</html>
