@extends('layouts.app')
 
@section('nav')
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('welcome') }}">Beranda</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('profil') }}">Profil</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('informasi') }}">Informasi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn" href="https://api.whatsapp.com/send/?phone=6281990550055">Helpdesk <i class="bi bi-whatsapp"></i></a>
    </li>
    <li class="nav-item">
        <a class="nav-link btn" href="{{ route('login') }}">Login</a>
    </li>

@endsection
@section('content')
    
    <section class="header">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-5">
                    <h1><span>HELPDESK</span> TEKNIK<br> Universitas Siliwangi</h1>
                    <p>Gunakan layanan dari aplikasi HELPDESK untuk melakukan pengajuan KP atau TA 
                        dengan mudah dan cepat.</p>

                        <div class="row justify-content-xl-start justify-content-center">
                        @if (Route::has('login'))
                        <div class="col-6 col-sm-5">
                                @auth        
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-core btn-block">Log in</a>
                                </div>
                                <div class="col-6 col-sm-5">
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-core btn-block">Register</a>
                                    @endif
                                @endauth
                        </div>
                        </div>
                    </div>
                    <div class="col-xl-7 d-none d-lg-block">
                        <img src="assets/img/1.png" class="img-fluid" alt="Hero Image">
                </div>
            </div>
        </div>
        @endif
    </section>

    
     <section class="feature">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col">
                    <h2>Fitur Helpdesk Fakultas Teknik</h2>
                    <p>Dengan fitur dari HELPDESK FT, mahasiswa dapat lebih menghemat waktu dalam mengurus berkas</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"> <a herf=""></a>
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-4 d-none d-sm-block" >
                            <img src="assets/img/3.png"  class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5>Pengajuan Surat KP dan TA</h5>
                            <p>Mahasiswa dapat membuat surat dengan mengisi form pengajuan online.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-4 d-none d-sm-block">
                            <img src="assets/img/13.png" class="img-fluid">
                        </div>
                        <div class="col-sm-8">
                            <h5>Pengajuan Layanan Legalisasi</h5>
                            <p>Mahasiswa dapat membuat pengajuan legalisasi secara online.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <section class="step">
        <div class="container">
            <div class="row mb-3 text-center">
                <div class="col">
                    <h2>Langkah Mudah Mengajukan Surat KP dan TA </h2>
                    <p>Silahkan ikuti langkah yang sudah kami siapkan untuk mengajukan surat.</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <figure class="figure bg-white">
                        <img src="assets/img/15.png" class="figure-img img-fluid" alt="...">
                        <figcaption class="figure-caption">
                            <h5>Login Akun</h5>
                            <p>Silahkan login dengan akun yang sudah diregistrasikan sebelumnya</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="figure bg-white">
                        <img src="assets/img/16.png" class="figure-img img-fluid" alt="...">
                        <figcaption class="figure-caption">
                            <h5>Pilih Pengajuan</h5>
                            <p>Silahkan pilih surat yang ingin diajukan dan lampirkan file sesuai persyaratan</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="figure bg-white">
                        <img src="assets/img/14.png" class="figure-img img-fluid" alt="...">
                        <figcaption class="figure-caption">
                            <h5>Tunggu Hasilnya</h5>
                            <p>Silahkan tunggu hasil pengajuan surat dan cek track record secara berkala</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    
    <section class="step">
        <div class="container">
            <div class="row mb-3 text-center">
                <div class="col">
                    <h2>Langkah Mudah Mengajukan Legalisasi</h2>
                    <p>Silahkan ikuti langkah yang sudah kami siapkan untuk mengadukan pelayanan.</p>
                </div>
            </div>
            <div class="row text-center">

                <div class="col-md-4">
                    <figure class="figure bg-white">
                        <img src="assets/img/15.png" class="figure-img img-fluid" alt="...">
                        <figcaption class="figure-caption">
                            <h5>Login Akun</h5>
                            <p>Silahkan login dengan akun yang sudah diregistrasikan sebelumnya</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="figure bg-white">
                        <img src="assets/img/17.png" class="figure-img img-fluid" alt="...">
                        <figcaption class="figure-caption">
                            <h5>Pilih Pengajuan Legalisasi</h5>
                            <p>Silahkan isi formulir pengajuan legalisasi sesuai dengan data yang dibutuhkan</p>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-md-4">
                    <figure class="figure bg-white">
                        <img src="assets/img/14.png" class="figure-img img-fluid" alt="...">
                        <figcaption class="figure-caption">
                            <h5>Tunggu Hasilnya</h5>
                            <p>Silahkan tunggu hasil pengajuan surat dan cek track record secara berkala</p>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="border-top p-3">
        <div class="container">
            <div class="row text-center mt-3">
                <div class="col text-light">
                    <p>Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.</p>
                </div>
            </div>
        </div>
    </footer>
   
@endsection
</html>
