<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Gallery - Medical Admin Templates & Dashboards</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="assets/images/favicon.svg">
    @include('DoctorArea.libraries.styles')
    <title>OptCare-Admin</title>
    <!-- plugins:css -->


</head>

<body>
    <div class="page-wrapper">
        @include('DoctorArea.Layout.navbar')
        <div class="main-container">
            @include('DoctorArea.Layout.sideBar')
            @yield('Doctorcontainer')
            @include('DoctorArea.Layout.footer')
            @include('DoctorArea.libraries.scripts')
        </div>

    </div>
</body>

</html>
