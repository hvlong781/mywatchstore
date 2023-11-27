<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @include('admin.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                @include('admin.alert')

                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>
                </div>

                @yield('content')

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            @include('admin.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('admin.foot')
</body>

</html>
