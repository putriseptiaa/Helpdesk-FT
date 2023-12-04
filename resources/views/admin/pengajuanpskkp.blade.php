@extends('layouts.administrator1')

@section('nav')
    {{-- <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li> --}}
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.beranda') }}">Informasi</a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('pengajuanpskkpp') }}">Pengajuan SK Kerja Praktek</a>
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
                                <h5 class="card-header">Daftar Pengajuan SK Kerja Praktek</h5>
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
                                    @if (isset($pengajuanpskkp))
                                        @foreach ($pengajuanpskkp as $data)
                                            <div class="modal fade text-capitalize" id="exampleModal-{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Verifikasi
                                                                Pengajuan
                                                                SK KP</h5>
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
                                                                            @foreach ($data->transwfpskkp as $data2)
                                                                                @if (isset($data2))
                                                                                    @if ($data2->wfreference == '1')
                                                                                        <div
                                                                                            class="card-header text-center">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-12">
                                                                                                    <a href="{{ route('tolakpengajuanpskkpp', $data2->id) }}"
                                                                                                        class="btn btn-sm btn-danger">Tolak
                                                                                                        Permintaan</a>
                                                                                                    <a href="{{ route('terimapengajuanpskkpp', $data2->id) }}"
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
                                                                                        <th>Pembimbing</th>
                                                                                        <td>{{ @$data->nm_pembimbing }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Bukti Pengajuan KP</th>
                                                                                        <td>{{ @$data->bukti_ajuankp }}
                                                                                        </td>
                                                                                        <th>Bukti Ombus dan PBN</th>
                                                                                        <td>{{ @$data->scanombuspbn }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    @php
                                                                                        $path = Storage::url('pskkp/' . @$data->pmagang);
                                                                                        $path1 = Storage::url('pskkp/' . @$data->upfor_ajuan);
                                                                                        $path2 = Storage::url('pskkp/' . @$data->upper_pembimbing);
                                                                                        $path3 = Storage::url('pskkp/' . @$data->up_ombus);
                                                                                        $path4 = Storage::url('pskkp/' . @$data->up_pbn);
                                                                                        $path5 = Storage::url('pskkp/' . @$data->transkip);
                                                                                        $path6 = Storage::url('pskkp/' . @$data->pernyataan);
                                                                                    @endphp
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="1"><strong> Lampiran
                                                                                            </strong></td>
                                                                                        <td colspan="3">
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data->pmagang]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Surat Penerimaan Magang
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data->upfor_ajuan]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Foto Formulir Pengajuan KP
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data->upper_pembimbing]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="1000"
                                                                                                data-max-height="800">
                                                                                                Persetujuan Pembimbing
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data->up_ombus]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Sertifikat OMBUS
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data->up_pbn]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Sertifikat PBN
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data->transkip]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Transkip Nilai
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data->pernyataan]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Pernyataan
                                                                                            </a>

                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data))
                                                                                        @foreach ($data->transwfpskkp as $data2)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                SK KP</strong></td>
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
                                <h5 class="card-header">Daftar Pengajuan SK KP</h5>
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
                                    @if (isset($pengajuanpskkp2))
                                        @foreach ($pengajuanpskkp2 as $data2)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data2->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail
                                                                Pengajuan SK KP
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
                                                                            @foreach ($data2->transwfpskkp as $data3)
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($data3->wfreference == '2')
                                                                            <div class="card-header text-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        {{-- <a href="{{ route('tolakpengajuanpskkpp', $data3->id) }}"
                                                                                            class="btn btn-sm btn-danger">Tolak
                                                                                            Permintaan</a> --}}
                                                                                        <a href="{{ route('prosespengajuanpskkpp', $data3->id) }}"
                                                                                            class="btn btn-sm btn-core">Peoses Selesai</a>
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
                                                                                        <th>Pembimbing</th>
                                                                                        <td>{{ @$data2->nm_pembimbing }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Bukti Pengajuan KP</th>
                                                                                        <td>{{ @$data2->bukti_ajuankp }}
                                                                                        </td>
                                                                                        <th>Bukti Ombus dan PBN</th>
                                                                                        <td>{{ @$data2->scanombuspbn }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    @php
                                                                                        $path = Storage::url('pskkp/' . @$data2->pmagang);
                                                                                        $path1 = Storage::url('pskkp/' . @$data2->upfor_ajuan);
                                                                                        $path2 = Storage::url('pskkp/' . @$data2->upper_pembimbing);
                                                                                        $path3 = Storage::url('pskkp/' . @$data2->up_ombus);
                                                                                        $path4 = Storage::url('pskkp/' . @$data2->up_pbn);
                                                                                        $path5 = Storage::url('pskkp/' . @$data2->transkip);
                                                                                        $path6 = Storage::url('pskkp/' . @$data2->pernyataan);
                                                                                        
                                                                                    @endphp
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="1"><strong>
                                                                                                Lampiran </strong></td>
                                                                                        <td colspan="3">
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data2->pmagang]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Surat Penerimaan Magang
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data2->upfor_ajuan]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Foto Formulir Pengajuan KP
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data2->upper_pembimbing]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="1000"
                                                                                                data-max-height="800">
                                                                                                Persetujuan Pembimbing
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data2->up_ombus]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Sertifikat OMBUS
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data2->up_pbn]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Sertifikat PBN
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data2->transkip]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Transkip Nilai
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data2->pernyataan]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Pernyataan
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data2))
                                                                                        @foreach ($data2->transwfpskkp as $data3)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                SK KP</strong></td>
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
                                <h5 class="card-header">Daftar Pengajuan SK KP</h5>
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
                                    @if (isset($pengajuanpskkp3))
                                        @foreach ($pengajuanpskkp3 as $data3)
                                            <div class="modal fade text-capitalize" id="Modal-{{ $data3->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class=" modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal3Label">Detail
                                                                Pengajuan SK KP
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
                                                                            @foreach ($data3->transwfpskkp as $data4)
                                                                            @endforeach
                                                                        @endif
                                                                        @if ($data4->wfreference == '2')
                                                                            <div class="card-header text-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <a href="{{ route('tolakpengajuanpskkpp', $data4->id) }}"
                                                                                            class="btn btn-sm btn-danger">Tolak
                                                                                            Permintaan</a>
                                                                                        <a href="{{ route('terimapengajuanpskkpp', $data4->id) }}"
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
                                                                                        <th>Pembimbing</th>
                                                                                        <td>{{ @$data3->nm_pembimbing }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <th>Bukti Pengajuan KP</th>
                                                                                        <td>{{ @$data3->bukti_ajuankp }}
                                                                                        </td>
                                                                                        <th>Bukti Ombus dan PBN</th>
                                                                                        <td>{{ @$data3->scanombuspbn }}
                                                                                        </td>
                                                                                    </tr>

                                                                                    @php
                                                                                        $path = Storage::url('pskkp/' . @$data3->pmagang);
                                                                                        $path1 = Storage::url('pskkp/' . @$data3->upfor_ajuan);
                                                                                        $path2 = Storage::url('pskkp/' . @$data3->upper_pembimbing);
                                                                                        $path3 = Storage::url('pskkp/' . @$data3->up_ombus);
                                                                                        $path4 = Storage::url('pskkp/' . @$data3->up_pbn);
                                                                                        $path5 = Storage::url('pskkp/' . @$data3->transkip);
                                                                                        $path6 = Storage::url('pskkp/' . @$data3->pernyataan);
                                                                                        
                                                                                    @endphp
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="1"><strong>
                                                                                                Lampiran </strong></td>
                                                                                        <td colspan="3">
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data3->pmagang]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Surat Penerimaan Magang
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data3->upfor_ajuan]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="800"
                                                                                                data-max-height="800">
                                                                                                Foto Formulir Pengajuan KP
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data3->upper_pembimbing]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="1000"
                                                                                                data-max-height="800">
                                                                                                Persetujuan Pembimbing
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data3->up_ombus]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Sertifikat OMBUS
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data3->up_pbn]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Sertifikat PBN
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data3->transkip]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Transkip Nilai
                                                                                            </a>
                                                                                            |
                                                                                            <a class="color-pink"
                                                                                                href="{{ route('downloadLampiran', ['dir' => 'pskkp', 'fileName' => $data3->pernyataan]) }}"
                                                                                                {{-- target="_blank"
                                                                                                data-toggle="lightbox" --}}
                                                                                                data-max-width="600"
                                                                                                data-max-height="600">
                                                                                                Pernyataan
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @if (isset($data3))
                                                                                        @foreach ($data3->transwfpskkp as $data4)
                                                                                        @endforeach
                                                                                    @endif
                                                                                    <tr class="bg-light">
                                                                                        <td colspan="2"><strong> Status
                                                                                                Pengajuan
                                                                                                SK KP</strong></td>
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
                ajax: "{{ route('pengajuanpskkpp') }}",
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
                        data: 'transwfpskkp[].wfr.status',
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
                ajax: "{{ route('pengajuanpskkpp2') }}",
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
                        data: 'transwfpskkp[].wfr.status',
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
                ajax: "{{ route('pengajuanpskkpp3') }}",
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
                        data: 'transwfpskkp[].wfr.status',
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
