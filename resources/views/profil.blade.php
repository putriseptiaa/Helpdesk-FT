@extends('layouts.app')


@section('nav')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('welcome') }}">Beranda</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('profil') }}">Profil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('informasi') }}">Informasi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://api.whatsapp.com/send/?phone=6281990550055">Helpdesk <i class="bi bi-whatsapp"></i></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>

@endsection
@section('content')
    <!-- Header -->
    <section class="header">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-12 text-center">
                    <h1><span>PROFIL FAKULTAS TEKNIK UNIVERSITAS SILIWANGI</span></h1>
                    <!--<p>Universitas Siliwangi.</p>-->
                </div>
            </div>
        </div>
    </section>
    <!-- End of Header -->

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <!-- <img src="../assets/img/daerah.png" alt="" class="img-fluid mb-4" width="100%"> -->

                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-coree  btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Sejarah Singkat 
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <strong>Sejarah Singkat</strong> <br>Fakultas Teknik Universitas Siliwangi didirikan dalam upaya memenuhi hasrat dan keinginan masyarakat Priangan Timur, khususnya Kabupaten Tasikmalaya terhadap adanya pendidikan tinggi bidang teknologi. Universitas Siliwangi melalui FKIP Universitas Siliwangi pada tahun 
                                            akademik 1983/1984 membuka Program Studi Pendidikan Teknik Sipil. Pembukaan program studi ini merupakan cikal bakal lahirnya Fakultas Teknik Universitas Siliwangi.<br><br>
                                            Fakultas Teknik Universitas Siliwangi diresmikan dengan Surat Keputusan Ketua Badan Pengurus Yayasan Universitas Siliwangi Nomor Skep.128/YUS/12/1984 tanggal 31 Desember 1984 untuk program pendidikan sarjana (S-1) dalam jurusan: 1) Teknik Sipil dan 2) Teknik Elektro. Selanjutnya, pada tahun 1987, Fakultas Teknik Universitas Siliwangi mendapat status terdaftar dengan Surat Keputusan Menteri Pendidikan dan Kebudayaan Republik Indonesia nomor : <br>
                                            <ul>
                                                <li>
                                                    0269/0/1987, tanggal 6 Mei 1987, tentang Pemberian Status Terdaftar kepada jurusan/ program studi Teknik Sipil pada Fakultas Teknik di lingkungan Universitas Siliwangi di Tasikmalaya.
                                                </li>
                                                <li>
                                                    0434/0/1987, tanggal 23 Juli 1987, tentang Pemberian Status Terdaftar kepada jurusan/ program studi Teknik Elektro pada Fakultas Teknik di lingkungan Universitas Siliwangi di Tasikmalaya.
                                                </li>
                                            </ul>
                                            Pada tahun 2000, kedua jurusan yang dikaji di Fakultas Teknik ini telah mendapatkan status Terakreditasi. 
                                            Pada perkembangan selanjutnya, pada tahun 2003 telah berdiri Program Studi Informatika Fakultas Teknik Universitas Siliwangi dengan surat Keputusan Direktorat Jenderal Pendidikan Tinggi Departemen Pendidikan Nasional Republik Indonesia Nomor : 3885/D/T2003 tanggal 5 Desember 2003. 
                                            Hingga pada tahun 2014 terjadi perubahan status menjadi PTN/Satker  dengan Perpres No. 24/2014.<br><br>
                                            Sampai pada perkembangan yang terbaru dimana pada tahun 2023 berdiri Program Studi Sistem Informasi serta Terakreditasi Baik
                                            pada tanggal 11 Maret 2022 sesuai dengan SK Nomor 4086/SK/BAN-PT/PB-PS/S/VII/2022.
                                            <br><br>
                                            Minat masyarakat akan pendidikan dari tahun ke tahun terus meningkat, sehingga daya tampung dan kemampuan penyelenggaraan pendidikan pun harus lebih ditingkatkan. Keadaan ini tidak saja disadari secara khusus oleh Fakultas TeknikUniversitas Siliwangi, tetapi secara umum juga disadari oleh pemerintah.
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-coree btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                Visi & Misi
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <strong>VISI:</strong> <br> “Menjadi Fakultas Teknik yang tangguh untuk membentuk lulusan unggul yang berwawasan kebangsaan dan berjiwa wirausaha di tingkat nasional tahun 2026”. <br><br>
                                            <strong>MISI:</strong> <br>
                                            <ul>
                                                <li>
                                                    Menyelenggarakan pendidikan di bidang teknik untuk menghasilkan lulusan yang berwawasan kebangsaan dan berjiwa wirausaha.
                                                </li>
                                                <li>
                                                    Menyelenggarakan penelitian di bidang teknik yang menghasilkan ilmu pengetahuan dan teknologi untuk kepentingan bangsa.
                                                </li>
                                                <li>
                                                    Menyelenggarakan pengabdian kepada masyarakat melalui implementasi hasil penelitian. 
                                                </li>
                                                <li>
                                                    Menghasilkan jejaring kerja sama dengan berbagai pihak untuk meningkatkan mutu Tridharma Perguruan Tinggi. 
                                                </li>
                                                <li>
                                                    Menerapkan prinsip good governance untuk tata kelola fakultas. 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-coree btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                Tujuan & Sasaran
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <strong>Tujuan:</strong> <br>
                                            <ul>
                                                <li>
                                                    Meningkatkan kualitas penyelenggaraan pendidikan untuk menghasilkan lulusan yang kreatif, berjiwa wirausaha dan kompeten dalam bidang kerekayasaan.
                                                </li>
                                                <li>
                                                    Meningkatkan kualitas penelitian yang inovatif berbasis kearifan lokal untuk kepentingan nasional.
                                                </li>
                                                <li>
                                                    Melaksanakan pengabdian kepada masyarakat untuk meningkatkan kemandirian dan daya saing masyarakat.
                                                </li>
                                                <li>
                                                    Menghasilkan jejaring kerja sama dengan berbagai pihak untuk meningkatkan mutu Tridharma Perguruan Tinggi.
                                                </li>
                                                <li>
                                                    Menerapkan prinsip good governance untuk tata kelola fakultas.
                                                </li>
                                            </ul>
                                            <strong>Sasaran:</strong> <br>
                                            <ul>
                                                <li>
                                                    Menghasilkan lulusan mahasiswa Fakultas Teknik yang berkualitas dengan capaian indikator indek prestasi kumulatif tinggi (≥ 3.0) dengan lama masa studi tepat waktu 4 tahun. 
                                                </li>
                                                <li>
                                                    Peningkatan mutu atmosfir akademik di setiap Prodi.
                                                </li>
                                                <li>
                                                    Peningkatan soft skill lulusan yang unggul dan bersaing di tingkat nasional.
                                                </li>
                                                <li>
                                                    Peningkatan jumlah publikasi ilmiah hasil penelitian dosen di jurnal nasional terakreditasi dan internasional yang bereputasi.
                                                </li>
                                                <li>
                                                    Terpenuhinya rasio ideal mahasiswa dan dosen di setiap program studi.
                                                </li>
                                                <li>
                                                    Pengembangan ruang dan fasilitas belajar, alat peraga, laboratorium, penelitian dan prasarana pembelajaran.
                                                </li>
                                                <li>
                                                    Pengembangan sistem manajemen mutu terpadu meliputi penetapan standar layanan, Monitoring, Asesmen dan Evaluasi (MAE) yang efektif dan efisien yang didukung teknologi informasi yang handal.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button class="btn btn-coree btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                Struktur Organisasi 
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <strong>Struktur Organisasi Fakultas Teknik Universitas Siliwangi Periode Tahun 2023</strong> 
                                            <br><br><img src="assets/img/strukturorganisasi.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    <!-- footer -->
    <footer class="border-top p-3">
        <div class="container">
            <div class="row text-center mt-3">
                <div class="col text-light">
                    <p>Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
@endsection
