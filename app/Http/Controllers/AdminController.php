<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Pengajuanpskta;
use App\Models\TransWFpskta;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Legalisasi;
use App\Models\Pengajuanbpit;
use App\Models\Pengajuanpptakp;
use App\Models\Pengajuanpskkp;
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
use App\Models\TransWFsemta;
use App\Models\TransWFskp;
use App\Models\TransWFsta;
use App\Models\TransWFulkp;
use App\Models\TransWFulta;



class AdminController extends Controller
{
    public function informasi(Request $request)
    {
        $beritaberanda = Berita::orderBy('tanggal_post', 'desc')->get();

        if ($request->ajax()) {
            $data = Berita::orderBy('tanggal_post', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="#" class="btn btn-sm btn-warning" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '"><i class="bi bi-search"></i></a>';

                    $btn = $btn . ' <a href="/admin/beranda/' . $row->id . '/delete" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger deleteUser" role="button" aria-pressed="true"> <i class="bi bi-trash3-fill"></i></a> ';

             

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
 
         return view('admin.beranda', compact('beritaberanda'));
     }

    public function tambahinformasi(Request $request)
    {
        $this->validate($request, [
            'gambar' => 'required|mimes:jpeg,png|max:2048',
            'judul_berita' => 'required',
            'detail_berita' => 'required',

        ]);
        
        $extension = $request->gambar->extension();

        $request->gambar->storeAs('/public/img', $request->judul_berita . "." . $extension);

        $url = Storage::url($request->judul_berita . "." . $extension);

        $berita = new Berita();

        $berita->gambar = $request->judul_berita . "." . $extension;
        $berita->judul_berita = $request->judul_berita;
        $berita->detail_berita = $request->detail_berita;
        $berita->tanggal_post = now();
        $berita->created_by = $request->created_by;
        // $berita->created_by = $request->created_by;
        $berita->save();

        return redirect()->route('admin.beranda')->withToastSuccess('Informasi baru berhasil ditambahkan!');
    }




    public function deleteinformasi($id)
    {
        Berita::find($id)->delete();
        return redirect()->route('admin.beranda')->withToastSuccess('Informasi telah dihapus!');
        
    }

    public function tampilinformasi()
    {
        $berita = Berita::orderBy('tanggal_post', 'desc')->take(6)->get();
        return view('informasi', compact('berita'));
    }

    public function updateinformasi(){

    }



    
    //Profile Update
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('admin.profileadmin', compact('user'));
    }

    public function update(Request $request, $id)
    {
    request()->validate([
        'name'       => 'required|string|min:2|max:100',
        'email'      => 'required|email|unique:users,email, ' . $id . ',id',
        'old_password' => 'nullable|string',
        'password' => 'nullable|required_with:old_password|string|confirmed|min:6'
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
        if($user->photo && file_exists(storage_path('app/public/photos/' . $user->photo))){
            Storage::delete('app/public/photos/'.$user->photo);
        }

        $file = $request->file('photo');
        $fileName = $file->hashName() . '.' . $file->getClientOriginalExtension();
        $request->photo->move(storage_path('app/public/photos'), $fileName);
        $user->photo = $fileName;
    }


    $user->save();

    // return back()->withToast('status', 'Profile updated!');
    return redirect()->route('profileadmin.index')->withToastSuccess('Profile update berhasil!');
    }

    // public function beranda()
    // {
    //     return view('admin.beranda');
    // }

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    //SPTA
    public function pengajuansptaa(Request $request)
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
            return view('admin/pengajuanspta', compact('spta', 'spta2', 'spta3'));
        }
    
        public function pengajuansptaa2(Request $request)
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
            return view('admin/pengajuanspta', compact('spta2'));
        }

