@extends('layouts.spta')

@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="">Pengajuan Sidang Tugas Akhir</a>
    </li>
@endsection

@section('content')
    <section class="card-feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Formulir Pengajuan Sidang TA</h5>
                                <div class="card-body">
                                    <label for="exampleFormControlSelect1">Silahkan isi formulir pengajuan sidang tugas
                                        akhir sesuai dengan persyaratan yang dibutuhkan</label>
                                    <form method="POST" action="{{ route('pengajuanstastore') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="form-control" id="created_by" name="created_by"
                                            value="{{ Auth::id() }}">
                                        {{-- @if ($message = Session::get('usernotfound'))
                                <div class="alert alert-danger alert-block">
                                    {{-- <button type="button" class="close" data-dismiss="alert">×</button> --}}
                                        {{-- <strong>{{ $message }}</strong>
                                </div>
                            @endif --}}
                                        <div class="form-group">
                                            <label for="email"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                            <div class="col-md-12">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="" required autocomplete="email" autofocus>
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="nama"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>

                                            <div class="col-md-12">
                                                <input id="nama" type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                                    value="" required autocomplete="nama">
                                            </div>
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="nohp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('No Handphone(No HP/WA yang dapat dihubungi)') }}</label>

                                            <div class="col-md-12">
                                                <input id="nohp" type="tel" pattern="(\+62|62|0)8[1-9][0-9]{6,10}$"
                                                    class="form-control @error('nohp') is-invalid @enderror" name="nohp"
                                                    required autocomplete="nohp" placeholder="contoh : 081234123789">
                                            </div>
                                            @error('nohp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="nim"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nomor Induk Mahasiswa (NIM/NPM)') }}</label>

                                            <div class="col-md-12">
                                                <input id="nim" type="text" minlength="9" maxlength="9"
                                                    class="form-control @error('nim') is-invalid @enderror" name="nim"
                                                    required autocomplete="nim" placeholder="">
                                            </div>
                                            @error('nim')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Jurusan') }}</label>

                                            <div class="col-md-12">
                                                <select id="jurusan" type="text"
                                                    class="form-control @error('jurusan') is-invalid @enderror"
                                                    name="jurusan" required autocomplete="jurusan" placeholder="">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="sipil">Teknik Sipil</option>
                                                    <option value="elektro">Teknik Elektro</option>
                                                    <option value="informatika">Informatika</option>
                                                    <option value="sistem_informasi">Sistem Informasi</option>
                                                </select>
                                            </div>
                                            @error('jurusan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_surat"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Jenis Pengajuan Surat') }}</label>
                                            <div class="col-md-12">
                                                <select id="jenis_surat" type="text" class="form-control"
                                                    name="jenis_surat" required autocomplete="jenis_surat" placeholder="">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="sta">Pengajuan Sidang TA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_pengajuan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Tanggal Pengajuan') }}</label>

                                            <div class="col-md-12">
                                                <input id="tgl_pengajuan" type="date"
                                                    class="form-control @error('tgl_pengajuan') is-invalid @enderror"
                                                    name="tgl_pengajuan" required autocomplete="tgl_pengajuan">
                                            </div>
                                            @error('tgl_pengajuan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="nm_pembimbing1"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nama Pembimbing 1') }}</label>

                                            <div class="col-md-12">
                                                <input id="nm_pembimbing1" type="text"
                                                    class="form-control @error('nm_pembimbing1') is-invalid @enderror"
                                                    name="nm_pembimbing1" required autocomplete="nm_pembimbing1">
                                            </div>
                                            @error('nm_pembimbing1')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="nm_pembimbing2"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nama Pembimbing 2') }}</label>

                                            <div class="col-md-12">
                                                <input id="nm_pembimbing2" type="text"
                                                    class="form-control @error('nm_pembimbing2') is-invalid @enderror"
                                                    name="nm_pembimbing2" required autocomplete="nm_pembimbing2">
                                            </div>
                                            @error('nm_pembimbing2')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="uppersta"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Pilih Bukti Persetujuan Sidang') }}</label>

                                            <div class="col-md-12">
                                                <select id="uppersta" type="text"
                                                    class="form-control @error('uppersta') is-invalid @enderror"
                                                    name="uppersta" required autocomplete="uppersta">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="punya">Sudah punya formulir fisik yang sudah di ttd
                                                        pembimbing</option>
                                                    <option value="belum_punya">Belum punya formulir fisik</option>
                                                </select>
                                            </div>
                                            @error('uppersta')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="card-header">
                                            Jika sudah punya bukti persetujuan sidang
                                            silahkan upload foto formulir permohonan sidang
                                        </div>
                                        <div class="form-group">
                                            <label for="for_ta"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Foto Formulir Permohonan TA (TTD Pembimbing 1 dan 2)') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="for_ta" type="file"
                                                        class="custom-file-input @error('for_ta') is-invalid @enderror"
                                                        name="for_ta" autocomplete="for_ta" accept="image/*">
                                                    <label class="custom-file-label" for="customFile">Format File berupa
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('for_ta')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="card-header"> 
                                            Jika belum punya silahkan upload bukti persetujuan pembimbing 1 dan 2
                                            berupa screenshoot persetujuan memalui WA, email, atau media digital lain.
                                            <br> Screenshoot harus memperlihatkan kalimat persetujuan dan nama atau nomor akun
                                            beserta foto profile dosen pembimbing.
                                        </div>
                                        <div class="form-group">
                                            <label for="upper_pembimbing1"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Bukti Persetujuan Pembimbing 1') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="upper_pembimbing1" type="file"
                                                        class="custom-file-input @error('upper_pembimbing1') is-invalid @enderror"
                                                        name="upper_pembimbing1" autocomplete="upper_pembimbing1"
                                                        accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('upper_pembimbing1')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="upper_pembimbing2"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Bukti Persetujuan Pembimbing 2') }}</label>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="upper_pembimbing2" type="file"
                                                        class="custom-file-input @error('upper_pembimbing2') is-invalid @enderror"
                                                        name="upper_pembimbing2" autocomplete="upper_pembimbing2"
                                                        accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('upper_pembimbing2')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="sk_pembimbingta"
                                                class="col-md-12 col-form-label text-md-end">{{ __('SK Pembimbing Tugas Akhir') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="sk_pembimbingta" type="file"
                                                        class="custom-file-input @error('sk_pembimbingta') is-invalid @enderror"
                                                        name="sk_pembimbingta" required autocomplete="sk_pembimbingta"
                                                        placeholder="" accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('sk_pembimbingta')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="transkip"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Transkip Nilai (tidak perlu diTTD)') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="transkip" type="file"
                                                        class="custom-file-input @error('transkip') is-invalid @enderror"
                                                        name="transkip" required autocomplete="transkip" placeholder=""
                                                        accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('transkip')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="buksum_artikel"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Bukti Submit Artikel Jurnal') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="buksum_artikel" type="file"
                                                        class="custom-file-input @error('buksum_artikel') is-invalid @enderror"
                                                        name="buksum_artikel" required autocomplete="buksum_artikel"
                                                        placeholder="" accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('buksum_artikel')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="lembar_revisi_seminar"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Lembar Revisi Seminar') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="lembar_revisi_seminar" type="file"
                                                        class="custom-file-input @error('lembar_revisi_seminar') is-invalid @enderror"
                                                        name="lembar_revisi_seminar" required
                                                        autocomplete="lembar_revisi_seminar" placeholder=""
                                                        accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('lembar_revisi_seminar')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="draft_ta"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Draft Laporan TA (max 10 mb)') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="draft_ta" type="file"
                                                        class="custom-file-input @error('draft_ta') is-invalid @enderror"
                                                        name="draft_ta" required autocomplete="draft_ta" placeholder=""
                                                        accept=".doc,.pdf,.docx,application/msword">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Document <= 10 MB, meskipun disetting 100 MB</label>
                                                </div>
                                            </div>
                                            @error('draft_ta')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="bukbayar_ukt"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Bukti Pembayaran UKT') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="bukbayar_ukt" type="file"
                                                        class="custom-file-input @error('bukbayar_ukt') is-invalid @enderror"
                                                        name="bukbayar_ukt" required autocomplete="bukbayar_ukt"
                                                        placeholder="" accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('bukbayar_ukt')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="tes_telp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Bukti Tes Telp (Nilai Minimal 400)') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="tes_telp" type="file"
                                                        class="custom-file-input @error('tes_telp') is-invalid @enderror"
                                                        name="tes_telp" required autocomplete="tes_telp" placeholder=""
                                                        accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('tes_telp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="cek_plagiat"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Cek Plagiarisme (Maksimal 30%)') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="cek_plagiat" type="file"
                                                        class="custom-file-input @error('cek_plagiat') is-invalid @enderror"
                                                        name="cek_plagiat" required autocomplete="cek_plagiat"
                                                        placeholder="" accept=".pdf">
                                                    <label class="custom-file-label" for="customFile">Format File
                                                        PDF</label>
                                                </div>
                                            </div>
                                            @error('cek_plagiat')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                           <div class="form-group">
                                            <label for="kerja"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Sudah bekerja atau belum') }}</label>

                                            <div class="col-md-12">
                                                <select id="text" type="kerja"
                                                    class="form-control @error('kerja') is-invalid @enderror"
                                                    name="kerja" required autocomplete="kerja">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="sudah">Sudah</option>
                                                    <option value="belum">Belum</option>
                                                </select>
                                            </div>
                                            @error('kerja')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="card-header">
                                            {{ __('Jika sudah bekerja mohon isi data dibawah ini untuk melengkapi Indikator Kinerja Utama (IKU) Fakultas Teknik Universitas Siliwangi') }}
                                        </div>
                                     
                                        <div class="form-group">
                                            <label for="jabatan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Jabatan di Instansi/ Perusahaan/ Wirausaha') }}</label>

                                            <div class="col-md-12">
                                                <input id="text" type="jabatan"
                                                    class="form-control @error('jabatan') is-invalid @enderror"
                                                    name="jabatan" autocomplete="jabatan">
                                            </div>
                                            @error('jabatan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="nm_perusahaan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nama Instansi/ Perusahaan/ Wirausaha') }}</label>

                                            <div class="col-md-12">
                                                <input id="nm_perusahaan" type="text"
                                                    class="form-control @error('nm_perusahaan') is-invalid @enderror"
                                                    name="nm_perusahaan" autocomplete="nm_perusahaan">
                                            </div>
                                            @error('nm_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_perusahaan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Alamat Instansi/ Perusahaan/ Wirausaha') }}</label>

                                            <div class="col-md-12">
                                                <input id="alamat_perusahaan" type="text"
                                                    class="form-control @error('alamat_perusahaan') is-invalid @enderror"
                                                    name="alamat_perusahaan" autocomplete="alamat_perusahaan">
                                            </div>
                                            @error('alamat_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_perjanjiankerja"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Jenis Perjanjian Kerja atau Jenis Wirausaha') }}</label>

                                            <div class="col-md-12">
                                                <select id="jenis_perjanjiankerja" type=""
                                                    class="form-control @error('jenis_perjanjiankerja') is-invalid @enderror"
                                                    name="jenis_perjanjiankerja" autocomplete="jenis_perjanjiankerja">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="pns">PNS</option>
                                                    <option value="pppk">PPPK</option>
                                                    <option value="k_tetap">Karyawan Tetap</option>
                                                    <option value="k_honorer">Karyawan Honorer</option>
                                                    <option value="k_paruhwaktu">Karyawan Paruh Waktu</option>
                                                    <option value="per_individu">Wirausaha Perusahaan Perseorangan</option>
                                                    <option value="per_firma">Wirausaha Perusahaan Berbentuk Firma</option>
                                                    <option value="per_cv">Wirausaha Perusahaan Berbentuk CV</option>
                                                    <option value="per_pt">Wirausaha Perusahaan Berbentuk PT</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            @error('jenis_perjanjiankerja')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_mulai"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Tanggal Mulai Bekerja') }}</label>

                                            <div class="col-md-12">
                                                <input id="tgl_mulai" type="date"
                                                    class="form-control @error('tgl_mulai') is-invalid @enderror"
                                                    name="tgl_mulai" autocomplete="tgl_mulai">
                                            </div>
                                            @error('tgl_mulai')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="gaji"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Rentang Gaji / Penghasilan') }}</label>

                                            <div class="col-md-12">
                                                <select id="gaji" type=""
                                                    class="form-control @error('gaji') is-invalid @enderror"
                                                    name="gaji" autocomplete="gaji">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="gaji1">Di bawah Rp. 1 Juta</option>
                                                    <option value="gaji2">Rp. 1 Juta - Rp. 2 Juta</option>
                                                    <option value="gaji3">Rp. 2 Juta - Rp. 3 Juta</option>
                                                    <option value="gaji4">Di atas Rp. 3 Juta</option>
                                                </select>
                                            </div>
                                            @error('gaji')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="email_perusahaan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Email Instansi/ Perusahaan/ Wirausaha') }}</label>

                                            <div class="col-md-12">
                                                <input id="email_perusahaan" type="email"
                                                    class="form-control @error('email_perusahaan') is-invalid @enderror"
                                                    name="email_perusahaan" autocomplete="email_perusahaan">
                                            </div>
                                            @error('email_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="notelp_perusahaan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nomor Telepon Instansi/ Perusahaan/ Wirausaha') }}</label>

                                            <div class="col-md-12">
                                                <input id="notelp_perusahaan" type="tel" pattern="(\+62|62|0)8[1-9][0-9]{6,10}$"
                                                    class="form-control @error('notelp_perusahaan') is-invalid @enderror"
                                                    name="notelp_perusahaan" autocomplete="notelp_perusahaan" placeholder="contoh : 081234123789">
                                            </div>
                                            @error('notelp_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="pernyataan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Apakah data yang Anda inputkan adalah data yang sebenar-benarnya') }}</label>

                                            <div class="col-md-12">
                                                <select id="pernyataan" type="text"
                                                    class="form-control @error('pernyataan') is-invalid @enderror"
                                                    name="pernyataan" autocomplete="pernyataan" required>
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="benar">Ya, benar</option>
                                                    <option value="tidak_benar">Tidak benar</option>
                                                </select>
                                            </div>
                                            @error('pernyataan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>

                                        {{-- <div class="form-group">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>


                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            </div> --}}

                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-core btn-block">
                                                {{ __('Submit') }}
                                            </button>
                                            @if (Route::has('welcome'))
                                                <a class="btn btn-link btn-block"
                                                    href="{{ route('mahasiswa.beranda') }}">
                                                    {{ __('Back') }}
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Track Record Pengajuan Sidang TA</h5>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Silahkan Pilih Surat </label>
                                            <select class="form-control" id="trackSurat" name="jenis_surat">
                                                <option>Pilih Data Surat</option>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @if (isset($data))
                                                    @foreach ($data as $item)
                                                        {{-- @if ($value->pengajuanspta->nama == Session::get('nama')) --}}
                                                        <option value="{{ $item->id }}">[{{ $no++ }}] -
                                                            {{ $item->jenis_surat }} - {{ $item->created_date }}</option>
                                                        {{-- @endif --}}
                                                    @endforeach
                                                @endif
                                                {{-- @if (isset($data))
                                        @foreach ($data as $item => $value)
                                            @if ($value->user->username == Session::get('username'))
                                                <option value="{{ $value->id }}">[{{ $no++ }}] -
                                                    {{ $value->jenis_surat }}</option>
                                            @endif
                                        @endforeach
                                        @endif   --}}
                                            </select>
                                        </div>
                                    </form>
                                    <div id="tracing">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer text-center">
                Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.
            </div>
    </section>
@endsection
@section('script')
    <script src="../../assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#trackSurat').change(function() {
                var surat = $(this).val();
                if (surat) {
                    $.ajax({
                        type: "get",
                        url: '/mahasiswa/tracing/' + surat + '/pengajuansta',


                        success: function(data) {

                            if (data) {

                                $.each(data, function(key, value) {
                                    var itemJson = $.parseJSON(value['0'].history)
                                    var i;
                                    var bodydata = '';
                                    for (i = 0; i < itemJson.length; i++) {
                                        bodydata += " <div class='row w-100' >"
                                        bodydata +=
                                            " <div class='col-auto text-center flex-column  d-sm-flex '>";
                                        bodydata +=
                                            "            <div class='row h-50'>";
                                        bodydata +=
                                            "                <div class='col border-right'>&nbsp;</div>";
                                        bodydata +=
                                            "                        <div class='col'>&nbsp;</div>";
                                        bodydata += "                </div>";
                                        bodydata += "               <h5 class='m-1'>";
                                        bodydata +=
                                            "                   <span class='badge badge-pill bg-dark border'>&nbsp;</span>";
                                        bodydata += "               </h5>";
                                        bodydata +=
                                            "               <div class='row h-50'>";
                                        bodydata +=
                                            "                    <div class='col border-right'>&nbsp;</div>";
                                        bodydata +=
                                            "                    <div class='col'>&nbsp;</div>";
                                        bodydata += "               </div>";
                                        bodydata += "            </div>";
                                        bodydata += " <div class='col py-2'>";
                                        bodydata += "       <div class='card  w-70'>";
                                        bodydata +=
                                            "           <div class='card-body' >";
                                        bodydata +=
                                            "                  <h6 class='card-title text-muted' id='tracing_waktu'>" +
                                            itemJson[i] + " </h6>";
                                        bodydata +=
                                            "                  <p class='card-text' id='tracing_jenis'>" +
                                            itemJson[(i + 1)] + "</p>";
                                        bodydata += "           </div>";
                                        bodydata += "       </div>";
                                        bodydata += " </div>";
                                        bodydata += " </div>";


                                        i++;
                                    }

                                    $("#tracing").empty()
                                    $("#tracing").html(bodydata);
                                });
                            }


                        }

                    });
                }
            });
        });
    </script>
