@extends('layouts.administrator')

@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('administrator.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('pengajuanpptakp') }}">Pengajuan Perpanjangan TA dan KP</a>
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
                                aria-controls="butuh" aria-selected="true">Belum divalidasi</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="sudah-tab" data-toggle="tab" href="#sudah" role="tab"
                                aria-controls="sudah" aria-selected="false">Sudah divalidasi</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="butuh" role="tabpanel" aria-labelledby="butuh-tab">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Daftar Pengajuan Perpanjangan TA dan KP</h5>
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
                                    @if (isset($pengajuanpptakp))
                                        @foreach ($pengajuanpptakp as $data)
                                            <div class="modal fade text-capitalize" id="exampleModal-{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Verifikasi
                                                                Pengajuan
                                                                Perpanjangan TA da KP</h5>
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
                                                                            @foreach ($data->transwfpptakp as $data2)
                                                                                @if (isset($data2))
                                                                                    @if ($data2->wfreference == '1')
                                                                                        <div
                                                                                            class="card-header text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <a href="{{ route('tolakpengajuanpptakp', $data2->id) }}"
                                                                                                        class="btn btn-sm btn-danger">Tolak
                                                                                                        Permintaan</a>
                                                                                                    <a href="{{ route('terimapengajuanpptakp', $data2->id) }}"
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
                                                                                            {{ $data->email }}</div>
                                                                                        </td>

                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ $data->nama }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ $data->nohp }}
                                                                                        </td>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data->nim }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data->jurusan }}
                                                                                        </td>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td>
                                                                                            <div class="text-uppercase">
                                                                                                {{ $data->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Permohonan Pembuatan Dokumen
                                                                                        </th>
                                                                                        <td>{{ $data->permohonan_dok }}
                                                                                        </td>
                                                                                    
                                                                                    @php
                                                                                        $path = Storage::url('pptakp/' . $data->skpembimbing_akhir);
                                                                                        $path2 = Storage::url('pptakp/' . $data->uppernyataan_perspem);
                                                                                    @endphp
                                                                                   
                                                                                        <th style="vertical-align: middle;">
                                                                                            Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pptakp', 'fileName' => $data->skpembimbing_akhir]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan SK Pembimbing Akhir
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pptakp', 'fileName' => $data->uppernyataan_perspem]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="1000"
                                                                                                data-max-height="800">
                                                                                                Pernyataan Persetujuan
                                                                                                Pembimbing
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data))
                                                                                        @foreach ($data->transwfpptakp as $data2)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                Perpanjangan TA da KP</strong></td>
                                                                                        @if (isset($data2))
                                                                                            @if ($data2->wfr->status == 'Success')
                                                                                                <td colspan="2"
                                                                                                    style="color:rgb(24, 163, 24);">
                                                                                                    <strong>
                                                                                                        {{ $data3->wfr->status }}
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
                                <h5 class="card-header">Daftar Pengajuan Perpanjangan TA da KP</h5>
                                <div class="card-body">
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
                                    @if (isset($pengajuanpptakp2))
                                        @foreach ($pengajuanpptakp2 as $data2)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data2->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail
                                                                Pengajuan Perpanjangan TA dan KP
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
                                                                            @foreach ($data2->transwfpptakp as $data3)
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($data3->wfreference == '2')
                                                                            <div class="card-header text-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        {{-- <a href="{{ route('tolakpengajuanpptakp', $data3->id) }}"
                                                                                            class="btn btn-sm btn-danger">Tolak
                                                                                            Permintaan</a> --}}
                                                                                        <a href="{{ route('prosespengajuanpptakp', $data3->id) }}"
                                                                                            class="btn btn-sm btn-core"> Proses Selesai </a>
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
                                                                                            {{ $data2->email }}</div>
                                                                                        </td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ $data2->nama }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ $data2->nohp }}
                                                                                        </td>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data2->nim }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data2->jurusan }}
                                                                                        </td>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td>
                                                                                            <div class="text-uppercase">
                                                                                                {{ $data2->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Permohonan Pembuatan Dokumen
                                                                                        </th>
                                                                                        <td>{{ $data2->permohonan_dok }}
                                                                                        </td>
                                                                                    


                                                                                    @php
                                                                                        $path = Storage::url('pptakp/' . $data2->skpembimbing_akhir);
                                                                                        $path2 = Storage::url('pptakp/' . $data2->uppernyataan_perspem);
                                                                                    @endphp
                                                                                    
                                                                                        <th
                                                                                            style="vertical-align: middle;">
                                                                                            Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pptakp', 'fileName' => $data2->skpembimbing_akhir]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan SK Pembimbing Akhir
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pptakp', 'fileName' => $data2->uppernyataan_perspem]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="1000"
                                                                                                data-max-height="800">
                                                                                                Pernyataan Persetujuan
                                                                                                Pembimbing
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data2))
                                                                                        @foreach ($data2->transwfpptakp as $data3)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                Perpanjangan TA dan KP</strong></td>
                                                                                        @if ($data3->wfr->status == 'Success')
                                                                                            <td colspan="2"
                                                                                                style="color:rgb(24, 163, 24);">
                                                                                                <strong>
                                                                                                    {{ $data3->wfr->status }}
                                                                                            </td>
                                                                                        @elseif($data3->wfr->status == 'Reject')
                                                                                            <td colspan="2"
                                                                                                style="color:red;"><strong>
                                                                                                    {{ $data3->wfr->status }}
                                                                                            </td>
                                                                                        @else
                                                                                            <td colspan="2"><strong>
                                                                                                    {{ $data3->wfr->status }}
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
						
						
						<div class="tab-pane fade" id="sudah" role="tabpanel" aria-labelledby="sudah-tab">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Daftar Pengajuan Perpanjangan TA da KP</h5>
                                <div class="card-body">
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
                                    @if (isset($pengajuanpptakp3))
                                        @foreach ($pengajuanpptakp3 as $data3)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data3->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail
                                                                Pengajuan Perpanjangan TA dan KP
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
                                                                            @foreach ($data3->transwfpptakp as $data4)
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($data4->wfreference == '2')
                                                                            <div class="card-header text-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        {{-- <a href="{{ route('tolakpengajuanpptakp', $data4->id) }}"
                                                                                            class="btn btn-sm btn-danger">Tolak
                                                                                            Permintaan</a> --}}
                                                                                        <a href="{{ route('prosespengajuanpptakp', $data4->id) }}"
                                                                                            class="btn btn-sm btn-core"> Proses Selesai </a>
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
                                                                                            {{ $data3->email }}</div>
                                                                                        </td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ $data3->nama }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ $data3->nohp }}
                                                                                        </td>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data3->nim }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data3->jurusan }}
                                                                                        </td>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td>
                                                                                            <div class="text-uppercase">
                                                                                                {{ $data3->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Permohonan Pembuatan Dokumen
                                                                                        </th>
                                                                                        <td>{{ $data3->permohonan_dok }}
                                                                                        </td>
                                                                                    


                                                                                    @php
                                                                                        $path = Storage::url('pptakp/' . $data3->skpembimbing_akhir);
                                                                                        $path2 = Storage::url('pptakp/' . $data3->uppernyataan_perspem);
                                                                                    @endphp
                                                                                    
                                                                                        <th
                                                                                            style="vertical-align: middle;">
                                                                                            Lampiran
                                                                                        </th>
                                                                                        <td>
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pptakp', 'fileName' => $data3->skpembimbing_akhir]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan SK Pembimbing Akhir
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pptakp', 'fileName' => $data3->uppernyataan_perspem]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="1000"
                                                                                                data-max-height="800">
                                                                                                Pernyataan Persetujuan
                                                                                                Pembimbing
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data3))
                                                                                        @foreach ($data3->transwfpptakp as $data4)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                Perpanjangan TA dan KP</strong></td>
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
                ajax: "{{ route('pengajuanpptakp') }}",
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
                        data: 'jenis_surat',
                        name: 'jenis_surat'
                    },
                    {
                        data: 'transwfpptakp[].wfr.status',
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
                ajax: "{{ route('pengajuanpptakp2') }}",
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
                        data: 'jenis_surat',
                        name: 'jenis_surat'
                    },
                    {
                        data: 'transwfpptakp[].wfr.status',
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
                ajax: "{{ route('pengajuanpptakp3') }}", 
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
                        data: 'jenis_surat',
                        name: 'jenis_surat'
                    },
                    {
                        data: 'transwfpptakp[].wfr.status',
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
