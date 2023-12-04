<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewpoKADES" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shoKADEScut icon" href="../../assets/img/logounsil.png">
    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/main.css?v=1">
    <link rel="stylesheet" href="../../assets/css/administrator.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/css/all.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;700&family=Montserrat:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">

    <title>HELPDESK - ADMIN</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light py-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../assets/img/logounsil.png" width="30" height="30" class="d-inline-block align-top"
                    alt="HELPDESK">
                HELPDESK
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto text-uppercase">
                    @yield('nav')
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Layanan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">Pengajuan Surat</a>
                            <a class="dropdown-item" href="">Pengajuan Legalisasi</a>
                        </div>
                    </li> --}}
                </ul>
                <ul class="navbar-nav text-uppercase">

                    @yield('notifikasi')
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-capitalize" href="{{ route('admin.beranda') }}"><i class="bi bi-house"></i> Dashboard Informasi</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-capitalize" href="{{ route('profileadmin.index') }}"><i class="bi bi-person-circle"></i> My Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-capitalize" data-toggle="modal"
                            data-target="#exampleModal9"><i class="bi bi-box-arrow-right"></i> Logout</a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin keluar?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="{{ route('logout') }}" type="button" class="btn btn-core">Ya</a>
                </div>
            </div>
        </div>
    </div>


    <!--End of Navbar -->
    <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item">Mahasiswa</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="">Logout</a>
                            </div-->
    @yield('content')


    <!-- JS -->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/all.js"></script>

    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script src="../../assets/js/script.js"></script>
    @yield('script')

    @include('sweetalert::alert')

</body>

</html>
