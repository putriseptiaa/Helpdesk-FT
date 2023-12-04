@extends('layouts.administrator')

@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('administrator.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('pengajuanbpit') }}">Bukti Pengambilan Ijazah dan Transkip Nilai</a>
    </li>
@endsection

@section('content')

    <section class="card-feature">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">

                    {{-- <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="butuh-tab" data-toggle="tab" href="#butuh" role="tab"
                                aria-controls="butuh" aria-selected="true">Belum divalidasi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="sudah-tab" data-toggle="tab" href="#sudah" role="tab"
                                aria-controls="sudah" aria-selected="false">Sudah divalidasi</a>
                        </li>
                    </ul> --}}

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="butuh" role="tabpanel" aria-labelledby="butuh-tab">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Daftar Unggah Bukti Pengambilan Ijazah dan Nilai Transkip</h5>
                                <div class="card-body ">
                                    <table class="table table-striped table-bordered text-capitalize data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Nomor Ijazah</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                    @if (isset($pengajuanbpit))
                                        @foreach ($pengajuanbpit as $data)
                                            <div class="modal fade text-capitalize" id="exampleModal-{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail Bukti
                                                                Pengambilan Ijazah dan Transkip Nilai</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row text-left">
                                                                <div class="col-md-12">
                                                                    <div class="card shadow-sm">
                                                                        {{-- @if (isset($data))
                                                                            @foreach ($data->transwfbpit as $data2)
                                                                                @if (isset($data2))
                                                                                    @if ($data2->wfreference == '1')
                                                                                        <div
                                                                                            class="card-header text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <a href="{{ route('tolakpengajuanbpit', $data2->id) }}"
                                                                                                        class="btn btn-sm btn-danger">Tolak
                                                                                                        Permintaan</a>
                                                                                                    <a href="{{ route('terimapengajuanbpit', $data2->id) }}"
                                                                                                        class="btn btn-sm btn-core">Terima
                                                                                                        Permintaan</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endif --}}
                                                                        <div class="card-body table-responsive">
                                                                            <table class="table table-bordered"
                                                                                style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="20%">Nama Lengkap</th>
                                                                                        <td width="30%">
                                                                                            {{ $data->nama }}</td>

                                                                                        <th width="20%">Tempat Lahir</th>
                                                                                        <td width="30%">
                                                                                            {{ $data->tempat_lahir }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tanggal Lahir</th>
                                                                                        <td>{{ $data->tgi_lahir }}</td>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data->nim }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>No Ijazah</th>
                                                                                        <td>{{ $data->no_ijazah }}</td>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data->jurusan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tanggal Lulus</th>
                                                                                        <td>{{ $data->tgl_lulus }}
                                                                                        </td>
                                                                                        <th>Tanggal Terbit Ijazah</th>
                                                                                        <td>{{ $data->tgl_terbitijazah }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ $data->nohp }}
                                                                                        </td>
                                                                                        <th>Email</th>
                                                                                        <td>
                                                                                            <div class="text-lowercase">
                                                                                            {{ $data->email }}</div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Alamat</th>
                                                                                        <td>{{ $data->alamat }}
                                                                                        </td>
                                                                                        <th>Nama Pengambil</th>
                                                                                        <td>{{ $data->nm_pengambil }}
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>No Buku Pengambil</th>
                                                                                        <td>{{ $data->nobuku_pengambilan }}
                                                                                        </td>
                                                                                        <th>Pekerjaan</th>
                                                                                        <td>{{ $data->kerja }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Jabatan</th>
                                                                                        <td>{{ $data->jabatan }}</td>
                                                                                        <th>Nama Instansi/ Perusahaan</th>
                                                                                        <td>{{ $data->nm_perusahaan }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Alamat Instansi/ Perusahaan
                                                                                        </th>
                                                                                        <td>{{ $data->alamat_perusahaan }}
                                                                                        </td>
                                                                                        <th>Jenis Perjanjian Kerja</th>
                                                                                        <td>{{ $data->jenis_perjanjiankerja }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tanggal Mulai Bekerja</th>
                                                                                        <td>{{ $data->tgl_mulai }}
                                                                                        </td>
                                                                                        <th>Gaji</th>
                                                                                        <td>{{ $data->gaji }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Email Instansi/ Perusahaan</th>
                                                                                        <td>
                                                                                            <div class="text-lowercase">
                                                                                                {{ $data->email_perusahaan }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <th> Telepon Instansi/ Perusahaan
                                                                                        </th>
                                                                                        <td>{{ $data->notelp_perusahaan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Pernyataan</th>
                                                                                        <td>{{ $data->pernyataan }}
                                                                                        </td>
                                                                                        <th> Keterangan</th>
                                                                                        <td>{{ $data->keterangan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th> Alasan </th>
                                                                                        <td>{{ $data->alasan }}
                                                                                        </td>
                                                                                    

                                                                                    @php
                                                                                        $path = Storage::url('bpit/' . $data->foto_pengambilan);
                                                                                    @endphp
                                                                                   
                                                                                        <th style="vertical-align: middle;">
                                                                                            Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'bpit', 'fileName' => $data->foto_pengambilan]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Foto Pengambil Ijazah
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    {{-- @if (isset($data))
                                                                                        @foreach ($data->transwfbpit as $data2)
                                                                                            <tr class="bg-light">
                                                                                                <td colspan="2"><strong>
                                                                                                        Status
                                                                                                        Pengajuan
                                                                                                        Surat</strong></td>
                                                                                                @if (isset($data2))
                                                                                                    @if ($data2->wfr->status == 'Success')
                                                                                                        <td colspan="2"
                                                                                                            style="color:rgb(24, 163, 24);">
                                                                                                            <strong>
                                                                                                                {{ $data2->wfr->status }}
                                                                                                        </td>
                                                                                                    @elseif($data2->wfr->status == 'Reject')
                                                                                                        <td colspan="2"
                                                                                                            style="color:red;">
                                                                                                            <strong>
                                                                                                                {{ $data2->wfr->status }}
                                                                                                        </td>
                                                                                                    @else
                                                                                                        <td colspan="2">
                                                                                                            <strong>
                                                                                                                {{ $data2->wfr->status }}
                                                                                                        </td>
                                                                                                    @endif
                                                                                                @endif
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    @endif --}}


                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sudah" role="tabpanel" aria-labelledby="sudah-tab">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Daftar Unggah Bukti Pengambilan Ijazah dan Nilai Transkip</h5>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered text-capitalize data-table2" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                    @if (isset($pengajuanbpit2))
                                        @foreach ($pengajuanbpit2 as $data2)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data2->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail Bukti
                                                                Pengambilan Ijazah dan Transkip Nilai
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row text-left">
                                                                <div class="col-md-12">
                                                                    <div class="card shadow-sm">
                                                                        @if (isset($data2))
                                                                            @foreach ($data2->transwfbpit as $data3)
                                                                                @if ($data3->wfreference == '1')
                                                                                    <div class="card-header text-center">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <a href="{{ route('tolakpengajuanbpit', $data3->id) }}"
                                                                                                    class="btn btn-sm btn-danger">Tolak
                                                                                                    Permintaan</a>
                                                                                                <a href="{{ route('terimapengajuanbpit', $data3->id) }}"
                                                                                                    class="btn btn-sm btn-core">Terima
                                                                                                    Permintaan</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                        <div class="card-body table-responsive">
                                                                            <table class="table table-bordered"
                                                                                style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="20%">Nama Lengkap
                                                                                        </th>
                                                                                        <td width="30%">
                                                                                            {{ $data2->nama }}</td>
                                                                                        <th width="20%">Tempat Lahir
                                                                                        </th>
                                                                                        <td width="30%">
                                                                                            {{ $data2->tempat_lahir }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tanggal Lahir</th>
                                                                                        <td>{{ $data2->tgi_lahir }}</td>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data2->nim }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>No Ijazah</th>
                                                                                        <td>{{ $data2->no_ijazah }}</td>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data2->jurusan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tanggal Lulus</th>
                                                                                        <td>{{ $data2->tgl_lulus }}
                                                                                        </td>
                                                                                        <th>Tanggal Terbit Ijazah</th>
                                                                                        <td>{{ $data2->tgl_terbitijazah }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ $data2->nohp }}
                                                                                        </td>
                                                                                        <th>Email</th>
                                                                                        <td>
                                                                                            <div class="text-lowercase">
                                                                                                {{ $data2->email }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Alamat</th>
                                                                                        <td>{{ $data2->alamat }}
                                                                                        </td>
                                                                                        <th>Nama Pengambil</th>
                                                                                        <td>{{ $data2->nm_pengambilan }}
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>No Buku Pengambil</th>
                                                                                        <td>{{ $data2->nobuku_pengambilan }}
                                                                                        </td>
                                                                                        <th>Pekerjaan</th>
                                                                                        <td>{{ $data2->kerja }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Jabatan</th>
                                                                                        <td>{{ $data2->jabatan }}</td>
                                                                                        <th>Nama Instansi/ Perusahaan</th>
                                                                                        <td>{{ $data2->nm_perusahaan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Alamat Instansi/ Perusahaan
                                                                                        </th>
                                                                                        <td>{{ $data2->alamat_perusahaan }}
                                                                                        </td>
                                                                                        <th>Jenis Perjanjian Kerja</th>
                                                                                        <td>{{ $data2->jenis_perjanjiankerja }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tanggal Mulai Bekerja</th>
                                                                                        <td>{{ $data2->tgl_mulai }}
                                                                                        </td>
                                                                                        <th>Gaji</th>
                                                                                        <td>{{ $data2->gaji }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Email Instansi/ Perusahaan</th>
                                                                                        <td>
                                                                                            <div class="text-lowercase">
                                                                                                {{ $data2->email_perusahaan }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <th> Telepon Instansi/ Perusahaan
                                                                                        </th>
                                                                                        <td>{{ $data2->notelp_perusahaan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Pernyataan</th>
                                                                                        <td>{{ $data2->pernyataan }}
                                                                                        </td>
                                                                                        <th> Keterangan</th>
                                                                                        <td>{{ $data2->keterangan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th> Alasan </th>
                                                                                        <td>{{ $data2->alasan }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    @php
                                                                                        $path = Storage::url('bpit/' . $data2->foto_pengambilan);
                                                                                    @endphp
                                                                                    <tr>
                                                                                        <th
                                                                                            style="vertical-align: middle;">
                                                                                            Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'bpit', 'fileName' => $data->foto_pengambilan]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Foto Pengambil Ijazah
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data2))
                                                                                        @foreach ($data2->transwfbpit as $data3)
                                                                                            <tr class="bg-light">
                                                                                                <td colspan="2"><strong>
                                                                                                        Status
                                                                                                        Unggah Bukti Pengambilan Ijazah dan Nilai Transkip</strong></td>
                                                                                                @if ($data3->wfr->status == 'Success')
                                                                                                    <td colspan="2"
                                                                                                        style="color:rgb(24, 163, 24);">
                                                                                                        <strong>
                                                                                                            {{ $data3->wfr->status }}
                                                                                                    </td>
                                                                                                @elseif($data3->wfr->status == 'Reject')
                                                                                                    <td colspan="2"
                                                                                                        style="color:red;">
                                                                                                        <strong>
                                                                                                            {{ $data3->wfr->status }}
                                                                                                    </td>
                                                                                                @else
                                                                                                    <td colspan="2">
                                                                                                        <strong>
                                                                                                            {{ $data3->wfr->status }}
                                                                                                    </td>
                                                                                                @endif
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    @endif

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuanbpit') }}",
                columns: [{
                        data: 'nim',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jurusan',
                        name: 'jurusan'
                    },
                    {
                        data: 'no_ijazah',
                        name: 'no_ijazah'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    "targets": 4, // your case first column
                    "className": "text-center",

                }, ],
            });



        });
    </script>
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table2').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengajuanbpit2') }}",
                columns: [{
                        data: 'nim',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jurusan',
                        name: 'jurusan'
                    },
                    {
                        data: 'transwfbpit[].wfr.status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    "targets": 4, // your case first column
                    "className": "text-center",

                }, ],
            });



        });
    </script>
    <script>
        $(document).on("click", '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endsection
