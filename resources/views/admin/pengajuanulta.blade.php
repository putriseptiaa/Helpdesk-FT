@extends('layouts.administrator1')

@section('nav')
    {{-- <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li> --}}
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.beranda') }}">Informasi</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('pengajuanultaa') }}">Unggah Dokumen Laporan TA</a>
    </li>
@endsection

@section('content')

    <section class="card-feature">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
{{-- 
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
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
                                <h5 class="card-header">Daftar Unggah Dokumen Laporan TA</h5>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered text-capitalize data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Tanggal Pengumpulan</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                    @if (isset($pengajuanulta))
                                        @foreach ($pengajuanulta as $data)
                                            <div class="modal fade text-capitalize" id="exampleModal-{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail Unggah Laporan TA </h5>
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
                                                                            @foreach ($data->transwfulta as $data2)
                                                                                @if (isset($data2))
                                                                                    @if ($data2->wfreference == '1')
                                                                                        <div
                                                                                            class="card-header text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <a href="{{ route('tolakpengajuanulta', $data2->id) }}"
                                                                                                        class="btn btn-sm btn-danger">Tolak
                                                                                                        Permintaan</a>
                                                                                                    <a href="{{ route('terimapengajuanulta', $data2->id) }}"
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
                                                                                        <th width="20%">Email</th>
                                                                                        <td width="30%">
                                                                                            <div class="text-lowercase">
                                                                                            {{ $data->email }}</div>
                                                                                        </td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ $data->nama }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data->nim }}
                                                                                        </td>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data->jurusan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tanggal Pengumpulan</th>
                                                                                        <td>{{ $data->tgl_pengumpulan }}
                                                                                        </td>
                                                                                        <th>Judul Tugas Akhir</th>
                                                                                        <td>{{ $data->judul_ta }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Nama Pembimbing 1</th>
                                                                                        <td>{{ $data->nm_pembimbing1 }}
                                                                                        </td>
                                                                                        <th>Nama Pembimbing 2</th>
                                                                                        <td>{{ $data->nm_pembimbing2 }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        <th>Tanggal Sidang TA</th>
                                                                                        <td>{{ $data->tgl_sidangta }}
                                                                                        </td>
                                                                                    
                                                                                    @php
                                                                                        $path = Storage::url('ulta/' . $data->file_laporanaplikasi);
                                                                                    @endphp
                                                                                        <th style="vertical-align: middle;">Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'ulta', 'fileName' => $data->file_laporanaplikasi]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                File Laporan dan Aplikasi
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    {{-- @if (isset($data))
                                                                                        @foreach ($data->transwfulta as $data2)
                                                                                            <tr class="bg-light">
                                                                                                <td colspan="2"><strong>
                                                                                                        Status
                                                                                                        Unggah 
                                                                                                        Laporan TA</strong></td>
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
                                <h5 class="card-header">Daftar Unggah Laporan TA</h5>
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
                                    @if (isset($pengajuanulta2))
                                        @foreach ($pengajuanulta2 as $data2)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data2->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail Unggah Laporan TA
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
                                                                            @foreach ($data2->transwfulta as $data3)
                                                                                @if ($data3->wfreference == '1')
                                                                                    <div class="card-header text-center">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <a href="{{ route('tolakpengajuanulta', $data3->id) }}"
                                                                                                    class="btn btn-sm btn-danger">Tolak
                                                                                                    Permintaan</a>
                                                                                                <a href="{{ route('terimapengajuanulta', $data3->id) }}"
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
                                                                                        <th width="20%">Email</th>
                                                                                        <td width="30%">
                                                                                            <div class="text-lowercase">
                                                                                            {{ $data2->email }}</div>
                                                                                        </td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ $data2->nama }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data2->nim }}
                                                                                        </td>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data2->jurusan }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Tanggal Pengumpulan</th>
                                                                                        <td>{{ $data2->tgl_pengumpulan }}
                                                                                        </td>
                                                                                        <th>Judul Tugas Akhir</th>
                                                                                        <td>{{ $data2->judulta }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Nama Pembimbing 1</th>
                                                                                        <td>{{ $data2->nm_pembimbing1 }}
                                                                                        </td> 
                                                                                        <th>Nama Pembimbing 2</th>
                                                                                        <td>{{ $data2->nm_pembimbing2 }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                       
                                                                                        <th>Tanggal Sidang TA</th>
                                                                                        <td>{{ $data2->tgl_sidangta }}
                                                                                        </td>
                                                                                   
                                                                                    @php
                                                                                        $path = Storage::url('ulta/' . $data2->file_laporanaplikasi);
                                                                                    @endphp
                                                                                        <th style="vertical-align: middle;">Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'ulta', 'fileName' => $data2->file_laporanaplikasi]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                File Laporan dan Aplikasi
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data2))
                                                                                        @foreach ($data2->transwfulta as $data3)
                                                                                            <tr class="bg-light">
                                                                                                <td colspan="2"><strong>
                                                                                                        Status
                                                                                                        Unggah Laporan TA</strong></td>
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
                ajax: "{{ route('pengajuanultaa') }}",
                columns: [

                    {
                        data: 'nim',
                        name: 'nim'
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
                        data: 'tgl_pengumpulan',
                        name: 'tgl_pengumpulan'
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
                ajax: "{{ route('pengajuanultaa2') }}",
                columns: [{
                        data: 'nim',
                        name: 'nim'
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
                        data: 'transwfulta[].wfr.status',
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
