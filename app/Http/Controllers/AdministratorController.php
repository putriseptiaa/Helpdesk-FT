<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Legalisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Notifikasi;
use App\Models\Pengajuanbpit;
use App\Models\Pengajuanpptakp;
use App\Models\Pengajuanpskkp;
use App\Models\Pengajuanpskta;
use App\Models\Pengajuansemta;
use App\Models\Pengajuanskp;
use App\Models\Pengajuanspta;
use App\Models\Pengajuansta;
use App\Models\Pengajuanulkp;
use App\Models\Pengajuanulta;
use App\Models\TransWF;
use App\Models\TransWFbpit;
use App\Models\TransWFlegalisasi;
use App\Models\TransWFpptakp;
use App\Models\TransWFpskkp;
use App\Models\TransWFpskta;
use App\Models\TransWFsemta;
use App\Models\TransWFskp;
use App\Models\TransWFsta;
use App\Models\TransWFulkp;
use App\Models\TransWFulta;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    public function info()
    {
        return view('administrator.info');
    }

    //Profile Update
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('administrator.profileadministrator', compact('user'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name'       => 'required|string|min:2|max:100',
            'email'      => 'required|email|unique:users,email, ' . $id . ',id',
            'old_password' => 'nullable|string',
            'password' => 'nullable|required_with:old_password|string|confirmed|min:8'
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Please enter the correct password')])
                    ->withInput();
            }
        }

        if (request()->hasFile('photo')) {
            if ($user->photo && file_exists(storage_path('app/public/photos/' . $user->photo))) {
                Storage::delete('app/public/photos/' . $user->photo);
            }

            $file = $request->file('photo');
            $fileName = $file->hashName() . '.' . $file->getClientOriginalExtension();
            $request->photo->move(storage_path('app/public/photos'), $fileName);
            $user->photo = $fileName;
        }


        $user->save();

        // return back()->withToast('status', 'Profile updated!');
        return redirect()->route('profileadministrator.index')->withToastSuccess('Profile update berhasil!');
    }


    //SPTA
    public function pengajuanspta(Request $request)
    {
        $spta = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();
        // dd($spta[0]);
        if ($request->ajax()) {
            $data = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanspta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $spta2 = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanspta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $spta3 = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanspta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanspta', compact('spta', 'spta2', 'spta3'));
    }

    public function pengajuanspta2(Request $request)
    {
        $pengajuan2 = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanspta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanspta', compact('spta2'));
    }

    public function pengajuanspta3(Request $request)
    {
        $pengajuan3 = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanspta::with('user', 'user.pengajuanspta', 'transwf', 'transwf.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanspta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanspta', compact('spta3'));
    }

    public function terimapengajuanspta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanspta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuanspta')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuanspta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuanspta')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWF::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang Proposal TA Telah diterima dan akan diproses";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWF::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuanspta::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuanspta')->withToastSuccess('Pengajuan Sidang Proposal TA telah Disetujui');
        } else {
            return redirect()->route('pengajuanspta')->withToastError('Pengajuan Sidang Proposal TA Ditolak');
        }
    }

    public function tolakpengajuanspta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanspta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuanspta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWF::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang Proposal TA ditolak. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWF::where('id', $id)->update([
            'wfreference' => "4",
            "history" => $array,
        ]);
        $update3 = Pengajuanspta::where('id', $id)->update([
            'current_wp' => "4",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanspta')->withToastError('Pengajuan telah di Tolak!');
        } else {
            return redirect()->route('pengajuanspta')->withToastError('Pengajuan Gagal!');
        }
    }

    public function prosespengajuanspta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanspta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuanspta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWF::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang Proposal TA telah Selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan  pada Hari H sidang untuk mengambil Berita Acara (BA) yang diajukan.";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWF::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuanspta::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanspta')->withToastError('Pengajuan Sidang Proposal TA Selesai dibuat.');
        } else {
            return redirect()->route('pengajuanspta')->withToastError('Pengajuan Gagal!');
        }
    }
    
    //     public function generatePDF($id)
    //     {
    //         $item = Pengajuan::where('id', $id)->with('user', 'user.pengajuanspta')->get();
    //         foreach ($item as $data)

    //             if ($data->jenis_surat == 'surat_pengantar_skck') {

    //                 return  $pdf = PDF::loadView('surat/surat_pengantar_skck/index', compact('data'))
    //                     ->stream('surat-pengantar-skck' . $data->user['nik']->id_ktp . '.pdf');
    //             } else if ($data->jenis_surat == 'surat_keterangan_domisili') {

    //                 return  $pdf = PDF::loadView('surat/surat_keterangan_domisili/index', compact('data'))
    //                     ->stream('surat-keterangan-domisili' . $data->user['nik']->id_ktp . '.pdf');
    //             } else if ($data->jenis_surat == 'surat_keterangan') {

    //                 return  $pdf = PDF::loadView('surat/surat_keterangan/index', compact('data'))
    //                     ->stream('surat-keterangan' . $data->user['nik']->id_ktp . '.pdf');
    //             } else if ($data->jenis_surat == 'surat_keterangan_usaha') {

    //                 return  $pdf = PDF::loadView('surat/surat_keterangan_usaha/index', compact('data'))
    //                     ->stream('surat-keterangan-usaha' . $data->user['nik']->id_ktp . '.pdf');
    //             } else if ($data->jenis_surat == 'surat_keterangan_berkelakuan_baik') {

    //                 return  $pdf = PDF::loadView('surat/surat_keterangan_berkelakuan_baik/index', compact('data'))
    //                     ->stream('surat-keterangan-berkelakuan-baik' . $data->user['nik']->id_ktp . '.pdf');
    //             }
    //     }
    // }

    //SEMTA
    public function pengajuansemta(Request $request)
    {
        $pengajuansemta = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansemta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuansemta2 = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansemta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuansemta3 = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansemta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuansemta', compact('pengajuansemta', 'pengajuansemta2', 'pengajuansemta3'));
    }

    public function pengajuansemta2(Request $request)
    {
        $pengajuan2 = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansemta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuansemta', compact('pengajuansemta2'));
    }

    public function pengajuansemta3(Request $request)
    {
        $pengajuan2 = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansemta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuansemta', compact('pengajuansemta3'));
    }

    public function terimapengajuansemta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWFsemta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Seminar TA Telah diterima dan akan diproses.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFsemta::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuansemta::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuansemta')->withToastSuccess('Pengajuan Seminar TA telah Disetujui');
        } else {
            return redirect()->route('pengajuansemta')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuansemta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFsemta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Seminar TA ditolak. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFsemta::where('id', $id)->update([
            'wfreference' => "4",
            "history" => $array,
        ]);
        $update3 = Pengajuansemta::where('id', $id)->update([
            'current_wp' => "4",
        ]);
        if ($update3) {
            return redirect()->route('pengajuansemta')->withToastError('Pengajuan telah di Tolak!');
        } else {
            return redirect()->route('pengajuansemta')->withToastError('Pengajuan Gagal!');
        }
    }

    public function prosespengajuansemta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFsemta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Seminar TA telah Selesai dibuat.  Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan untuk mengambil hasil Pengajuan.";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFsemta::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuansemta::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuansemta')->withToastSuccess('Pengajuan Seminar TA telah Selesai dibuat.');
        } else {
            return redirect()->route('pengajuansemta')->withToastError('Pengajuan Gagal!');
        }
    }

    //STA
    public function pengajuansta(Request $request)
    {
        $pengajuansta = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuansta2 = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuansta3 = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuansta', compact('pengajuansta', 'pengajuansta2', 'pengajuansta3'));
    }

    public function pengajuansta2(Request $request)
    {
        $pengajuan2 = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuansta', compact('pengajuansta2'));
    }

    public function pengajuansta3(Request $request)
    {
        $pengajuan3 = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuansta::with('user', 'user.pengajuansta', 'transwfsta', 'transwfsta.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuansta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuansta', compact('pengajuansta3'));
    }

    public function terimapengajuansta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuansta')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuansta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuansta')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWFsta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang TA Telah diterima dan akan diproses. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan  pada Hari H sidang untuk mengambil Berita Acara (BA) yang diajukan.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFsta::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuansta::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuansta')->withToastSuccess('Pengajuan Sidang TA telah Disetujui');
        } else {
            return redirect()->route('pengajuansta')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuansta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuansta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFsta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang TA ditolak. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFsta::where('id', $id)->update([
            'wfreference' => "4",
            "history" => $array,
        ]);
        $update3 = Pengajuansta::where('id', $id)->update([
            'current_wp' => "4",
        ]);
        if ($update3) {
            return redirect()->route('pengajuansta')->withToastError('Pengajuan telah di Tolak!');
        } else {
            return redirect()->route('pengajuansta')->withToastError('Pengajuan Gagal!');
        }
    }

    public function prosespengajuansta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFsta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang TA telah Selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan  pada Hari H sidang untuk mengambil Berita Acara (BA) yang diajukan.";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFsta::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuansta::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuansemta')->withToastSuccess('Pengajuan Sidang TA telah Selesai dibuat.');
        } else {
            return redirect()->route('pengajuansemta')->withToastError('Pengajuan Gagal!');
        }
    }


    // SKP
    public function pengajuanskp(Request $request)
    {
        $pengajuanskp = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanskp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanskp2 = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanskp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanskp3 = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanskp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanskp', compact('pengajuanskp', 'pengajuanskp2', 'pengajuanskp3'));
    }

    public function pengajuanskp2(Request $request)
    {
        $pengajuan2 = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanskp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanskp', compact('pengajuanskp2'));
    }

    public function pengajuanskp3(Request $request)
    {
        $pengajuan3 = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanskp::with('user', 'user.pengajuanskp', 'transwfskp', 'transwfskp.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanskp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanskp', compact('pengajuanskp3'));
    }

    public function terimapengajuanskp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanskp')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuanskp')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuanskp')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuanskp')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWFskp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang KP Telah diterima dan akan diproses.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFskp::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuanskp::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuanskp')->withToastSuccess('Pengajuan Sidang KP telah Disetujui');
        } else {
            return redirect()->route('pengajuanskp')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuanskp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanskp')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuanskp')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFskp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang KP ditolak. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFskp::where('id', $id)->update([
            'wfreference' => "4",
            "history" => $array,
        ]);
        $update3 = Pengajuanskp::where('id', $id)->update([
            'current_wp' => "4",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanskp')->withToastError('Pengajuan telah di Tolak!');
        } else {
            return redirect()->route('pengajuanskp')->withToastError('Pengajuan Gagal!');
        }
    }

    public function prosespengajuanskp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFskp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Sidang KP telah Selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan  pada Hari H sidang untuk mengambil Berita Acara (BA) yang diajukan.";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFskp::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuanskp::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanskp')->withToastSuccess('Pengajuan Sidang KP telah Selesai dibuat.');
        } else {
            return redirect()->route('pengajuanskp')->withToastError('Pengajuan Gagal!');
        }
    }


    // PSKKP
    public function pengajuanpskkp(Request $request)
    {
        $pengajuanpskkp = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskkp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanpskkp2 = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
            ->where('current_wp', '!=', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskkp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanpskkp3 = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
            ->where('current_wp', '!=', '2')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskkp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpskkp', compact('pengajuanpskkp', 'pengajuanpskkp2','pengajuanpskkp3'));
    }

    public function pengajuanpskkp2(Request $request)
    {
        $pengajuan2 = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskkp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpskkp', compact('pengajuanpskkp2'));
    }

    public function pengajuanpskkp3(Request $request)
    {
        $pengajuan3 = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskkp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpskkp', compact('pengajuanpskkp3'));
    }

    public function terimapengajuanpskkp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanpskkp')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuanpskkp')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuanpskkp')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuanpskkp')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWFpskkp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan SK KP Telah diterima dan akan diproses.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFpskkp::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuanpskkp::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuanpskkp')->withToastSuccess('Pengajuan SK KP telah Disetujui');
        } else {
            return redirect()->route('pengajuanpskkp')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuanpskkp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanpskkp')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuanpskkp')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFpskkp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan SK KP ditolak. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFpskkp::where('id', $id)->update([
            'wfreference' => "4",
            "history" => $array,
        ]);
        $update3 = Pengajuanpskkp::where('id', $id)->update([
            'current_wp' => "4",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanpskkp')->withToastError('Pengajuan telah di Tolak!');
        } else {
            return redirect()->route('pengajuanpskkp')->withToastError('Pengajuan Gagal!');
        }
    }

    public function prosespengajuanpskkp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFpskkp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan SK KP telah Selesai dibuat.  Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan untuk mengambil hasil Pengajuan.";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFpskkp::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuanpskkp::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanpskkp')->withToastSuccess('Pengajuan SK KP telah Selesai dibuat.');
        } else {
            return redirect()->route('pengajuanpskkp')->withToastError('Pengajuan Gagal!');
        }
    }


    // PPTAKP
    public function pengajuanpptakp(Request $request)
    {
        $pengajuanpptakp = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpptakp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanpptakp2 = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpptakp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanpptakp3 = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '1') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpptakp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpptakp', compact('pengajuanpptakp', 'pengajuanpptakp2'));
    }

    public function pengajuanpptakp2(Request $request)
    {
        $pengajuan2 = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpptakp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpptakp', compact('pengajuanpptakp2'));
    }

    public function pengajuanpptakp3(Request $request)
    {
        $pengajuan3 = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanpptakp::with('user', 'user.pengajuanpptakp', 'transwfpptakp', 'transwfpptakp.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpptakp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpptakp', compact('pengajuanpptakp3'));
    }

    public function terimapengajuanpptakp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanpptakp')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuanpptakp')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuanpptakp')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuanpptakp')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWFpptakp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Perpanjangan TA atau KP Telah diterima dan akan diproses.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFpptakp::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuanpptakp::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuanpptakp')->withToastSuccess('Pengajuan Perpanjangan TA dan KP telah Disetujui');
        } else {
            return redirect()->route('pengajuanpptakp')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuanpptakp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanpptakp')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuanpptakp')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFpptakp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Perpanjangan TA dan KP ditolak. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFpptakp::where('id', $id)->update([
            'wfreference' => "4",
            "history" => $array,
        ]);
        $update3 = Pengajuanpptakp::where('id', $id)->update([
            'current_wp' => "4",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanpptakp')->withToastError('Pengajuan telah di Tolak!');
        } else {
            return redirect()->route('pengajuanpptakp')->withToastError('Pengajuan Gagal!');
        }
    }

    public function prosespengajuanpptakp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFpptakp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Perpanjangan TA atau KP telah Selesai dibuat.  Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan untuk mengambil hasil Pengajuan.";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFpptakp::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuanpptakp::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanpptakp')->withToastSuccess('Pengajuan Perpanjangan TA atau KP telah Selesai dibuat.');
        } else {
            return redirect()->route('pengajuanpptakp')->withToastError('Pengajuan Gagal!');
        }
    }

    // ULTA
    public function pengajuanulta(Request $request)
    {
        $pengajuanulta = Pengajuanulta::with('user', 'user.pengajuanulta', 'transwfulta', 'transwfulta.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanulta::with('user', 'user.pengajuanulta', 'transwfulta', 'transwfulta.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanulta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanulta2 = Pengajuanulta::with('user', 'user.pengajuanulta', 'transwfulta', 'transwfulta.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        // dd($pengajuanulta2);
        if ($request->ajax()) {
            $data = Pengajuanulta::with('user', 'user.pengajuanulta', 'transwfulta', 'transwfulta.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanulta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanulta', compact('pengajuanulta', 'pengajuanulta2'));
    }

    public function pengajuanulta2(Request $request)
    {
        $pengajuan2 = Pengajuanulta::with('user', 'user.pengajuanulta', 'transwfulta', 'transwfulta.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanulta::with('user', 'user.pengajuanulta', 'transwfulta', 'transwfulta.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanulta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanulta', compact('pengajuanulta2'));
    }

    public function terimapengajuanulta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanulta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuanulta')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuanulta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuanulta')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWFulta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Unggah Laporan TA Telah diterima Administrator. Terima kasih sudah mengunggah Laporan TA.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFulta::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuanulta::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuanulta')->withToastSuccess('Unggah Laporan TA telah Disetujui');
        } else {
            return redirect()->route('pengajuanulta')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuanulta($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanulta')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuanulta')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFulta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Unggah Laporan TA di Tolak Administrator. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFulta::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuanulta::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanulta')->withToastError('Pengajuan telah di Tolak oleh Administrator!');
        } else {
            return redirect()->route('pengajuanulta')->withToastError('Pengajuan Gagal!');
        }
    }

    // ULKP
    public function pengajuanulkp(Request $request)
    {
        $pengajuanulkp = Pengajuanulkp::with('user', 'user.pengajuanulkp', 'transwfulkp', 'transwfulkp.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanulkp::with('user', 'user.pengajuanulkp', 'transwfulkp', 'transwfulkp.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanulkp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanulkp2 = Pengajuanulkp::with('user', 'user.pengajuanulkp', 'transwfulkp', 'transwfulkp.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanulkp::with('user', 'user.pengajuanulkp', 'transwfulkp', 'transwfulkp.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanulkp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanulkp', compact('pengajuanulkp', 'pengajuanulkp2'));
    }

    public function pengajuanulkp2(Request $request)
    {
        $pengajuan2 = Pengajuanulkp::with('user', 'user.pengajuanulkp', 'transwfulkp', 'transwfulkp.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanulkp::with('user', 'user.pengajuanulkp', 'transwfulkp', 'transwfulkp.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanulkp/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanulkp', compact('pengajuanulkp2'));
    }

    public function terimapengajuanulkp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanulkp')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuanulkp')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuanulkp')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuanulkp')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWFulkp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Unggah Laporan KP Telah diterima Administrator. Terima kasih sudah mengunggah Laporan KP.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFulkp::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuanulkp::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuanulkp')->withToastSuccess('Unggah Laporan KP telah Disetujui');
        } else {
            return redirect()->route('pengajuanulkp')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuanulkp($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanulkp')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuanulkp')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFulkp::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Unggah Laporan KP di Tolak Administrator. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFulkp::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuanulkp::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanulkp')->withToastError('Pengajuan telah di Tolak oleh Administrator!');
        } else {
            return redirect()->route('pengajuanulkp')->withToastError('Pengajuan Gagal!');
        }
    }

    // BPIT
    public function pengajuanbpit(Request $request)
    {
        $pengajuanbpit = Pengajuanbpit::with('user', 'user.pengajuanbpit', 'transwfbpit', 'transwfbpit.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanbpit::with('user', 'user.pengajuanbpit', 'transwfbpit', 'transwfbpit.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanbpit/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanbpit2 = Pengajuanbpit::with('user', 'user.pengajuanbpit', 'transwfbpit', 'transwfbpit.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanbpit::with('user', 'user.pengajuanbpit', 'transwfbpit', 'transwfbpit.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanbpit/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanbpit', compact('pengajuanbpit', 'pengajuanbpit2'));
    }

    public function pengajuanbpit2(Request $request)
    {
        $pengajuan2 = Pengajuanbpit::with('user', 'user.pengajuanbpit', 'transwfbpit', 'transwfbpit.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanbpit::with('user', 'user.pengajuanbpit', 'transwfbpit', 'transwfbpit.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanbpit/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanbpit', compact('pengajuanbpit2'));
    }

    public function terimapengajuanbpit($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanbpit')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;

        // $notif2 = Notifikasi::where('jenis', 'Pengajuanbpit')->where('flag', 'user')->first();
        // $jumlahnotif2 = $notif2->jumlah + 1;

        // $update = Notifikasi::where('jenis', 'Pengajuanbpit')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // $update2 = Notifikasi::where('jenis', 'Pengajuanbpit')->where('flag', 'user')->update([
        //     'jumlah' => $jumlahnotif2,
        // ]);


        $data = TransWFbpit::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Unggahan Telah diterima Administrator. Terima kasih sudah melakukan Unggah Bukti Pengambilan Ijazah dan Transkip Nilai.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFbpit::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuanbpit::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuanbpit')->withToastSuccess('Unggah Bukti Pengambilan Ijazah dan Transkip Nilai telah Disetujui');
        } else {
            return redirect()->route('pengajuanbpit')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuanbpit($id)
    {
        // $notif = Notifikasi::where('jenis', 'Pengajuanbpit')->where('flag', 'administrator')->first();
        // $jumlahnotif = $notif->jumlah - 1;



        // $update = Notifikasi::where('jenis', 'Pengajuanbpit')->where('flag', 'administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);



        $data = TransWFbpit::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Unggah Bukti Pengambilan Ijazah dan Transkip Nilai di Tolak Administrator. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFbpit::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuanbpit::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanbpit')->withToastError('Pengajuan telah di Tolak oleh Administrator!');
        } else {
            return redirect()->route('pengajuanbpit')->withToastError('Pengajuan Gagal!');
        }
    }


    // LEGALISASI
    public function legalisasi(Request $request)
    {
        $legalisasi = Legalisasi::with('user', 'user.legalisasai', 'transwflegalisasi', 'transwflegalisasi.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();

        if ($request->ajax()) {
            $data = Legalisasi::with('user', 'user.legalisasai', 'transwflegalisasi', 'transwflegalisasi.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/legalisasai/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $legalisasi2 = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/legalisasi/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $legalisasi3 = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/legalisasi/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/legalisasi', compact('legalisasi', 'legalisasi2', 'legalisasi3'));
    }

    public function legalisasi2(Request $request)
    {
        $pengajuan3 = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/legalisasi/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/legalisasi', compact('legalisasi2'));
    }

    public function legalisasi3(Request $request)
    {
        $pengajuan2 = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/legalisasi/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/legalisasi', compact('legalisasi3'));
    }

    public function terimalegalisasi($id)
    {
       

        $data = TransWFlegalisasi::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Legalisasi Dokumen Telah diterima dan akan diproses.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFlegalisasi::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Legalisasi::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('legalisasi')->withToastSuccess('Pengajuan Legalisasi Dokumen telah Disetujui');
        } else {
            return redirect()->route('legalisasi')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolaklegalisasi($id)
    {
       

        $data = TransWFlegalisasi::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Legalisasi Dokumen ditolak. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFlegalisasi::where('id', $id)->update([
            'wfreference' => "4",
            "history" => $array,
        ]);
        $update3 = Legalisasi::where('id', $id)->update([
            'current_wp' => "4",
        ]);
        if ($update3) {
            return redirect()->route('legalisasi')->withToastError('Pengajuan telah di Tolak!');
        } else {
            return redirect()->route('legalisasi')->withToastError('Pengajuan Gagal!');
        }
    }

    public function proseslegalisasi($id)
    {
        
        $data = TransWFlegalisasi::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan Legalisasi Dokumen Telah Selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT untuk mengambil hasil Legalisai Dokumen.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFlegalisasi::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update4 = Legalisasi::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update4) {
            return redirect()->route('legalisasi')->withToastSuccess('Pengajuan Legalisasi Dokumen telah Selesai dibuat');
        } else {
            return redirect()->route('legalisasi')->withToastError('Pengajuan Gagal!');
        }
    }




    // PSKTA
    public function pengajuanpskta(Request $request)
    {
        $pengajuanpskta = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
            ->where('current_wp', '!=', '2')
            ->Where('current_wp', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
                ->where('current_wp', '!=', '2')
                ->Where('current_wp', '1')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanpskta2 = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
            ->where('current_wp', '!=', '1')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Lanjutan</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $pengajuanpskta3 = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
            ->where('current_wp', '!=', '2')
            ->get();

        if ($request->ajax()) {
            $data = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Lanjutan</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpskta', compact('pengajuanpskta', 'pengajuanpskta2', 'pengajuanpskta3'));
    }

    public function pengajuanpskta2(Request $request)
    {
        $pengajuan2 = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
            ->where('current_wp', '!=', '1')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
                ->where('current_wp', '!=', '1')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '2') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Verifikasi Ulang</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpskta', compact('pengajuanpskta2'));
    }

    public function pengajuanpskta3(Request $request)
    {
        $pengajuan3 = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
            ->where('current_wp', '!=', '2')
            ->get();
        if ($request->ajax()) {
            $data = Pengajuanpskta::with('user', 'user.pengajuanpskta', 'transwfpskta', 'transwfpskta.wfr')
                ->where('current_wp', '!=', '2')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->current_wp == '3') {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
                        // $btn = $btn . '   <a href="/administrator/pengajuanpskta/' . $row->id . '/generate-pdf" class="btn btn-sm btn-core" role="button" >Download</a>';
                        return $btn;
                    } else {
                        $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail Pengajuan</a>';
                        return $btn;
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return response()->json(['data' => $pengajuan]);
        return view('administrator/pengajuanpskta', compact('pengajuanpskta2'));
    }

    public function terimapengajuanpskta($id)
    {
      
        $data = TransWFpskta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan SK TA Telah diterima dan akan diproses.";
        $array[] =  $date;
        $history = json_encode($array);
        $update3 = TransWFpskta::where('id', $id)->update([
            'wfreference' => "2",
            "history" => $array,
        ]);
        $update4 = Pengajuanpskta::where('id', $id)->update([
            'current_wp' => "2",
        ]);
        if ($update4) {
            return redirect()->route('pengajuanpskta')->withToastSuccess('Pengajuan SK TA telah Disetujui');
        } else {
            return redirect()->route('pengajuanpskta')->withToastError('Pengajuan Gagal!');
        }
    }

    public function tolakpengajuanpskta($id)
    {

        $data = TransWFpskta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan SK TA ditolak. Ada file yang tidak valid!";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFpskta::where('id', $id)->update([
            'wfreference' => "4",
            "history" => $array,
        ]);
        $update3 = Pengajuanpskta::where('id', $id)->update([
            'current_wp' => "4",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanpskta')->withToastError('Pengajuan telah di Tolak!');
        } else {
            return redirect()->route('pengajuanpskta')->withToastError('Pengajuan Gagal!');
        }
    }

    public function prosespengajuanpskta($id)
    {

        $data = TransWFpskta::where('id', $id)->get();
        foreach ($data as $item)
            $array = json_decode($item->history);

        $date = date('d/m/Y  G:i:s');
        $array[] =  "Pengajuan SK TA telah Selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan untuk mengambil hasil Pengajuan.";
        $array[] =  $date;
        $history = json_encode($array);
        $update2 = TransWFpskta::where('id', $id)->update([
            'wfreference' => "3",
            "history" => $array,
        ]);
        $update3 = Pengajuanpskta::where('id', $id)->update([
            'current_wp' => "3",
        ]);
        if ($update3) {
            return redirect()->route('pengajuanpskta')->withToastSuccess('Pengajuan SK TA telah Selesai dibuat.');
        } else {
            return redirect()->route('pengajuanpskta')->withToastError('Pengajuan Gagal!');
        }
    }






    // Kelola User
    public function user(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            $data = User::orderBy('created_at', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="#" class="btn btn-sm btn-warning" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '"><i class="bi bi-search"></i></a>';

                    $btn = $btn . ' <a href="/administrator/user/' . $row->id . '/delete" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger deleteUser" role="button" aria-pressed="true"> <i class="bi bi-trash3-fill"></i></a> ';

             

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
 
         return view('administrator.user', compact('users'));
     }

    //  protected function validator(array $data)
    //  {
    //      return Validator::make($data, [
    //          'name' => ['required', 'string', 'max:255'],
    //          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //          'password' => ['required', 'string', 'min:8', 'confirmed'],
    //      ]);
    //  }
 
    //  /**
    //   * Create a new user instance after a valid registration.
    //   *
    //   * @param  array  $data
    //   * @return \App\Models\User
    //   */
    //  protected function create(array $data)
    //  {
    //      return User::create([
    //          'name' => $data['name'],
    //          'email' => $data['email'],
    //          'password' => Hash::make($data['password']),
    //      ]);
    //  }

    public function tambahuser(Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,png|max:2048',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => 'required',

        ]);
        
        $extension = $request->photo->extension();

        $request->photo->storeAs('/public/img', $request->name . "." . $extension);

        $url = Storage::url($request->name . "." . $extension);

        $user = new User();

        $user->photo = $request->name . "." . $extension;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->type = $request->type;
        $user->created_at = now();
        // $user->created_by = $request->created_by;
        $user->save();

        return redirect()->route('daftar_user')->withToastSuccess('user baru berhasil ditambahkan!');
    }




    public function deleteuserrr($id)
    {
        User::find($id)->delete();
        return redirect()->route('daftar_user')->withToastSuccess('user telah dihapus!');
        
    }

    public function tampiluser()
    {
        $userr = User::orderBy('created_at', 'desc')->take(6)->get();
        return view('user', compact('userr'));
    }
}