        public function pengajuansptaa3(Request $request)
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
            return view('admin/pengajuanspta', compact('spta3'));
        }
    
        public function terimapengajuansptaa($id)
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
            $array[] =  "Pengajuan Sidang Proposal TA Telah diterima dan akan diproses.";
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
                return redirect()->route('pengajuansptaa')->withToastSuccess('Pengajuan Sidang Proposal TA telah Disetujui');
            } else {
                return redirect()->route('pengajuansptaa')->withToastError('Pengajuan Sidang Proposal TA Ditolak');
            }
        }
    
        public function tolakpengajuansptaa($id)
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
                return redirect()->route('pengajuansptaa')->withToastError('Pengajuan telah di Tolak!');
            } else {
                return redirect()->route('pengajuansptaa')->withToastError('Pengajuan Gagal!');
            }
        }

        public function prosespengajuansptaa($id)
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
            $array[] =  "Pengajuan Sidang Proposal TA Telah Selesai Dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan pada hari H untuk mengambil Berita Acara (BA) yang diajukan.";
            $array[] =  $date;
            $history = json_encode($array);
            $update3 = TransWF::where('id', $id)->update([
                'wfreference' => "3",
                "history" => $array,
            ]);
            $update4 = Pengajuanspta::where('id', $id)->update([
                'current_wp' => "3",
            ]);
            if ($update4) {
                return redirect()->route('pengajuansptaa')->withToastSuccess('Pengajuan Sidang Proposal TA telah Selesai Dibuat');
            } else {
                return redirect()->route('pengajuansptaa')->withToastError('Pengajuan Sidang Proposal TA Ditolak');
            }
        }
    
    
        //SEMTA
        public function pengajuansemtaa(Request $request)
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
            // return response()->json(['data' => $pengajuan]);
            return view('admin/pengajuansemta', compact('pengajuansemta', 'pengajuansemta2', 'pengajuansemta3'));
        }
    
        public function pengajuansemtaa2(Request $request)
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
            return view('admin/pengajuansemta', compact('pengajuansemta2'));
        }

        public function pengajuansemtaa3(Request $request)
        {
            $pengajuan3 = Pengajuansemta::with('user', 'user.pengajuansemta', 'transwfsemta', 'transwfsemta.wfr')
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
            return view('admin/pengajuansemta', compact('pengajuansemta3'));
        }
    
        public function terimapengajuansemtaa($id)
        {
    
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
                return redirect()->route('pengajuansemtaa')->withToastSuccess('Pengajuan Seminar TA telah Disetujui');
            } else {
                return redirect()->route('pengajuansemtaa')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuansemtaa($id)
        {
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
                return redirect()->route('pengajuansemtaa')->withToastError('Pengajuan telah di Tolak!');
            } else {
                return redirect()->route('pengajuansemtaa')->withToastError('Pengajuan Gagal!');
            }
        }

        public function prosespengajuansemtaa($id)
        {
    
            $data = TransWFsemta::where('id', $id)->get();
            foreach ($data as $item)
                $array = json_decode($item->history);
    
            $date = date('d/m/Y  G:i:s');
            $array[] =  "Pengajuan Seminar TA Telah selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT pada hari H untuk mengambil Berita Acara (BA) yang diajukan.";
            $array[] =  $date;
            $history = json_encode($array);
            $update3 = TransWFsemta::where('id', $id)->update([
                'wfreference' => "3",
                "history" => $array,
            ]);
            $update4 = Pengajuansemta::where('id', $id)->update([
                'current_wp' => "3",
            ]);
            if ($update4) {
                return redirect()->route('pengajuansemtaa')->withToastSuccess('Pengajuan Seminar TA telah Selesai Dibuat');
            } else {
                return redirect()->route('pengajuansemtaa')->withToastError('Pengajuan Gagal!');
            }
        }
    
    
        //STA
        public function pengajuanstaa(Request $request)
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
            return view('admin/pengajuansta', compact('pengajuansta', 'pengajuansta2', 'pengajuansta3'));
        }
    
        public function pengajuanstaa2(Request $request)
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
            return view('admin/pengajuansta', compact('pengajuansta2'));
        }

        public function pengajuanstaa3(Request $request)
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
            return view('admin/pengajuansta', compact('pengajuansta3'));
        }
    
        public function terimapengajuanstaa($id)
        {
    
            $data = TransWFsta::where('id', $id)->get();
            foreach ($data as $item)
                $array = json_decode($item->history);
    
            $date = date('d/m/Y  G:i:s');
            $array[] =  "Pengajuan Sidang TA Telah diterima dan akan diproses.";
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
                return redirect()->route('pengajuanstaa')->withToastSuccess('Pengajuan Sidang TA telah Disetujui');
            } else {
                return redirect()->route('pengajuanstaa')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuanstaa($id)
        {
    
    
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
                return redirect()->route('pengajuanstaa')->withToastError('Pengajuan telah di Tolak!');
            } else {
                return redirect()->route('pengajuanstaa')->withToastError('Pengajuan Gagal!');
            }
        }

        public function prosespengajuanstaa($id)
        {
    
            $data = TransWFsta::where('id', $id)->get();
            foreach ($data as $item)
                $array = json_decode($item->history);
    
            $date = date('d/m/Y  G:i:s');
            $array[] =  "Pengajuan Sidang TA Telah Selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT pada hari H untuk mengambil Berita Acara (BA) yang diajukan.";
            $array[] =  $date;
            $history = json_encode($array);
            $update3 = TransWFsta::where('id', $id)->update([
                'wfreference' => "4",
                "history" => $array,
            ]);
            $update4 = Pengajuansta::where('id', $id)->update([
                'current_wp' => "4",
            ]);
            if ($update4) {
                return redirect()->route('pengajuanstaa')->withToastSuccess('Pengajuan Sidang TA telah Selesai Dibuat');
            } else {
                return redirect()->route('pengajuanstaa')->withToastError('Pengajuan Gagal!');
            }
        }
    
    
        // SKP
        public function pengajuanskpp(Request $request)
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
            return view('admin/pengajuanskp', compact('pengajuanskp', 'pengajuanskp2', 'pengajuanskp3'));
        }
    
        public function pengajuanskpp2(Request $request)
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
            return view('admin/pengajuanskp', compact('pengajuanskp2'));
        }

        public function pengajuanskpp3(Request $request)
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
            return view('admin/pengajuanskp', compact('pengajuanskp3'));
        }
    
        public function terimapengajuanskpp($id)
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
                return redirect()->route('pengajuanskpp')->withToastSuccess('Pengajuan Sidang KP telah Disetujui');
            } else {
                return redirect()->route('pengajuanskpp')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuanskpp($id)
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
                return redirect()->route('pengajuanskpp')->withToastError('Pengajuan telah di Tolak!');
            } else {
                return redirect()->route('pengajuanskpp')->withToastError('Pengajuan Gagal!');
            }
        }

        public function prosespengajuanskpp($id)
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
            $array[] =  "Pengajuan Sidang KP Telah selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan pada Hari H sidang untuk mengambil Berita Acara (BA) yang diajukan.";
            $array[] =  $date;
            $history = json_encode($array);
            $update3 = TransWFskp::where('id', $id)->update([
                'wfreference' => "3",
                "history" => $array,
            ]);
            $update4 = Pengajuanskp::where('id', $id)->update([
                'current_wp' => "3",
            ]);
            if ($update4) {
                return redirect()->route('pengajuanskpp')->withToastSuccess('Pengajuan Sidang KP telah Disetujui');
            } else {
                return redirect()->route('pengajuanskpp')->withToastError('Pengajuan Gagal!');
            }
        }
    
    
        // PSKKP
        public function pengajuanpskkpp(Request $request)
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
            return view('admin/pengajuanpskkp', compact('pengajuanpskkp', 'pengajuanpskkp2', 'pengajuanpskkp3'));
        }
    
        public function pengajuanpskkpp2(Request $request)
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
            return view('admin/pengajuanpskkp', compact('pengajuanpskkp2'));
        }

        public function pengajuanpskkpp3(Request $request)
        {
            $pengajuan2 = Pengajuanpskkp::with('user', 'user.pengajuanpskkp', 'transwfpskkp', 'transwfpskkp.wfr')
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
            return view('admin/pengajuanpskkp', compact('pengajuanpskkp3'));
        }
    
    
        public function terimapengajuanpskkpp($id)
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
                return redirect()->route('pengajuanpskkpp')->withToastSuccess('Pengajuan SK KP telah Disetujui');
            } else {
                return redirect()->route('pengajuanpskkpp')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuanpskkpp($id)
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
                return redirect()->route('pengajuanpskkpp')->withToastError('Pengajuan telah di Tolak!');
            } else {
                return redirect()->route('pengajuanpskkpp')->withToastError('Pengajuan Gagal!');
            }
        }

        public function prosespengajuanpskkpp($id)
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
            $array[] =  "Pengajuan SK KP Telah selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan untuk mengambil surat yang diajukan.";
            $array[] =  $date;
            $history = json_encode($array);
            $update3 = TransWFpskkp::where('id', $id)->update([
                'wfreference' => "3",
                "history" => $array,
            ]);
            $update4 = Pengajuanpskkp::where('id', $id)->update([
                'current_wp' => "3",
            ]);
            if ($update4) {
                return redirect()->route('pengajuanpskkpp')->withToastSuccess('Pengajuan SK KP telah Selesai Dibuat');
            } else {
                return redirect()->route('pengajuanpskkpp')->withToastError('Pengajuan Gagal!');
            }
        }
    
    
        // PPTAKP
        public function pengajuanpptakpp(Request $request)
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
            return view('admin/pengajuanpptakp', compact('pengajuanpptakp', 'pengajuanpptakp2', 'pengajuanpptakp3'));
        }
    
        public function pengajuanpptakpp2(Request $request)
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
            return view('admin/pengajuanpptakp', compact('pengajuanpptakp2'));
        }

        public function pengajuanpptakpp3(Request $request)
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
            return view('admin/pengajuanpptakp', compact('pengajuanpptakp3'));
        }
    
        public function terimapengajuanpptakpp($id)
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
                return redirect()->route('pengajuanpptakpp')->withToastSuccess('Pengajuan Perpanjangan TA dan KP telah Disetujui');
            } else {
                return redirect()->route('pengajuanpptakpp')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuanpptakpp($id)
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
                return redirect()->route('pengajuanpptakpp')->withToastError('Pengajuan telah di Tolak!');
            } else {
                return redirect()->route('pengajuanpptakpp')->withToastError('Pengajuan Gagal!');
            }
        }
        
        public function prosespengajuanpptakpp($id)
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
            $array[] =  "Pengajuan Perpanjangan TA atau KP Telah selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan untuk mengambil surat yang diajukan.";
            $array[] =  $date;
            $history = json_encode($array);
            $update3 = TransWFpptakp::where('id', $id)->update([
                'wfreference' => "3",
                "history" => $array,
            ]);
            $update4 = Pengajuanpptakp::where('id', $id)->update([
                'current_wp' => "3",
            ]);
            if ($update4) {
                return redirect()->route('pengajuanpptakpp')->withToastSuccess('Pengajuan Perpanjangan TA dan KP telah selesai dibuat');
            } else {
                return redirect()->route('pengajuanpptakpp')->withToastError('Pengajuan Gagal!');
            }
        }
    
        // ULTA
        public function pengajuanultaa(Request $request)
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
            return view('admin/pengajuanulta', compact('pengajuanulta', 'pengajuanulta2'));
        }
    
        public function pengajuanultaa2(Request $request)
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
            return view('admin/pengajuanulta', compact('pengajuanulta2'));
        }
    
        public function terimapengajuanultaa($id)
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
            $array[] =  "Unggah Laporan TA Telah diterima. Terima kasih sudah mengunggah Laporan TA.";
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
                return redirect()->route('pengajuanultaa')->withToastSuccess('Unggah Laporan TA telah Disetujui');
            } else {
                return redirect()->route('pengajuanultaa')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuanultaa($id)
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
                return redirect()->route('pengajuanultaa')->withToastError('Pengajuan telah di Tolak oleh Administrator!');
            } else {
                return redirect()->route('pengajuanultaa')->withToastError('Pengajuan Gagal!');
            }
        }
    
        // ULKP
        public function pengajuanulkpp(Request $request)
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
            return view('admin/pengajuanulkp', compact('pengajuanulkp', 'pengajuanulkp2'));
        }
    
        public function pengajuanulkpp2(Request $request)
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
            return view('admin/pengajuanulkp', compact('pengajuanulkp2'));
        }
    
        public function terimapengajuanulkpp($id)
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
            $array[] =  "Unggah Laporan KP Telah diterima. Terima kasih sudah mengunggah Laporan KP.";
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
                return redirect()->route('pengajuanulkpp')->withToastSuccess('Unggah Laporan KP telah Disetujui');
            } else {
                return redirect()->route('pengajuanulkpp')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuanulkpp($id)
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
                return redirect()->route('pengajuanulkpp')->withToastError('Pengajuan telah di Tolak oleh Administrator!');
            } else {
                return redirect()->route('pengajuanulkpp')->withToastError('Pengajuan Gagal!');
            }
        }
    
        // BPIT
        public function pengajuanbpitt(Request $request)
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
            return view('admin/pengajuanbpit', compact('pengajuanbpit', 'pengajuanbpit2'));
        }
    
        public function pengajuanbpitt2(Request $request)
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
            return view('admin/pengajuanbpit', compact('pengajuanbpit2'));
        }
    
        public function terimapengajuanbpitt($id)
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
            $array[] =  "Unggahan Telah diterima. Terima kasih sudah melakukan Unggah Bukti Pengambilan Ijazah dan Transkip Nilai.";
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
                return redirect()->route('pengajuanbpitt')->withToastSuccess('Unggah Bukti Pengambilan Ijazah dan Transkip Nilai telah Disetujui');
            } else {
                return redirect()->route('pengajuanbpitt')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuanbpitt($id)
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
                return redirect()->route('pengajuanbpitt')->withToastError('Pengajuan telah di Tolak oleh Administrator!');
            } else {
                return redirect()->route('pengajuanbpitt')->withToastError('Pengajuan Gagal!');
            }
        }
    
    
        // LEGALISASI
        public function legalisasii(Request $request)
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
                            $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal-' . $row->id . '">Detail</a>';
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
            return view('admin/legalisasi', compact('legalisasi', 'legalisasi2', 'legalisasi3'));
        }
    
        public function legalisasii2(Request $request)
        {
            $pengajuan2 = Legalisasi::with('user', 'user.legalisasi', 'transwflegalisasi', 'transwflegalisasi.wfr')
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
            return view('admin/legalisasi', compact('legalisasi2'));
        }

        public function legalisasii3(Request $request)
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
            return view('admin/legalisasi', compact('legalisasi3'));
        }
    
        public function terimalegalisasii($id)
        {
            // $notif = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'administrator')->first();
            // $jumlahnotif = $notif->jumlah - 1;
    
            // $notif2 = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'user')->first();
            // $jumlahnotif2 = $notif2->jumlah + 1;
    
            // $update = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'administrator')->update([
            //     'jumlah' => $jumlahnotif,
            // ]);
    
            // $update2 = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'user')->update([
            //     'jumlah' => $jumlahnotif2,
            // ]);
    
    
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
                return redirect()->route('legalisasii')->withToastSuccess('Pengajuan Legalisasi Dokumen telah Disetujui');
            } else {
                return redirect()->route('legalisasii')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolaklegalisasii($id)
        {
            // $notif = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'administrator')->first();
            // $jumlahnotif = $notif->jumlah - 1;
    
    
    
            // $update = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'administrator')->update([
            //     'jumlah' => $jumlahnotif,
            // ]);
    
    
    
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
                return redirect()->route('legalisasii')->withToastError('Pengajuan telah di Tolak!');
            } else {
                return redirect()->route('legalisasii')->withToastError('Pengajuan Gagal!');
            }
        }

        public function proseslegalisasii($id)
        {
            // $notif = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'administrator')->first();
            // $jumlahnotif = $notif->jumlah - 1;
    
            // $notif2 = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'user')->first();
            // $jumlahnotif2 = $notif2->jumlah + 1;
    
            // $update = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'administrator')->update([
            //     'jumlah' => $jumlahnotif,
            // ]);
    
            // $update2 = Notifikasi::where('jenis', 'legalisasi')->where('flag', 'user')->update([
            //     'jumlah' => $jumlahnotif2,
            // ]);
    
    
            $data = TransWFlegalisasi::where('id', $id)->get();
            foreach ($data as $item)
                $array = json_decode($item->history);
    
            $date = date('d/m/Y  G:i:s');
            $array[] =  "Pengajuan Legalisasi Dokumen Telah selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT untuk mengambil surat yang diajukan.";
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
                return redirect()->route('legalisasii')->withToastSuccess('Pengajuan Legalisasi Dokumen telah Selesai Dibuat');
            } else {
                return redirect()->route('legalisasii')->withToastError('Pengajuan Gagal!');
            }
        }
    
    
    
    
        // PSKTA
        public function pengajuanpsktaa(Request $request)
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
            return view('admin/pengajuanpskta', compact('pengajuanpskta', 'pengajuanpskta2', 'pengajuanpskta3'));
        }
    
        public function pengajuanpsktaa2(Request $request)
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
                            $btn = '  <a href="#" class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal" data-target="#Modal-' . $row->id . '">Detail</a>';
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
            return view('admin/pengajuanpskta', compact('pengajuanpskta2'));
        }
    
        public function pengajuanpsktaa3(Request $request)
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
            return view('admin/pengajuanpskta', compact('pengajuanpskta3'));
        }
    
        public function terimapengajuanpsktaa($id)
        {
            // $notif = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'administrator')->first();
            // $jumlahnotif = $notif->jumlah - 1;
    
            // $notif2 = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'user')->first();
            // $jumlahnotif2 = $notif2->jumlah + 1;
    
            // $update = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'administrator')->update([
            //     'jumlah' => $jumlahnotif,
            // ]);
    
            // $update2 = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'user')->update([
            //     'jumlah' => $jumlahnotif2,
            // ]);
    
    
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
                return redirect()->route('pengajuanpsktaa')->withToastSuccess('Pengajuan SK TA telah Disetujui');
            } else {
                return redirect()->route('pengajuanpsktaa')->withToastError('Pengajuan Gagal!');
            }
        }
    
        public function tolakpengajuanpsktaa($id)
        {
            // $notif = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'administrator')->first();
            // $jumlahnotif = $notif->jumlah - 1;
    
    
    
            // $update = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'administrator')->update([
            //     'jumlah' => $jumlahnotif,
            // ]);
    
    
    
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
                return redirect()->route('pengajuanpsktaa')->withToastError('Pengajuan telah di Tolak!');
            } else {
                return redirect()->route('pengajuanpsktaa')->withToastError('Pengajuan Gagal!');
            }
        }
        
    
        public function prosespengajuanpsktaa($id)
        {
            // $notif = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'administrator')->first();
            // $jumlahnotif = $notif->jumlah - 1;
    
            // $notif2 = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'user')->first();
            // $jumlahnotif2 = $notif2->jumlah + 1;
    
            // $update = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'administrator')->update([
            //     'jumlah' => $jumlahnotif,
            // ]);
    
            // $update2 = Notifikasi::where('jenis', 'Pengajuanpskta')->where('flag', 'user')->update([
            //     'jumlah' => $jumlahnotif2,
            // ]);
    
    
            $data = TransWFpskta::where('id', $id)->get();
            foreach ($data as $item)
                $array = json_decode($item->history);
    
            $date = date('d/m/Y  G:i:s');
            $array[] =  "Pengajuan SK TA Telah selesai dibuat. Silahkan mengunjungi Ruang Pelayanan FT atau Jurusan untuk mengambil surat yang diajukan.";
            $array[] =  $date;
            $history = json_encode($array);
            $update3 = TransWFpskta::where('id', $id)->update([
                'wfreference' => "3",
                "history" => $array,
            ]);
            $update4 = Pengajuanpskta::where('id', $id)->update([
                'current_wp' => "3",
            ]);
            if ($update4) {
                return redirect()->route('pengajuanpsktaa')->withToastSuccess('Pengajuan SK TA telah Selesai Dibuat');
            } else {
                return redirect()->route('pengajuanpsktaa')->withToastError('Pengajuan Gagal!');
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
    
                        $btn = $btn . ' <a href="/admin/user/' . $row->id . '/delete" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-sm btn-danger deleteUser" role="button" aria-pressed="true"> <i class="bi bi-trash3-fill"></i></a> ';
    
                 
    
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
     
             return view('admin.user', compact('users'));
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
    
            return redirect()->route('daftar_userr')->withToastSuccess('user baru berhasil ditambahkan!');
        }
    
    
        public function deleteuserrr($id)
        {
            User::find($id)->delete();
            return redirect()->route('daftar_userr')->withToastSuccess('user telah dihapus!');
            
        }
    
        public function tampiluser()
        {
            $userr = User::orderBy('created_at', 'desc')->take(6)->get();
            return view('user', compact('userr'));
        }
}