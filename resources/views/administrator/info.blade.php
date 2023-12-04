@extends('layouts.administrator')


@section('nav')

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('administrator.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('info') }}">Informasi</a>
    </li>
    <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Verifikasi Pengajuan</a>
            <div class="dropdown-menu text-capitalize" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('pengajuanpskkp') }}">Pengusulan SK Kerja Praktek</a>
                <a class="dropdown-item" href="{{ route('pengajuanskp') }}">Sidang Kerja Praktek</a>
                <a class="dropdown-item" href="{{ route('pengajuanpptakp') }}">Perpanjangan KP dan TA</a>

                <a class="dropdown-item" href="{{ route('pengajuanspta') }}">Sidang Proposal Tugas Akhir</a>
                <a class="dropdown-item" href="{{ route('pengajuanpskta') }}">Pengusulan SK Tugas Akhir</a>

                <a class="dropdown-item" href="{{ route('pengajuansemta') }}">Seminar Tugas AKhir</a>
                <a class="dropdown-item" href="{{ route('pengajuansta') }}">Sidang Tugas Akhir</a>
                <a class="dropdown-item" href="{{ route('pengajuanulkp') }}">Unggah Dokumen Laporan KP</a>
                <a class="dropdown-item" href="{{ route('pengajuanulta') }}">Unggah Dokumen Laporan TA</a>
                <a class="dropdown-item" href="{{ route('pengajuanbpit') }}">Unggah Bukti Pengambilan Ijazah dan Transkip Nilai</a>
                <a class="dropdown-item" href="{{ route('legalisasi') }}">Legalisasi Dokumen</a>
            </div>
    </li>
    {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Unggah</a>
            <div class="dropdown-menu text-capitalize" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('pengajuanulkp') }}">Unggah Dokumen Laporan KP</a>
                <a class="dropdown-item" href="{{ route('pengajuanulta') }}">Unggah Dokumen Laporan TA</a>
                <a class="dropdown-item" href="{{ route('pengajuanbpit') }}">Unggah Bukti Pengambilan Ijazah dan Transkip Nilai</a>

            </div>
    </li> --}}

@endsection

