@extends('layouts.spta')

@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.pengajuanpptakp') }}">Pengajuan Perpanjangan TA dan KP</a>
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
                                <h5 class="card-header">Pengajuan Perpanjangan TA dan KP</h5>
                                <div class="card-body">
                                    <label for="exampleFormControlSelect1">Silahkan isi formulir pengajuan perpanjangan TA
                                        dan KP sesuai dengan persyaratan yang dibutuhkan.</label>
                                    <form method="POST" action="{{ route('pengajuanpptakpstore') }}"
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
                                                    <option value="pptakp">Pengajuan Perpanjangan KP dan TA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="permohonan_dok"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Permohonan Pembuatan Dokumen') }}</label>
                                            <div class="col-md-12">
                                                <select id="permohonan_dok" type="file"
                                                    class="form-control @error('permohonan_dok') is-invalid @enderror"
                                                    name="permohonan_dok" required autocomplete="permohonan_dok"
                                                    placeholder="">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="p_kp">Perpanjangan Kerja Praktik</option>
                                                    <option value="p_ta">Perpanjangan Tugas Akhir</option>
                                                </select>
                                            </div>
                                            @error('permohonan_dok')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="skpembimbing_akhir"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Hasil Scan SK Pembimbing Terakhir') }}</label>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="skpembimbing_akhir" type="file"
                                                        class="custom-file-input @error('skpembimbing_akhir') is-invalid @enderror"
                                                        name="skpembimbing_akhir" required
                                                        autocomplete="skpembimbing_akhir" accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File berupa
                                                        PDF dan Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('skpembimbing_akhir')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="uppernyataan_perspem"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Pernyataan Persetujuan SK dari Pembimbing (untuk TA persetujuan pembimbing 1 berupa screenshot)') }}</label>
                                            <div class="card-header">
                                                {{ __(' Bukti dapat berupa screenshoot persetujuan melalui WA, email, atau media digital lain. Screenshoot harus memperlihatkan kalimat persetujuan dan nama/nomor akun beserta foto profile dosen pembimbing') }}
                                            </div><br>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="uppernyataan_perspem" type="file"
                                                        class="custom-file-input @error('uppernyataan_perspem') is-invalid @enderror"
                                                        name="uppernyataan_perspem" required
                                                        autocomplete="uppernyataan_perspem" accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File berupa
                                                        PDF dan Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('uppernyataan_perspem')
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
                                <h5 class="card-header">Track Record Perpanjangan TA dan KP</h5>
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
                        url: '/mahasiswa/tracing/' + surat + '/pengajuanpptakp',


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
