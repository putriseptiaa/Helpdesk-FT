@extends('layouts.administrator')


@section('nav')

    <li class="nav-item active" style="color: #446084">
        <a class="nav-link" href="{{ route('administrator.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('info') }}">Informasi</a>
    </li>
    <li class="nav-item dropdown active">
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

{{-- @section('notifikasi')
    <li class="nav-item dropdown text-lowercase">
        @php
            $jumlah = 0;
        @endphp
        @if(isset($notif))
        @foreach ($notif as $data)
            @php
                $jumlah = $jumlah + $data->jumlah;
            @endphp
        @endforeach
        @endif
        <a class="nav-link " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-bell"></i> <span class="badge badge-pill badge-core">{{ $jumlah }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="transform: translateX(-39%);">

            @if(isset($notif))
            @foreach ($notif as $data)
                @if ($data->jumlah != '0')
                    {{-- @if($data->jenis == "Pengaduan")
                        <a href="{{ route('daftar_pengaduan') }}" class="dropdown-item"><span
                                class="badge badge-pill badge-core">{{ $data->jumlah }} </span> {{ $data->pesan }}</a> 
                    @if($data->jenis == "Pengajuan")
                        <a href="{{ route('pengajuanspta') }}" class="dropdown-item"><span
                                class="badge badge-pill badge-core">{{ $data->jumlah }} </span> {{ $data->pesan }}</a>
                    @endif
                @endif
            @endforeach
            @endif
            @if ($jumlah == '0')

                <p style="margin: 10px"> Belum ada pemberitahuan </p>
            @endif

        </div>
    </li>
@endsection --}}

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
            <div class="card shadow-sm">
            <div class="card-body">
                <h6>Welcome, Admin {{ Auth::user()->name }}!</h6>
                <h6>Verifikasi Pengajuan Mahasiswa</h6> 
            <div class="row">
                  <div class="col-lg-4">
                    <div class="card-user">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-people-fill"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Kelola</div>
                                <div class="card-desc">User</div>
                                <div class="card-call">{{ $user }} <a href="{{ route('daftar_user') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
           
                
                <div class="col-lg-4">
                    <div class="card-pengajuan ppskkp">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-folder-check"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Pengajuan</div>
                                <div class="card-desc">Pengusulan</div>
                                <div class="card-desc">SK KP</div>
                                <div class="card-call">{{ $pengajuanppskkp }} <a href="{{ route('pengajuanpskkp') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-4">
                    <div class="card-pengajuan skp">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-folder2-open"></i></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Pengajuan</div>
                                <div class="card-desc">Sidang KP</div>
                                <div class="card-call">{{ $pengajuanskp }} <a href="{{ route('pengajuanskp') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-4">
                    <div class="card-pengajuan pptakp">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-folder2-open"></i></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Pengajuan</div>
                                <div class="card-desc">Perpanjangan</div>
                                <div class="card-desc">KP dan TA</div>
                                <div class="card-call">{{ $pengajuanpptakp }} <a href="{{ route('pengajuanpptakp') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div> 
                
                <div class="col-lg-4">
                    <div class="card-pengajuan spta">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-folder-check"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Pengajuan</div>
                                <div class="card-desc">Sidang</div>
                                <div class="card-desc">Proposal TA</div>
                                <div class="card-call">{{ $pengajuanspta }} <a href="{{ route('pengajuanspta') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-pengajuan spta">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-folder-check"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Pengajuan</div>
                                <div class="card-desc">Pengusulan</div>
                                <div class="card-desc">SK TA</div>
                                <div class="card-call">{{ $pengajuanpskta }} <a href="{{ route('pengajuanpskta') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-pengajuan semta">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-folder2-open"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Pengajuan</div>
                                <div class="card-desc">Seminar TA</div>
                                <div class="card-call">{{ $pengajuansemta }} <a href="{{ route('pengajuansemta') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-4">
                    <div class="card-pengajuan sta">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-folder-check"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Pengajuan</div>
                                <div class="card-desc">Sidang TA</div>
                                <div class="card-call">{{ $pengajuansta }} <a href="{{ route('pengajuansta') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div> 
                
                
                <div class="col-lg-4">
                    <div class="card-pengajuan legalisasi">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-folder-check"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Legalisasi</div>
                                <div class="card-desc">Dokumen</div>
                                <div class="card-call">{{ $legalisasi }} <a href="{{ route('legalisasi') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        </div>
    </div>
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Daftar Unggah File</h6> 
                <div class="row">
                <div class="col-lg-4">
                    <div class="card-pengajuan ulkp">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-journals"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Unggah</div>
                                <div class="card-desc">Laporan KP</div>
                                <div class="card-call">{{ $pengajuanulkp }} <a href="{{ route('pengajuanulkp') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="col-lg-4">
                    <div class="card-pengajuan ulta">
                        <div class="row">
                            <div class="col-6"><i class="bi bi-journals"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Unggah</div>
                                <div class="card-desc">Laporan TA</div>
                                <div class="card-call">{{ $pengajuanulta }} <a href="{{ route('pengajuanulta') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-4">
                    <div class="card-pengajuan bpit">
                       <div class="row">
                            <div class="col-6"><i class="bi bi-journals"></i></div>
                            <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                                <div class="card-desc">Unggah Bukti</div>
                                <div class="card-desc">Pengambilan</div>
                                <div class="card-desc">Ijazah dan</div>
                                <div class="card-desc">Transkip Nilai</div>
                                <div class="card-call">{{ $pengajuanbpit }} <a href="{{ route('pengajuanbpit') }}" style="color: #fff"><i class="bi bi-arrow-right-square-fill"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            </div>
            </div>
        </div>
    </section>
    
   
       
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