@section('content')
    <section class="slider">
        <div class="container">
            @if (isset($berita) != 0)
                <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="container">
                            @foreach ($berita as $data)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row p-5 justify-content-center d-flex align-items-center">
                                        <div class="col-lg-4 text-center">
                                            <img src="{{ Storage::url('img/' . $data->gambar) }}"
                                                class="figure-img img-fluid" alt="...">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4 class="mb-3">{{ $data->judul_berita }}</h4>
                                            <p class="mb-2">{{ Str::limit($data->detail_berita, 100, '...') }}
                                                @if (Str::length($data->detail_berita) >= 100)
                                                    <a href="#" aria-pressed="true" data-toggle="modal"
                                                        data-target="#Selengkapnya{{ $data->id }}">Selengkapnya</a>
                                                @endif
                                            </p>
                                            <div class="modal fade" id="Selengkapnya{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="SelengkapnyaLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl text-left">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mb-0" id="SelengkapnyaLabel">
                                                                {{ $data->judul_berita }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ $data->detail_berita }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <h6 class="card-header text-center">Verifikasi <br> Pengajuan Surat</h6>
                        <div class="card-body pb-0">
                            <div id="accordion2">
                                <div class="card" style="border: none;" >
                                    <h6 class="mb-0" id="pengajuanSatu">
                                        <a class="btn btn-link btn-block text-left accordion-link-custom"
                                            data-toggle="collapse" data-target="#collapsePengajuanSatu" aria-expanded="true"
                                            aria-controls="collapsePengajuanSatu">
                                            1) Langkah Pertama
                                        </a>
                                    </h6>
                                    <div id="collapsePengajuanSatu" class="collapse pt-2" aria-labelledby="pengajuanSatu"
                                        data-parent="#accordion2">
                                        Pilih menu Pengajuan pada navbar atau bisa langsung klik panah pada tiap menu pengajuan di halaman Dashboard Operator.
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="pengajuanDua">
                                        <a class="btn btn-link accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapsePengajuanDua" aria-expanded="true"
                                            aria-controls="collapsePengajuanDua">
                                            2) Langkah Kedua
                                        </a>
                                    </h5>
                                    <div id="collapsePengajuanDua" class="collapse pt-2" aria-labelledby="pengajuanDua"
                                        data-parent="#accordion2">
                                        Pilih Tab "Belum Validasi". kemudian pada bagian tabel pilih data yang statusnya
                                        belum diverifikasi atau on progress. <br><br>
                                        klik tombol Verifikasi Pengajuan. <br>
                                        - Pilih Terima permintaan jika ingin menerima pengajuan surat <br>
                                        - Pilih Tolak permintaan jika ingin menolak pengajuan surat
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="pengajuanTiga">
                                        <a class="btn btn-link accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapsePengajuanTiga" aria-expanded="true"
                                            aria-controls="collapsePengajuanTiga">
                                            3) Langkah Ketiga
                                        </a>
                                    </h5>
                                    <div id="collapsePengajuanTiga" class="collapse pt-2" aria-labelledby="pengajuanTiga"
                                        data-parent="#accordion2">
                                        Kemudian untuk data yang sudah diverifikasi akan masuk ke tab "Sudah Divalidasi" dan akan dilakukan proses pembuatan surat.
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="pengajuanEmpat">
                                        <a class="btn btn-warning accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapsePengajuanEmpat" aria-expanded="true"
                                            aria-controls="collapsePengajuanEmpat">
                                            Keterangan
                                        </a>
                                    </h5>
                                    <div id="collapsePengajuanEmpat" class="collapse pt-2" aria-labelledby="pengajuanEmpat"
                                        data-parent="#accordion2">
                                        SPTA => Sidang Proposal Tugas Akhir <br>
                                        SEMTA => Seminar Tugas Akhir <br>
                                        STA => Sidang Tugas Akhir <br>
                                        SKP => Sidang Kerja Praktik  <br>
                                        PSKKP => Pengusulan Surat Ketarangan Kerja Praktek  <br>
                                        PSKTA => Pengusulan Surat Ketarangan Tugas Akhir  <br>
                                        PPTAKP => Pengajuan Perpanjangan TA dan KP
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <a href="{{ route('administrator.beranda') }}" class="btn btn-core btn-block">Verifikasi
                                Pengajuan</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <h6 class="card-header text-center">Monitoring Daftar<br>Unggah File</h6>
                        <div class="card-body pb-0">
                            <div id="accordion3">
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="pengaduanSatu">
                                        <a class="btn btn-link btn-block text-left accordion-link-custom"
                                            data-toggle="collapse" data-target="#collapsePengaduanSatu" aria-expanded="true"
                                            aria-controls="collapsePengaduanSatu">
                                            1) Langkah Pertama
                                        </a>
                                    </h5>
                                    <div id="collapsePengaduanSatu" class="collapse pt-2" aria-labelledby="pengaduan"
                                        data-parent="#accordion3">
                                        Pilih menu Pengajuan pada navbar atau bisa langsung klik panah pada menu unggah dokumen di halaman Dashboard Operator.
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="pengaduanDua">
                                        <a class="btn btn-link accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapsePengaduanDua" aria-expanded="true"
                                            aria-controls="collapsePengaduanDua">
                                            2) Langkah Kedua
                                        </a>
                                    </h5>
                                    <div id="collapsePengaduanDua" class="collapse pt-2" aria-labelledby="pengaduanDua"
                                        data-parent="#accordion3">
                                        Pilih menu unggah yang akan dicek.<br><br>
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="pengaduanTiga">
                                        <a class="btn btn-link accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapsePengaduanTiga" aria-expanded="true"
                                            aria-controls="collapsePengaduanTiga">
                                            3) Langkah Ketiga
                                        </a>
                                    </h5>
                                    <div id="collapsePengaduanTiga" class="collapse pt-2" aria-labelledby="pengaduanTiga"
                                        data-parent="#accordion3">
                                        Kemudian lihat detail datanya untuk mengetahui kelengkapan data yang di unggah mahasiswa.
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="pengaduanEmpat">
                                        <a class="btn btn-warning accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapsePengaduanEmpat" aria-expanded="true"
                                            aria-controls="collapsePengaduanEmpat">
                                            Keterangan
                                        </a>
                                    </h5>
                                    <div id="collapsePengaduanEmpat" class="collapse pt-2" aria-labelledby="pengaduanEmpat"
                                        data-parent="#accordion3">
                                        Unggah laporan ada 3 menu diantaranya: <br>
                                        ULKP => Unggah Laporan Kerja Praktek<br>
                                        ULTA => Unggah Laporan Tugas Akhir <br>
                                        BPIT => Unggah Bukti Pengambilan Ijazah dan Transkip Nilai
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <a href="{{ route('administrator.beranda') }}" class="btn btn-core btn-block">Monitoring
                                Daftar File</a>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4">
                    <div class="card shadow-sm">
                        <h6 class="card-header text-center">Legalisasi <br>Dokumen </h6>
                        <div class="card-body pb-0">
                            <div id="accordion4">
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="legalisasiSatu">
                                        <a class="btn btn-link btn-block text-left accordion-link-custom"
                                            data-toggle="collapse" data-target="#collapseLegalisasiSatu" aria-expanded="true"
                                            aria-controls="collapseLegalisasiSatu">
                                            1) Langkah Pertama
                                        </a>
                                    </h5>
                                    <div id="collapseLegalisasiSatu" class="collapse pt-2" aria-labelledby="legalisasi"
                                        data-parent="#accordion4">
                                        Pilih menu Pengajuan pada navbar atau bisa langsung klik panah pada menu unggah dokumen di halaman Dashboard Operator.
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="legalisasiDua">
                                        <a class="btn btn-link accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapseLegalisasiDua" aria-expanded="true"
                                            aria-controls="collapseLegalisasiDua">
                                            2) Langkah Kedua
                                        </a>
                                    </h5>
                                    <div id="collapseLegalisasiDua" class="collapse pt-2" aria-labelledby="legalisasiDua"
                                        data-parent="#accordion4">
                                        Pilih Tab "Belum Validasi". kemudian pada bagian tabel pilih data yang statusnya
                                        belum diverifikasi atau on progress. <br><br>
                                        klik tombol Verifikasi Pengajuan. <br>
                                        - Pilih Terima permintaan jika ingin menerima pengajuan surat <br>
                                        - Pilih Tolak permintaan jika ingin menolak pengajuan surat
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="legalisasiTiga">
                                        <a class="btn btn-link accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapseLegalisasiTiga" aria-expanded="true"
                                            aria-controls="collapseLegalisasiTiga">
                                            3) Langkah Ketiga
                                        </a>
                                    </h5>
                                    <div id="collapseLegalisasiTiga" class="collapse pt-2" aria-labelledby="legalisasiTiga"
                                        data-parent="#accordion4">
                                        Kemudian lihat detail datanya untuk mengetahui kelengkapan data yang di unggah mahasiswa.
                                    </div>
                                </div>
                                <div class="card mb-0" style="border: none;">
                                    <h5 class="mb-0" id="legalisasiEmpat">
                                        <a class="btn btn-warning accordion-link-custom" data-toggle="collapse"
                                            data-target="#collapseLegalisasiEmpat" aria-expanded="true"
                                            aria-controls="collapseLegalisasiEmpat">
                                            Keterangan
                                        </a>
                                    </h5>
                                    <div id="collapseLegalisasiEmpat" class="collapse pt-2" aria-labelledby="legalisasiEmpat"
                                        data-parent="#accordion4">
										Legalisasi dokumen merupakan legalisir yang dilakukan pada file fotocopy
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer py-4">
                            <a href="{{ route('administrator.beranda') }}" class="btn btn-core btn-block">Verifikasi Legalisasi
                                Dokumen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        {{-- <div class="footer text-center">
            Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.
        </div> --}}

        <footer class="footer p-3">
            <div class="container">
                <div class="row text-center mt-3">
                    <div class="col ml-auto text-center">
                        <p>Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </section>
@endsection

