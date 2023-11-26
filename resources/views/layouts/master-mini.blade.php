
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login & Register</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- plugins:css -->
    <link rel="stylesheet" href="/template/admin/vendors/feather/feather.css">
    <link rel="stylesheet" href="/template/admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/template/admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/template/admin/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/template/admin/images/favicon.png" />
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        @yield('content')
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="/template/admin/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/template/admin/js/off-canvas.js"></script>
<script src="/template/admin/js/hoverable-collapse.js"></script>
<script src="/template/admin/js/template.js"></script>
<script src="/template/admin/js/settings.js"></script>
<script src="/template/admin/js/todolist.js"></script>
<!-- endinject -->
</body>

</html>
