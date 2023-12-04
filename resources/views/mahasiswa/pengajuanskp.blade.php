@extends('layouts.spta')
@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.pengajuanskp') }}">Pengajuan Sidang Kerja Praktek</a>
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
                                <h5 class="card-header">Formulir Pengajuan Sidang KP</h5>
                                <div class="card-body">
                                    <label for="exampleFormControlSelect1">Silahkan isi formulir pengajuan sidang kerja
                                        praktek sesuai dengan persyaratan yang dibutuhkan.</label>
                                    <form method="POST" action="{{ route('pengajuanskpstore') }}"
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
                                                <input id="nama" type="text" minlength="4"
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
                                                    <option value="skp">Pengajuan Sidang KP</option>
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
                                            <label for="nm_pembimbing"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nama Pembimbing') }}</label>

                                            <div class="col-md-12">
                                                <input id="nm_pembimbing" type="text"
                                                    class="form-control @error('nm_pembimbing') is-invalid @enderror"
                                                    name="nm_pembimbing" required autocomplete="nm_pembimbing">
                                            </div>
                                            @error('nm_pembimbing')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="forper_kp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Pilih Bukti Persetujuan KP') }}</label>

                                            <div class="col-md-12">
                                                <select id="forper_kp" type="text"
                                                    class="form-control @error('forper_kp') is-invalid @enderror"
                                                    name="forper_kp" required autocomplete="forper_kp">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="punya">Sudah punya formulir fisik yang sudah di ttd
                                                        pembimbing </option>
                                                    <option value="belum_punya">Belum punya formulir fisik</option>
                                                </select>
                                            </div>
                                            @error('forper_kp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="card-header fs-6"> 
                                            - Jika sudah punya bukti persetujuan KP silahkan upload foto formulir pengajuan.
                                            <br>
                                            - Jika belum punya silahkan upload bukti persetujuan pembimbing berupa
                                            screenshoot persetujuan memalui WA, email, atau media digital lain.
                                            <br> Screenshoot harus memperlihatkan kalimat persetujuan dan nama/ nomor akun
                                            beserta foto profile dosen pembimbing.
                                        </div>

                                        <div class="form-group">
                                            <label for="upfor_ajuan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Foto Formulir Pengajuan') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="upfor_ajuan" type="file"
                                                        class="custom-file-input @error('upfor_ajuan') is-invalid @enderror"
                                                        name="upfor_ajuan" autocomplete="upfor_ajuan" placeholder=""
                                                        accept="image/*">
                                                    <label class="custom-file-label" for="customFile">Format File Image
                                                        (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('upfor_ajuan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="upper_pembimbing"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Bukti Persetujuan Pembimbing') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="upper_pembimbing" type="file"
                                                        class="custom-file-input @error('upper_pembimbing') is-invalid @enderror"
                                                        name="upper_pembimbing" autocomplete="upper_pembimbing"
                                                        accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('upper_pembimbing')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="surat_selesaikp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Surat Selesai KP dari Instansi') }}</label>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="surat_selesaikp" type="file"
                                                        class="custom-file-input @error('surat_selesaikp') is-invalid @enderror"
                                                        name="surat_selesaikp" required
                                                        autocomplete="surat_selesaikp"accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('surat_selesaikp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="daftarhadirkp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Daftar Hadir dari Instansi Tempat KP') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="daftarhadirkp" type="file"
                                                        class="custom-file-input @error('daftarhadirkp') is-invalid @enderror"
                                                        name="daftarhadirkp" required autocomplete="daftarhadirkp"
                                                        placeholder="" accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('daftarhadirkp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="nilaikp_pembimbing"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nilai KP dari Pembimbing Lapangan') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="nilaikp_pembimbing" type="file"
                                                        class="custom-file-input @error('nilaikp_pembimbing') is-invalid @enderror"
                                                        name="nilaikp_pembimbing" required
                                                        autocomplete="nilaikp_pembimbing" placeholder=""
                                                        accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('nilaikp_pembimbing')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="sk_pembimbingkp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload SK pembimbing KP') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="sk_pembimbingkp" type="file"
                                                        class="custom-file-input @error('sk_pembimbingkp') is-invalid @enderror"
                                                        name="sk_pembimbingkp" required autocomplete="sk_pembimbingkp"
                                                        placeholder="" accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('sk_pembimbingkp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="lembar_pembimbingkp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Lembar Pembimbing KP') }}</label>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="lembar_pembimbingkp" type="file"
                                                        class="custom-file-input @error('lembar_pembimbingkp') is-invalid @enderror"
                                                        name="lembar_pembimbingkp" required
                                                        autocomplete="lembar_pembimbingkp" placeholder=""
                                                        accept=".doc,.pdf,.docx,application/msword, image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Document atau Image</label>
                                                </div>
                                            </div>
                                            @error('lembar_pembimbingkp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="transkip"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Transkip Nilai harus di TTD') }}</label>

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
                                            <label for="draft_lapkp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Bukti Penyerahan Laporan KP (max 10mb)') }}</label>

                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="draft_lapkp" type="file"
                                                        class="custom-file-input @error('draft_lapkp') is-invalid @enderror"
                                                        name="draft_lapkp" required autocomplete="draft_lapkp"
                                                        placeholder="" accept=".doc,.pdf,.docx,application/msword">
                                                    <label class="custom-file-label" for="customFile">Format File PDF atau
                                                        Document <= 10 MB, meskipun disetting 100 MB</label>
                                                </div>
                                            </div>
                                            @error('draft_lapkp')
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
                                <h5 class="card-header">Track Record Pengajuan Sidang KP</h5>
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
                                                            {{ $item->jenis_surat }} - {{ $item->created_at }}</option>
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
                        url: '/mahasiswa/tracing/' + surat + '/pengajuanskp',


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
