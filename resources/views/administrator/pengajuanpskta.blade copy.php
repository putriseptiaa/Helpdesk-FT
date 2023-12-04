@extends('layouts.administrator')

@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('administrator.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('pengajuanpskta') }}">Pengajuan SK Tugas Akhir</a>
    </li>
@endsection

@section('content')

    <section class="card-feature">
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">

                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="butuh-tab" data-toggle="tab" href="#butuh" role="tab"
                                aria-controls="butuh" aria-selected="true">Verifikasi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="proses-tab" data-toggle="tab" href="#proses" role="tab"
                                aria-controls="proses" aria-selected="false">Progress</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="sudah-tab" data-toggle="tab" href="#sudah" role="tab"
                                aria-controls="sudah" aria-selected="false">End Prosess</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="butuh" role="tabpanel" aria-labelledby="butuh-tab">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Daftar Pengajuan SK Tugas Akhir</h5>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered text-capitalize data-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Jenis Surat</th>
                                                <th>Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                    @if (isset($pengajuanpskta))
                                        @foreach ($pengajuanpskta as $data)
                                            <div class="modal fade text-capitalize" id="exampleModal-{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Verifikasi
                                                                Pengajuan
                                                                SK Tugas Akhir</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row text-left">
                                                                <div class="col-md-12">
                                                                    <div class="card shadow-sm">
                                                                        @if (isset($data))
                                                                            @foreach ($data->transwfpskta as $data2)
                                                                                @if (isset($data2))
                                                                                    @if ($data2->wfreference == '1')
                                                                                        <div
                                                                                            class="card-header text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <a href="{{ route('tolakpengajuanpskta', $data2->id) }}"
                                                                                                        class="btn btn-sm btn-danger">Tolak
                                                                                                        Permintaan</a>
                                                                                                    <a href="{{ route('terimapengajuanpskta', $data2->id) }}"
                                                                                                        class="btn btn-sm btn-core">Terima
                                                                                                        Permintaan</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
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
                                                                                            {{ @$data->email }}</div>
                                                                                        </td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ @$data->nama }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ @$data->nohp }}</td>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ @$data->nim }}</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ @$data->jurusan }}</td>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td> 
                                                                                            <div class="text-uppercase">
                                                                                                {{ @$data->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Tanggal Pengajuan</th>
                                                                                        <td>{{ @$data->tgl_pengajuan }}
                                                                                        </td>
                                                                                        <th>Nama Pembimbing 1</th>
                                                                                        <td>{{ @$data->nm_pembimbing1 }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Nama Pembimbing 2</th>
                                                                                        <td>{{ @$data->nm_pembimbing2 }}
                                                                                        </td>
                                                                                    @php
                                                                                        $path = Storage::url('pskta/' . @$data->ba_up);
                                                                                    @endphp
                                                                                        <th style="vertical-align: middle;">
                                                                                            Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskta', 'fileName' => $data->ba_up]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Berita Acara UP
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data))
                                                                                        @foreach ($data->transwfpskta as $data2)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                SK Tugas Akhir</strong></td>
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
                                                                                                <td colspan="2"><strong>
                                                                                                        {{ $data2->wfr->status }}
                                                                                                </td>
                                                                                            @endif
                                                                                        @endif
                                                                                    </tr>
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
                                <h5 class="card-header">Daftar Pengajuan SK Tugas Akhir</h5>
                                <div class="card-body text-capitalize">
                                    <table class="table table-striped table-bordered text-capitalize data-table2" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Jenis Surat</th>
                                                <th>Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                    @if (isset($pengajuanpskta2))
                                        @foreach ($pengajuanpskta2 as $data2)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data2->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail
                                                                Pengajuan SK Tugas Akhir
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
                                                                            @foreach ($data2->transwfpskta as $data4)
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($data4->wfreference == '3')
                                                                            <div class="card-header text-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <a href="{{ route('tolakpengajuanpskta', $data4->id) }}"
                                                                                            class="btn btn-sm btn-danger">Tolak
                                                                                            Permintaan</a>
                                                                                        <a href="{{ route('terimapengajuanpskta', $data4->id) }}"
                                                                                            class="btn btn-sm btn-core">Terima
                                                                                            Permintaan</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <div class="card-body table-responsive">
                                                                            <table class="table table-bordered"
                                                                                style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="20%">Email</th>
                                                                                        <td width="30%">
                                                                                            <div class="text-lowercase">
                                                                                            {{ @$data2->email }}</div>
                                                                                        </td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ @$data2->nama }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ @$data2->nohp }}</td>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ @$data2->nim }}</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ @$data2->jurusan }}</td>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td>
                                                                                            <div class="text-uppercase">
                                                                                                {{ @$data2->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Tanggal Pengajuan</th>
                                                                                        <td>{{ @$data2->tgl_pengajuan }}
                                                                                        </td>
                                                                                        <th>Nama Pembimbing 1</th>
                                                                                        <td>{{ @$data2->nm_pembimbing1 }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Nama Pembimbing 2</th>
                                                                                        <td>{{ @$data2->nm_pembimbing2 }}
                                                                                        </td>

                                                                                    @php
                                                                                        $path = Storage::url('pskta/' . @$data2->ba_up);
                                                                                        
                                                                                    @endphp
                                                                                        <th style="vertical-align: middle;">
                                                                                            Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskta', 'fileName' => $data2->ba_up]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Berita Acara UP
                                                                                            </a>
                                                                                           
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data2))
                                                                                        @foreach ($data2->transwfpskta as $data4)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                SK TA</strong></td>
                                                                                        @if ($data4->wfr->status == 'Success')
                                                                                            <td colspan="2"
                                                                                                style="color:rgb(24, 163, 24);">
                                                                                                <strong>
                                                                                                    {{ $data4->wfr->status }}
                                                                                            </td>
                                                                                        @elseif($data4->wfr->status == 'Reject')
                                                                                            <td colspan="2"
                                                                                                style="color:red;"><strong>
                                                                                                    {{ $data4->wfr->status }}
                                                                                            </td>
                                                                                        @else
                                                                                            <td colspan="2"><strong>
                                                                                                    {{ $data4->wfr->status }}
                                                                                            </td>
                                                                                        @endif
                                                                                    </tr>
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

                        <div class="tab-pane fade" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Daftar Pengajuan SK Tugas Akhir</h5>
                                <div class="card-body text-capitalize">
                                    <table class="table table-striped table-bordered text-capitalize data-table3" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Jenis Surat</th>
                                                <th>Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                    @if (isset($pengajuanpskta3))
                                        @foreach ($pengajuanpskta3 as $data3)
                                            <div class="modal fade text-capitalize" id="Modall-{{ $data3->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail
                                                                Pengajuan SK Tugas Akhir
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
                                                                        @if (isset($data3))
                                                                            @foreach ($data3->transwfpskta as $data5)
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($data5->wfreference == '2')
                                                                            <div class="card-header text-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <a href="{{ route('tolakpengajuanpskta', $data5->id) }}"
                                                                                            class="btn btn-sm btn-danger">Tolak
                                                                                            Permintaan</a>
                                                                                        <a href="{{ route('terimapengajuanpskta', $data5->id) }}"
                                                                                            class="btn btn-sm btn-core">Terima
                                                                                            Permintaan</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <div class="card-body table-responsive">
                                                                            <table class="table table-bordered"
                                                                                style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="20%">Email</th>
                                                                                        <td width="30%">
                                                                                            <div class="text-lowercase">
                                                                                            {{ @$data3->email }}</div>
                                                                                        </td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ @$data3->nama }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ @$data3->nohp }}</td>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ @$data3->nim }}</td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ @$data3->jurusan }}</td>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td>
                                                                                            <div class="text-uppercase">
                                                                                                {{ @$data3->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Tanggal Pengajuan</th>
                                                                                        <td>{{ @$data3->tgl_pengajuan }}
                                                                                        </td>
                                                                                        <th>Nama Pembimbing 1</th>
                                                                                        <td>{{ @$data3->nm_pembimbing1 }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Nama Pembimbing 2</th>
                                                                                        <td>{{ @$data3->nm_pembimbing2 }}
                                                                                        </td>

                                                                                    @php
                                                                                        $path = Storage::url('pskta/' . @$data3->ba_up);
                                                                                        
                                                                                    @endphp
                                                                                        <th style="vertical-align: middle;">
                                                                                            Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskta', 'fileName' => $data3->ba_up]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Berita Acara UP
                                                                                            </a>
                                                                                           
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data3))
                                                                                        @foreach ($data3->transwfpskta as $data5)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                SK KP</strong></td>
                                                                                        @if ($data5->wfr->status == 'Success')
                                                                                            <td colspan="2"
                                                                                                style="color:rgb(24, 163, 24);">
                                                                                                <strong>
                                                                                                    {{ $data5->wfr->status }}
                                                                                            </td>
                                                                                        @elseif($data5->wfr->status == 'Reject')
                                                                                            <td colspan="2"
                                                                                                style="color:red;"><strong>
                                                                                                    {{ $data5->wfr->status }}
                                                                                            </td>
                                                                                        @else
                                                                                            <td colspan="2"><strong>
                                                                                                    {{ $data5->wfr->status }}
                                                                                            </td>
                                                                                        @endif
                                                                                    </tr>
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
                ajax: "{{ route('pengajuanpskta') }}",
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
                        data: 'jenis_surat',
                        name: 'jenis_surat'
                    },
                    {
                        data: 'transwfpskta[].wfr.status',
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
                    "targets": 5, // your case first column
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
                ajax: "{{ route('pengajuanpskta2') }}",
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
                        data: 'jenis_surat',
                        name: 'jenis_surat'
                    },
                    {
                        data: 'transwfpskta[].wfr.status',
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
                    "targets": 5, // your case first column
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
        var table = $('.data-table3').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pengajuanpskta3') }}",
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
                    data: 'jenis_surat',
                    name: 'jenis_surat'
                },
                {
                    data: 'transwfpskta[].wfr.status',
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
                "targets": 5, // your case first column
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
