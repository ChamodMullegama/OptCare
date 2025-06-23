<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Optcare - Admin Panel</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
     <link rel="shortcut icon" href="{{ asset('PublicArea/images/favicon.ico') }}">
    @include('AdminArea.libraries.styles')
    <title>OptCare-Admin</title>
    <!-- plugins:css -->


</head>

<body>
    <div class="page-wrapper">
        @include('AdminArea.Layout.navbar')
        <div class="main-container">
            @include('AdminArea.Layout.sideBar')
            @yield('Admincontainer')
            @include('AdminArea.Layout.footer')
            @include('AdminArea.libraries.scripts')
        </div>

    </div>
</body>

</html>
