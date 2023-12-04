@extends('layouts.spta')

@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.pengajuanbpit') }}">Bukti Pengambilan Ijazah dan Transkip Nilai</a>
    </li>
@endsection

@section('content')
    <section class="slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                {{ __('Silahkan isi formulir bukti pengambilan ijazah dan transkip nilai sesuai dengan data yang dibutuhkan.') }}
                            </div>
                            <form method="POST" action="{{ route('pengajuanbpitstore') }}" enctype="multipart/form-data">
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
                                    <label for="nama"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>
                                    <div class="col-md-12">
                                        <input id="nama" type="text"
                                            class="form-control @error('nama') is-invalid @enderror" name="nama"
                                            value="" required autocomplete="nama" autofocus>
                                    </div>
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Tempat Lahir') }}</label>
                                    <div class="col-md-12">
                                        <input id="tempat_lahir" type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            name="tempat_lahir" value="" required autocomplete="tempat_lahir">
                                    </div>
                                    @error('tempat_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgi_lahir"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Tanggal Lahir') }}</label>
                                    <div class="col-md-12">
                                        <input id="tgi_lahir" type="date"
                                            class="form-control @error('tgi_lahir') is-invalid @enderror" name="tgi_lahir"
                                            value="" required autocomplete="tgi_lahir">
                                    </div>
                                    @error('tgi_lahir')
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
                                            class="form-control @error('nim') is-invalid @enderror" name="nim" required
                                            autocomplete="nim" placeholder="">
                                    </div>
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="no_ijazah"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Nomor Ijazah') }}</label>
                                    <div class="col-md-12">
                                        <input id="no_ijazah" type="text"
                                            class="form-control @error('no_ijazah') is-invalid @enderror" name="no_ijazah"
                                            required autocomplete="no_ijazah" placeholder="">
                                    </div>
                                    @error('no_ijazah')
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
                                            class="form-control @error('jurusan') is-invalid @enderror" name="jurusan"
                                            required autocomplete="jurusan" placeholder="">
                                            <option disabled selected value>Pilih Jurusan</option>
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
                                    <label for="tgl_lulus"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Tanggal Lulus') }}</label>
                                    <div class="col-md-12">
                                        <input id="tgl_lulus" type="date"
                                            class="form-control @error('tgl_lulus') is-invalid @enderror" name="tgl_lulus"
                                            required autocomplete="tgl_lulus" placeholder="">
                                    </div>
                                    @error('tgl_lulus')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_terbitijazah"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Tanggal Terbit Ijazah') }}</label>
                                    <div class="col-md-12">
                                        <input id="tgl_terbitijazah" type="date"
                                            class="form-control @error('tgl_terbitijazah') is-invalid @enderror"
                                            name="tgl_terbitijazah" required autocomplete="tgl_terbitijazah"
                                            placeholder="">
                                    </div>
                                    @error('tgl_terbitijazah')
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
                                    <label for="email"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="" required autocomplete="email">
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Alamat') }}</label>
                                    <div class="col-md-12">
                                        <input id="alamat" type="text"
                                            class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                            required autocomplete="alamat" placeholder="">
                                    </div>
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nm_pengambil"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Nama Pengambil Ijazah dan Transkip Nilai') }}</label>
                                    <div class="col-md-12">
                                        <input id="nm_pengambil" type="text"
                                            class="form-control @error('nm_pengambil') is-invalid @enderror"
                                            name="nm_pengambil" required autocomplete="nm_pengambil">
                                    </div>
                                    @error('nm_pengambil')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nobuku_pengambilan"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Nomor Buku Pengambilan') }}</label>
                                    <div class="col-md-12">
                                        <input id="nobuku_pengambilan" type="text"
                                            class="form-control @error('nobuku_pengambilan') is-invalid @enderror"
                                            name="nobuku_pengambilan" required autocomplete="nobuku_pengambilan">
                                    </div>
                                    @error('nobuku_pengambilan')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="foto_pengambilan"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Upload Foto Dokumentasi Pengambilan') }}</label>
                                    <div class="col-md-12">
                                        <div class="custom-file">
                                            <input id="foto_pengambilan" type="file"
                                                class="custom-file-input @error('foto_pengambilan') is-invalid @enderror"
                                                name="foto_pengambilan" required autocomplete="foto_pengambilan"
                                                accept="image/*">
                                            <label class="custom-file-label" for="customFile">Format File berupa Image
                                                (png, jpg, dll)</label>
                                        </div>
                                    </div>
                                    @error('foto_pengambilan')
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
                                            class="form-control @error('kerja') is-invalid @enderror" name="kerja"
                                            required autocomplete="kerja">
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
                                            class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                                            autocomplete="jabatan">
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
                                    <label for="jenis_pernjanjiankerja"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Jenis Perjanjian Kerja atau Jenis Wirausaha') }}</label>
                                    <div class="col-md-12">
                                        <select id="jenis_pernjanjiankerja" type=""
                                            class="form-control @error('jenis_pernjanjiankerja') is-invalid @enderror"
                                            name="jenis_pernjanjiankerja" autocomplete="jenis_pernjanjiankerja">
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
                                    @error('jenis_pernjanjiankerja')
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
                                            class="form-control @error('gaji') is-invalid @enderror" name="gaji"
                                            autocomplete="gaji">
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
                                        <input id="pernyataan" type="text"
                                            class="form-control @error('pernyataan') is-invalid @enderror"
                                            name="pernyataan" autocomplete="pernyataan">
                                    </div>
                                    @error('pernyataan')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keterangan"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Apakah Anda bersedia melengkapi data terkait wirausaha di masa depan') }}</label>
                                    <div class="col-md-12">
                                        <select id="keterangan" type="text"
                                            class="form-control @error('keterangan') is-invalid @enderror"
                                            name="keterangan" required autocomplete="keterangan" placeholder="">
                                            <option disabled selected value>Pilih</option>
                                            <option value="bersedia">Ya, bersedia</option>
                                            <option value="tidak_bersedia">Tidak bersedia</option>
                                        </select>
                                    </div>
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alasan"
                                        class="col-md-12 col-form-label text-md-end">{{ __('Alasan anda tidak bersedia') }}</label>
                                    <div class="col-md-12">
                                        <input id="alasan" type="text"
                                            class="form-control @error('alasan') is-invalid @enderror" name="alasan"
                                            required autocomplete="alasan" placeholder="">
                                    </div>
                                    @error('alasan')
                                        <span class="invalid-feedback" role="alert">
                                            {{-- <strong>{{ $message }}</strong> --}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-core btn-block">
                                        {{ __('Submit') }}
                                    </button>

                                    @if (Route::has('welcome'))
                                        <a class="btn btn-link btn-block" href="{{ route('mahasiswa.beranda') }}">
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
        <div class="footer text-center">
            Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.
        </div>
    </section>
@endsection
