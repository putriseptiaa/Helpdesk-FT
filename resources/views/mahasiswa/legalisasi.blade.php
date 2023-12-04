@extends('layouts.spta')

@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('mahasiswa.legalisasi') }}">Legalisasi</a>
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
                                <h5 class="card-header">Pengajuan Legalisasi</h5>
                                <div class="card-body">
                                    <label for="exampleFormControlSelect1">Silahkan isi formulir pengajuan legalisasi
                                        dokumen sesuai dengan persyaratan yang dibutuhkan.</label>
                                    <form method="POST" action="{{ route('legalisasistore') }}"
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
                                                    <option value="legalisasi">Legalisasi Dokumen</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenisdok"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Jenis dokumen yang dilegalisasi') }}</label>
                                            <div class="col-md-12">
                                                <select id="jenisdok" type="text"
                                                    class="form-control @error('jenisdok') is-invalid @enderror"
                                                    name="jenisdok" required autocomplete="jenisdok" placeholder="">
                                                    <option disabled selected value>Pilih</option>
                                                    <option value="ijazah">Ijazah</option>
                                                    <option value="transkip">Transkip Nilai</option>
                                                    <option value="transkip">Lainnya</option>
                                                </select>
                                            </div>
                                            @error('jenisdok')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file_asli"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload scan file asli dokumen') }}</label>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="file_asli" type="file"
                                                        class="custom-file-input @error('file_asli') is-invalid @enderror"
                                                        name="file_asli" required autocomplete="file_asli">
                                                    <label class="custom-file-label" for="customFile">Format File berupa
                                                        PDF atau Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('file_asli')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file_fotocopy"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Upload scan file fotocopy dokumen') }}</label>
                                            <div class="col-md-12">
                                                <div class="custom-file">
                                                    <input id="file_fotocopy" type="file"
                                                        class="custom-file-input @error('file_fotocopy') is-invalid @enderror"
                                                        name="file_fotocopy" required autocomplete="file_fotocopy">
                                                    <label class="custom-file-label" for="customFile">Format File berupa
                                                        PDF atau Image (png, jpg, dll)</label>
                                                </div>
                                            </div>
                                            @error('file_fotocopy')
                                                <span class="invalid-feedback" role="alert">
                                                    {{-- <strong>{{ $message }}</strong> --}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah"
                                                class="col-md-12 col-form-label text-md-end">{{ __('Jumlah Lembar Legalisali') }}</label>
                                            <div class="col-md-12">
                                                <input id="jumlah" type="number" min="3" max="10"
                                                    class="form-control @error('jumlah') is-invalid @enderror"
                                                    name="jumlah" required autocomplete="jumlah">
                                            </div>
                                            @error('jumlah')
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
                                <h5 class="card-header">Track Record Pengajuan Legalisasi</h5>
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
                            {{-- <div class="card shadow-sm">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>
                                                Email
                                            </th>
                                            <td id="trackEmail">
                                                <?= $data[0]->email ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Nama Lengkap
                                            </th>
                                            <td id="trackNama">
                                                <?= $data[0]->nama ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                No Handphone(No HP/WA yang dapat dihubungi)
                                            </th>
                                            <td id="trackNohp">
                                                <?= $data[0]->nohp ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                No Induk Mahasiswa(NIM/NPM)
                                            </th>
                                            <td id="trackNim">
                                                <?= $data[0]->nim ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Jurusan
                                            </th>
                                            <td id="trackJurusan">
                                                <?= $data[0]->jurusan ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Jenis Pengajuan Surat
                                            </th>
                                            <td id="trackJenisSurat">
                                                <?= $data[0]->jenis_surat ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Jenis dokumen yang dilegalisasi
                                            </th>
                                            <td id="trackJenisdok">
                                                <?= $data[0]->jenisdok ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Jumlah Lembar dilegalisasi
                                            </th>
                                            <td id="trackJumlah">
                                                <?= $data[0]->jumlah ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Tanggal Pengajuan
                                            </th>
                                            <td id="trackJumlah">
                                                <?= $data[0]->created_date ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Status
                                            </th>
                                            <td id="trackStatus">
                                                <strong>
                                                    <?= $data[0]->transwflegalisasi[0]->wfr->status ?>
                                                </strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> --}}
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
                        url: '/mahasiswa/tracing/' + surat + '/legalisasi',


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
