<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="mx-3 sidebar-brand-text">Code Lab Studio</div>
            </a>

            <!-- Divider -->
            <hr class="my-0 sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-fw fa-table"></i><span>Dashboard </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('categoryList') }}"><i
                        class="fa-solid fa-circle-plus"></i></i><span>Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-sitemap"></i></i><span>Add Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('productListPage') }}"><i class="fa-solid fa-layer-group"></i><span>Product Details
                    </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('createProduct') }}"><i class="fa-solid fa-plus"></i></i><span>Add Item </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('paymentList')}}"><i class="fa-solid fa-credit-card"></i></i><span>Payment Method
                    </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-list"></i><span>Sale Information </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><span>Order Board
                    </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-gear"></i></i><span>Setting </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('changePasswordPage') }}"><i
                        class="fa-solid fa-lock"></i></i></i><span>Change Password
                    </span></a>
            </li>

            <li class="nav-item">
                {{-- <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket"></i></i><span>Logout </span></a> --}}
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket"></i></i>
                        <button type="submit" class="btn btn-primary">Logout</button></a>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="mb-4 bg-white shadow navbar navbar-expand navbar-light topbar static-top">



                    <!-- Topbar Navbar -->
                    <ul class="ml-auto navbar-nav">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 text-gray-600 d-none d-lg-inline small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset(Auth::user()->profile == null ? 'admin/img/undraw_profile.svg' : 'storage/profile/' . Auth::user()->profile) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="shadow dropdown-menu dropdown-menu-right animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('accountProfile') }}">
                                    <i class="mr-2 text-gray-400 fas fa-user fa-sm fa-fw"></i>
                                    Profile
                                </a>
                                @if (Auth::user()->role == 'superadmin')
                                    <a class="dropdown-item" href="{{ route('newAdminPage') }}">
                                        <i class="mr-2 text-gray-400 fa-solid fa-user-plus"></i>
                                        Add New Admin
                                    </a>
                                    <a class="dropdown-item" href="{{ route("adminListPage") }}">
                                        <i class="mr-2 text-gray-400 fa-solid fa-users"></i>
                                        Admin List
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route("userListPage") }}">
                                    <i class="mr-2 text-gray-400 fa-solid fa-users"></i>
                                    User List
                                </a>
                                <a class="dropdown-item" href="{{ route('changePasswordPage') }}">
                                    <i class="mr-2 text-gray-400 fa-solid fa-lock fa-sm fa-fw"></i></i></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <input type="submit" value="Logout" class="text-white w-100 btn btn-dark">
                                    </form>
                                </span>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')

                @include('sweetalert::alert')


                <!-- Scroll to Top Button-->
                <a class="rounded scroll-to-top" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current
                                session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="login.html">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap core JavaScript-->
                <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
                <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

                <!-- Core plugin JavaScript-->
                <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

                <!-- Custom scripts for all pages-->
                <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

                <!-- Page level plugins -->
                <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

                <!-- Page level custom scripts -->
                <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
                <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>

                <!--image preview javascript -->
                <script>
                    var loadFile = function(event) {
                        // Get the img element by id
                        var output = document.getElementById('previewImage');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                            URL.revokeObjectURL(output.src); // Free memory
                        };
                    };
                </script>
</body>

</html>
