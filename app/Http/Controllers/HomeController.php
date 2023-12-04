<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Legalisasi;
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
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('mahasiswa.beranda');
        $berita = Berita::orderBy('id', 'desc')->take(3)->get();
        $notif = Notifikasi::where('flag', 'User')->get();
        return view('mahasiswa/beranda', compact('berita', 'notif'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        $berita = Berita::orderBy('id', 'desc')->take(3)->get();
        $users = User::orderBy('id', 'desc')->get();
        $beritaberanda = Berita::orderBy('id', 'desc')->get();
        $pengajuanspta = Pengajuanspta::count();
        $pengajuansemta = Pengajuansemta::count();
        $pengajuansta = Pengajuansta::count();
        $pengajuanskp = Pengajuanskp::count();
        $pengajuanpskkpp = Pengajuanpskkp::count();
        $pengajuanpskta = Pengajuanpskta::count();
        $pengajuanpptakp = Pengajuanpptakp::count();
        $pengajuanulta = Pengajuanulta::count();
        $pengajuanulkp = Pengajuanulkp::count();
        $pengajuanbpit = Pengajuanbpit::count();
        $legalisasi = Legalisasi::count();
        $userr = User::count();
        return view('admin/beranda', compact(
            'berita', 
            'beritaberanda',
            'users',
            'pengajuanspta',
            'pengajuansemta',
            'pengajuansta',
            'pengajuanskp',
            'pengajuanpskkpp',
            'pengajuanpptakp',
            'pengajuanulta',
            'pengajuanulkp',
            'pengajuanbpit',
            'legalisasi',
            'userr',
            'pengajuanpskta'
            
        ));
        // return view('admin.beranda');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function administrator()
    {
        // return view('administrator.beranda');
        $berita = Berita::orderBy('id', 'desc')->take(3)->get();
        $users = User::orderBy('id', 'desc')->get();
        $notif = Notifikasi::where('flag', 'Administrator')->get();
        $pengajuanspta = Pengajuanspta::count();
        $pengajuansemta = Pengajuansemta::count();
        $pengajuansta = Pengajuansta::count();
        $pengajuanskp = Pengajuanskp::count();
        $pengajuanppskkp = Pengajuanpskkp::count();
        $pengajuanpskta = Pengajuanpskta::count();
        $pengajuanpptakp = Pengajuanpptakp::count();
        $pengajuanulta = Pengajuanulta::count();
        $pengajuanulkp = Pengajuanulkp::count();
        $pengajuanbpit = Pengajuanbpit::count();
        $legalisasi = Legalisasi::count();
        $user = User::count();
        return view('administrator/beranda', compact(
            'berita',
            'users',
            'notif',
            'pengajuanspta',
            'pengajuansemta',
            'pengajuansta',
            'pengajuanskp',
            'pengajuanppskkp',
            'pengajuanpptakp',
            'pengajuanulta',
            'pengajuanulkp',
            'pengajuanbpit',
            'legalisasi',
            'user',
            'pengajuanpskta'
        ));
    }

    public function administrator2()
    {
        // return view('administrator.beranda');
        $berita = Berita::orderBy('id', 'desc')->take(3)->get();
        return view('administrator/info', compact('berita'));
    }
}
