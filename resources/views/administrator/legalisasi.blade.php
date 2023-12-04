@extends('layouts.administrator')

@section('nav')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('administrator.beranda') }}">Dashboard</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('legalisasi') }}">Pengajuan Legalisasi</a>
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
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link" id="sudah-tab" data-toggle="tab" href="#sudah" role="tab"
                                aria-controls="sudah" aria-selected="false">Selesai dibuat</a>
                        </li> --}}
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="butuh" role="tabpanel" aria-labelledby="butuh-tab">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Daftar Pengajuan Legalisasi Dokumen</h5>
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
                                    @if (isset($legalisasi))
                                        @foreach ($legalisasi as $data)
                                            <div class="modal fade text-capitalize" id="exampleModal-{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Verifikasi
                                                                Pengajuan
                                                                Legalisasi Dokumen</h5>
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
                                                                            @foreach ($data->transwflegalisasi as $data2)
                                                                            @endforeach
                                                                        @endif
                                                                        @if (isset($data2))
                                                                            @if ($data2->wfreference == '1')
                                                                                <div class="card-header text-center">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <a href="{{ route('tolaklegalisasi', $data2->id) }}"
                                                                                                class="btn btn-sm btn-danger">Tolak
                                                                                                Permintaan</a>
                                                                                            <a href="{{ route('terimalegalisasi', $data2->id) }}"
                                                                                                class="btn btn-sm btn-core">Terima
                                                                                                Permintaan</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                        <div class="card-body table-responsive text-capitalize">
                                                                            <table class="table table-bordered"
                                                                                style="width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th width="20%">Email</th>
                                                                                        <td width="30%">
                                                                                            <div class="text-lowercase">
                                                                                            {{ $data->email }}</div></td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ $data->nama }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data->nim }}</td>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data->jurusan }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td> 
                                                                                            <div class="text-uppercase">
                                                                                                {{ $data->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ $data->nohp }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Jenis Dokumen</th>
                                                                                        <td>{{ $data->jenisdok }}</td>
                                                                                        <th>Lembar</th>
                                                                                        <td>{{ $data->jumlah }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    @php
                                                                                        $path = Storage::url('legalisasi/' . $data->file_asli);
                                                                                        $path2 = Storage::url('legalisasi/' . $data->file_fotocopy);
                                                                                        
                                                                                    @endphp
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="1"><strong> Lampiran
                                                                                            </strong></td>
                                                                                        <td colspan="3">
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'legalisasi', 'fileName' => $data->file_asli]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan File atau Dokumen Asli
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'legalisasi', 'fileName' => $data->file_fotocopy]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan File atau Dokumen
                                                                                                Fotocopy
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data))
                                                                                        @foreach ($data->transwflegalisasi as $data2)
                                                                                            <tr class="bg-light">
                                                                                                <td colspan="2"><strong>
                                                                                                        Status
                                                                                                        Pengajuan
                                                                                                        Legalisasi Dokumen</strong></td>
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
                                                                                                        <td colspan="2">
                                                                                                            <strong>
                                                                                                                {{ $data2->wfr->status }}
                                                                                                        </td>
                                                                                                    @endif
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


                        <div class="tab-pane fade" id="sudah" role="tabpanel" aria-labelledby="sudah-tab">
                            <div class="card shadow-sm">
                                <h5 class="card-header">Daftar Pengajuan Legalisasi Dokumen</h5>
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
                                    @if (isset($legalisasi2))
                                        @foreach ($legalisasi2 as $data2)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data2->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail
                                                                Pengajuan Legalisasi Dokumen
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
                                                                            @foreach ($data2->transwflegalisasi as $data3)
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($data3->wfreference == '2')
                                                                            <div class="card-header text-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        {{-- <a href="{{ route('tolaklegalisasi', $data3->id) }}"
                                                                                            class="btn btn-sm btn-danger">Tolak
                                                                                            Permintaan</a> --}}
                                                                                        <a href="{{ route('proseslegalisasi', $data3->id) }}"
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
                                                                                            {{ $data2->email }}</div></td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ $data2->nama }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data2->nim }}</td>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data2->jurusan }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td>
                                                                                            <div class="text-uppercase">
                                                                                                {{ $data2->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ $data2->nohp }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Jenis Dokumen</th>
                                                                                        <td>{{ $data2->jenisdok }}</td>
                                                                                        <th>Lembar</th>
                                                                                        <td>{{ $data2->jumlah }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    @php
                                                                                        $path = Storage::url('legalisasi/' . $data2->file_asli);
                                                                                        $path2 = Storage::url('legalisasi/' . $data2->file_fotocopy);
                                                                                        
                                                                                    @endphp
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="1"><strong>
                                                                                                Lampiran </strong></td>
                                                                                        <td colspan="3">
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'legalisasi', 'fileName' => $data2->file_asli]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan File atau Dokumen Asli
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'legalisasi', 'fileName' => $data2->file_fotocopy]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan File atau Dokumen
                                                                                                Fotocopy
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data2))
                                                                                        @foreach ($data2->transwflegalisasi as $data3)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                Legalisasi Dokumen</strong></td>
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
                                <h5 class="card-header">Daftar Pengajuan Legalisasi Dokumen</h5>
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
                                    @if (isset($legalisasi3))
                                        @foreach ($legalisasi3 as $data3)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data3->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail
                                                                Pengajuan Legalisasi Dokumen
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
                                                                            @foreach ($data3->transwflegalisasi as $data4)
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($data4->wfreference == '2')
                                                                            <div class="card-header text-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <a href="{{ route('tolaklegalisasi', $data4->id) }}"
                                                                                            class="btn btn-sm btn-danger">Tolak
                                                                                            Permintaan</a>
                                                                                        <a href="{{ route('proseslegalisasi', $data4->id) }}"
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
                                                                                            {{ $data3->email }}</div></td>
                                                                                        <th width="20%">Nama</th>
                                                                                        <td width="30%">
                                                                                            {{ $data3->nama }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>NIM</th>
                                                                                        <td>{{ $data3->nim }}</td>
                                                                                        <th>Jurusan</th>
                                                                                        <td>{{ $data3->jurusan }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Jenis Surat</th>
                                                                                        <td>
                                                                                            <div class="text-uppercase">
                                                                                                {{ $data3->jenis_surat }}
                                                                                            </div>
                                                                                        </td>
                                                                                        <th>No Handphone</th>
                                                                                        <td>{{ $data3->nohp }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>Jenis Dokumen</th>
                                                                                        <td>{{ $data3->jenisdok }}</td>
                                                                                        <th>Lembar</th>
                                                                                        <td>{{ $data3->jumlah }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    @php
                                                                                        $path = Storage::url('legalisasi/' . $data3->file_asli);
                                                                                        $path2 = Storage::url('legalisasi/' . $data3->file_fotocopy);
                                                                                        
                                                                                    @endphp
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="1"><strong>
                                                                                                Lampiran </strong></td>
                                                                                        <td colspan="3">
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'legalisasi', 'fileName' => $data3->file_asli]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan File atau Dokumen Asli
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'legalisasi', 'fileName' => $data3->file_fotocopy]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Scan File atau Dokumen
                                                                                                Fotocopy
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data3))
                                                                                        @foreach ($data3->transwflegalisasi as $data4)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                Legalisasi Dokumen</strong></td>
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
                ajax: "{{ route('legalisasi') }}",
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
                        data: 'transwflegalisasi[].wfr.status',
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
                ajax: "{{ route('legalisasi2') }}",
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
                        data: 'transwflegalisasi[].wfr.status',
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
                ajax: "{{ route('legalisasi3') }}",
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
                        data: 'transwflegalisasi[].wfr.status',
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
