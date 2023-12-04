@extends('layouts.spta')
@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.pengajuanpskkp') }}">Pengusulan SK Kerja Praktek</a>
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
                                <h5 class="card-header">Pengusulan SK Kerja Praktek</h5>
                                <div class="card-body">
                                    <label for="exampleFormControlSelect1">Silahkan isi formulir pengusulan SK kerja praktek
                                        sesuai dengan persyaratan yang dibutuhkan.</label>
                                    <form method="POST" action="{{ route('pengajuanpskkpstore') }}"
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
                                        <div class="from-group">
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
                                                class="col-md-12 col-form-label text-md-end">{{ __('No Handphone') }}</label>
                                            <div class="col-md-12">
                                                <input id="nohp" type="tel" pattern="(\+62|62|0)8[1-9][0-9]{6,10}$"
                                                    class="form-control @error('nohp') is-invalid @enderror" name="nohp"
                                                    value="" required autocomplete="nohp" placeholder="contoh : 081234123789">
                                            </div>
                                            @error('nohp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="from-group">
                                            <label for="nim"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nomor Induk Mahasiswa') }}</label>
                                            <div class="col-md-12">
                                                <input id="nim" type="text" minlength="9" maxlength="9"
                                                    class="form-control @error('nim') is-invalid @enderror" name="nim"
                                                    required autocomplete="nim">
                                            </div>
                                            @error('nim')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="from-group">
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
                                                    <option value="pskkp">Pengusulan SK KP</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="from-group">
                                            <label for="tgl_pengajuan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Tanggal Pengajuan') }}</label>
                                            <div class="col-md-12">
                                                <input id="tgl_pengajuan" type="date"
                                                    class="form-control @error('tgl_pengajuan') is-invalid @enderror"
                                                    name="tgl_pengajuan" value="" required
                                                    autocomplete="tgl_pengajuan">
                                            </div>
                                            @error('tgl_pengajuan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="from-group">
                                            <label for="pmagang"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Surat Penerimaan Mangang dari Instansi') }}</label>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="pmagang" type="file"
                                                        class="custom-file-input @error('pmagang') is-invalid @enderror"
                                                        name="pmagang" value="" required autocomplete="pmagang"
                                                        accept=".pdf,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File PDF dan
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('pmagang')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="from-group">
                                            <label for="nm_pembimbing"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Nama Pembimbing') }}</label>
                                            <div class="col-md-12">
                                                <input id="nm_pembimbing" type="text"
                                                    class="form-control @error('nm_pembimbing') is-invalid @enderror"
                                                    name="nm_pembimbing" value="" required
                                                    autocomplete="nm_pembimbing">
                                            </div>
                                            @error('nm_pembimbing')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="from-group">
                                            <label for="upfor_ajuan"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload Foto Formulir Pengajuan KP (Sudah TTD Pembimbing)') }}</label>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="upfor_ajuan" type="file"
                                                        class="custom-file-input @error('upfor_ajuan') is-invalid @enderror"
                                                        name="upfor_ajuan" value="" required
                                                        autocomplete="upfor_ajuan"
                                                        accept=".doc,.pdf,.docx,application/msword,image/*">
                                                    <label class="custom-file-label" for="customFile">Format File
                                                        Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('upfor_ajuan')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- menu pilihan --}}
                                        <div class="from-group">
                                            <label for="bukti_ajuankp"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Pilih Bukti Pengajuan KP') }}</label>
                                            <div class="col-md-12">
                                                <select id="bukti_ajuankp" type=""
                                                    class="form-control @error('bukti_ajuankp') is-invalid @enderror"
                                                    name="bukti_ajuankp" value="" required
                                                    autocomplete="bukti_ajuankp">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="punya">Sudah punya formulir fisik</option>
                                                    <option value="belum_punya">Belum punya formulir fisik</option>
                                                </select>
                                            </div>
                                            @error('bukti_ajuankp')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div>
                                            <br>
                                            <div class="card-header">Jika sudah punya bukti persetujuan KP
                                                silahkan upload foto formulir pengajuan namun jika tidak ada silahkan untuk
                                                membuat surat pernyataan dengan contoh sebagai berikut:
                                                
                                                <div class="from-group">
                                                    <div class="col-md-12">
                                                        <a href="{{ route('download') }}" class="btn btn-core btn-block"><i
                                                                class="fa fa-download"></i>
                                                            {{ __('Download Contoh Surat Pernyataan') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                <div class="from-group">
                                                    <label for="upper_pembimbing"
                                                        class="col-md-12 col-form-label text-md-end">{{ __('Upload Bukti Persetujuan KP') }}</label>
                                                    <div class="col-md-12">
                                                        <div class="custom-file">
                                                            <input id="upper_pembimbing" type="file"
                                                                class="custom-file-input @error('upper_pembimbing') is-invalid @enderror"
                                                                name="upper_pembimbing" value="" 
                                                                autocomplete="upper_pembimbing"
                                                                accept=".doc,.pdf,.docx,application/msword,image/*">
                                                            <label class="custom-file-label" for="customFile">Format File
                                                                PDF atau Image (png, jpg, dll)</label>
                                                        </div>
                                                    </div>
                                                    @error('upper_pembimbing')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{-- <strong>{{ $message }}</strong> --}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                {{-- menu pilihan --}}
                                                <div class="from-group">
                                                    <label for="scanombuspbn"
                                                        class="col-md-12 col-form-label text-md-end">{{ __('Bukti Ombus dan PBN') }}</label>
                                                    <div class="col-md-12">
                                                        <select id="scanombuspbn" type="text"
                                                            class="form-control @error('scanombuspbn') is-invalid @enderror"
                                                            name="scanombuspbn" value="" required
                                                            autocomplete="scanombuspbn">
                                                            <option disabled selected value>Apakah Anda memiliki bukti sudah
                                                                mengikuti Ombus dan PBN</option>
                                                            <option value="ada">Ada</option>
                                                            <option value="tidak_ada">Tidak ada, berada ditempat lain dan
                                                                tidak dapat diakses</option>
                                                        </select>
                                                    </div>
                                                    @error('scanombuspbn')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{-- <strong>{{ $message }}</strong> --}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="from-group">
                                                    <label for="up_ombus"
                                                        class="col-md-12 col-form-label text-md-end">{{ __('Upload Sertifikat Ombus') }}</label>
                                                    <div class="col-md-12">
                                                        <div class="custom-file">
                                                            <input id="up_ombus" type="file"
                                                                class="custom-file-input @error('up_ombus') is-invalid @enderror"
                                                                name="up_ombus" value="" required
                                                                autocomplete="up_ombus"
                                                                accept=".doc,.pdf,.docx,application/msword,image/*">
                                                            <label class="custom-file-label" for="customFile">Format File
                                                                PDF atau Image (png, jpg, dll)</label>
                                                        </div>
                                                    </div>
                                                    @error('up_ombus')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{-- <strong>{{ $message }}</strong> --}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="from-group">
                                                    <label for="up_pbn"
                                                        class="col-md-12 col-form-label text-md-end">{{ __('Upload Sertifikat PBN') }}</label>
                                                    <div class="col-md-12">
                                                        <div class="custom-file">
                                                            <input id="up_pbn" type="file"
                                                                class="custom-file-input @error('up_pbn') is-invalid @enderror"
                                                                name="up_pbn" value="" required
                                                                autocomplete="up_pbn"
                                                                accept=".doc,.pdf,.docx,application/msword,image/*">
                                                            <label class="custom-file-label" for="customFile">Format File
                                                                PDF atau Image (png, jpg, dll)</label>
                                                        </div>
                                                    </div>
                                                    @error('up_pbn')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{-- <strong>{{ $message }}</strong> --}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="from-group">
                                                    <label for="transkip"
                                                        class="col-md-12 col-form-label text-md-end">{{ __('Transkip Nilai (harus diTTD)') }}</label>
                                                    <div class="col-md-12">
                                                        <div class="custom-file">
                                                            <input id="transkip" type="file"
                                                                class="custom-file-input @error('transkip') is-invalid @enderror"
                                                                name="transkip" value="" required
                                                                autocomplete="transkip"
                                                                accept=".doc,.pdf,.docx,application/msword,image/*">
                                                            <label class="custom-file-label" for="customFile">Format File
                                                                PDF atau Image (png, jpg, dll)</label>
                                                        </div>
                                                    </div>
                                                    @error('transkip')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{-- <strong>{{ $message }}</strong> --}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="from-group">
                                                    <label for="pernyataan"
                                                        class="col-md-12 col-form-label text-md-end">{{ __('Upload Surat Pernyataan (harus diTTD)') }}</label>
                                                    <div class="col-md-12">
                                                        <div class="custom-file">
                                                            <input id="pernyataan" type="file"
                                                                class="custom-file-input @error('pernyataan') is-invalid @enderror"
                                                                name="pernyataan" value=""
                                                                autocomplete="pernyataan"
                                                                accept=".doc,.pdf,.docx,application/msword,image/*">
                                                            <label class="custom-file-label" for="customFile">Format File
                                                                PDF atau Image (png, jpg, dll)</label>
                                                        </div>
                                                    </div>
                                                    @error('pernyataan')
                                                        <span class="invalid-feedback" role="alert">
                                                            {{-- <strong>{{ $message }}</strong> --}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="from-group"><br>
                                                    <div class="col-md-12">
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
                                <h5 class="card-header">Track Record Pengusulan SK Kerja Praktek</h5>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group ">
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
                        url: '/mahasiswa/tracing/' + surat + '/pengajuanpskkp',


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
