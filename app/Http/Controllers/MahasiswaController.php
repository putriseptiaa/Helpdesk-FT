<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleDriveHelper;
use App\Models\Legalisasi;
use App\Models\Notifikasi;
use App\Models\Pengajuanbpit;
use App\Models\Pengajuanpptakp;
use App\Models\Pengajuanpskkp;
use App\Models\Pengajuanpskta;
use App\Models\Pengajuanspta;
use App\Models\Pengajuansemta;
use App\Models\Pengajuanskp;
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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Config;

class MahasiswaController extends Controller
{
    /**
     * Show the update profile page.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pengajuanspta()
    {
        // return view('mahasiswa.pengajuanspta');
        $data = Pengajuanspta::where('user_id', auth()->id())->with('user', 'transwf', 'transwf.wfr')->get();
        // dd($data);
        return view('mahasiswa/pengajuanspta', compact('data'));
    }

    public function pengajuansptastore(Request $request)
    {
        $datas = Pengajuanspta::with('user', 'transwf', 'transwf.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nama' => 'required|max:255',
                'nohp' => 'required|max:13',
                'nim' => 'required|max:9',
                'jurusan' => 'required',
                'jenis_surat' => 'required',
                'tgl_pengajuan' => 'required',
                'nm_pembimbing1' => 'required|max:255',
                'nm_pembimbing2' => 'required|max:255',
                'judul_prota' => 'required|string|max:255',
                // 'berkas_penelitian' => 'required',
                // 'transkip' => 'required',
                // 'bukti_lapkp'=> 'required',
                // 'up_ombus'=> 'required',
                // 'up_pbn' => 'required'
            ]);

        $id = $request->nim;
        if ($request->berkas_penelitian) {
            $lastName = 'berkas_penelitian';
            $dirSave = 'spta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->berkas_penelitian);
            $extension1 = $request->berkas_penelitian->extension();
            // $extension1 = $request->berkas_penelitian->extension();

            // $request->berkas_penelitian->storeAs('/public/spta', $id . " berkas_penelitian." . $extension1);

            // $url1 = Storage::url($id . " berkas_penelitian." . $extension1);
        }
        if ($request->transkip) {
            $lastName = 'transkip';
            $dirSave = 'spta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->transkip);
            $extension2 = $request->transkip->extension();

            // $request->transkip->storeAs('/public/spta', $id . " transkip." . $extension2);

            // $url2 = Storage::url($id . " transkip." . $extension2);
        }
        if ($request->bukti_lapkp) {
            $lastName = 'bukti_lapkp';
            $dirSave = 'spta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->bukti_lapkp);
            $extension3 = $request->bukti_lapkp->extension();

            // $request->bukti_lapkp->storeAs('/public/spta', $id . " bukti_lapkp." . $extension3);

            // $url3 = Storage::url($id . " bukti_lapkp." . $extension3);
        }
        if ($request->up_ombus) {
            $lastName = 'up_ombus';
            $dirSave = 'spta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->up_ombus);
            $extension4 = $request->up_ombus->extension();

            // $request->up_ombus->storeAs('/public/spta', $id . " up_ombus." . $extension4);

            // $url4 = Storage::url($id . " up_ombus." . $extension4);
        }
        if ($request->up_pbn) {
            $lastName = 'up_pbn';
            $dirSave = 'spta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->up_pbn);
            $extension5 = $request->up_pbn->extension();

            // $request->up_pbn->storeAs('/public/spta', $id . " up_pbn." . $extension5);

            // $url5 = Storage::url($id . " up_pbn." . $extension5);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwf = new TransWF();
        $transwf->history = $history;
        $pengajuanspta = new Pengajuanspta();
        $pengajuanspta->email = $request->email;
        $pengajuanspta->nama = $request->nama;
        $pengajuanspta->nohp = $request->nohp;
        $pengajuanspta->nim = $request->nim;
        $pengajuanspta->jurusan = $request->jurusan;
        $pengajuanspta->jenis_surat = $request->jenis_surat;
        $pengajuanspta->tgl_pengajuan = $request->tgl_pengajuan;
        $pengajuanspta->nm_pembimbing1 = $request->nm_pembimbing1;
        $pengajuanspta->nm_pembimbing2 = $request->nm_pembimbing2;
        $pengajuanspta->judul_prota = $request->judul_prota;
        if ($request->berkas_penelitian) {
            $pengajuanspta->berkas_penelitian = $id . " berkas_penelitian." . $extension1;
        }
        if ($request->transkip) {
            $pengajuanspta->transkip = $id . " transkip." . $extension2;
        }
        if ($request->bukti_lapkp) {
            $pengajuanspta->bukti_lapkp = $id . " bukti_lapkp." . $extension3;
        }
        if ($request->up_ombus) {
            $pengajuanspta->up_ombus = $id . " up_ombus." . $extension4;
        }
        if ($request->up_pbn) {
            $pengajuanspta->up_pbn = $id . " up_pbn." . $extension5;
        } else {
            $takelampiran = Pengajuanspta::where('nim', $id)->first();

            $pengajuanspta->berkas_penelitian = $takelampiran->berkas_penelitian;
            $pengajuanspta->transkip = $takelampiran->transkip;
            $pengajuanspta->bukti_lapkp = $takelampiran->bukti_lapkp;
            $pengajuanspta->up_ombus = $takelampiran->up_ombus;
            $pengajuanspta->up_pbn = $takelampiran->up_pbn;
        }
        $pengajuanspta->user_id = $request->created_by;
        $pengajuanspta->created_date = now();

        $pengajuanspta->save();
        $pengajuanspta->transwf()->save($transwf);

        // $notif = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);


        // return redirect()->route('mahasiswa.pengajuanspta')->with('success','Pengajuan sidang proposal tugas akhir berhasil dilakukan.');
        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Pengajuan proposal tugas akhir berhasil dilakukan, cek track record secara berkala!');
    }


    public function pengajuansemta()
    {
        // return view('mahasiswa.pengajuansemta');
        $data = Pengajuansemta::with('user', 'transwfsemta', 'transwfsemta.wfr')->where('user_id', auth()->id())->get();
        return view('mahasiswa/pengajuansemta', compact('data'));
    }

    public function pengajuansemtastore(Request $request)
    {
        // dd($request->all());
        $datas = Pengajuansemta::with('user', 'transwfsemta', 'transwfsemta.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'nim' => 'required',
                'jurusan' => 'required',
                'tgl_pengajuan' => 'required',
                'nm_pembimbing1' => 'required',
                'nm_pembimbing2' => 'required',
                'upper_seminar' => 'required',
                //    'for_seminar' => 'required',
                //    'upper_pembimbing1' => 'required',
                //    'upper_pembimbing2' => 'required',
                //    'sk_pembimbingta' => 'required',
                //    'lembar_pembimbingta' => 'required',
                //    'transkip' => 'required',
                //    'bukti_penyerahan_lapkp' => 'required',
            ]);


        $id = $request->nim;
        if ($request->for_seminar) {
            $lastName = 'for_seminar';
            $dirSave = 'semta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->for_seminar);
            $extension1 = $request->for_seminar->extension();

            // $request->for_seminar->storeAs('/public/semta', $id . " for_seminar." . $extension1);

            // $url1 = Storage::url($id . " for_seminar." . $extension1);
        }
        if ($request->upper_pembimbing1) {
            $lastName = 'upper_pembimbing1';
            $dirSave = 'semta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->upper_pembimbing1);
            $extension2 = $request->upper_pembimbing1->extension();

            // $request->upper_pembimbing1->storeAs('/public/semta', $id . " upper_pembimbing1." . $extension2);

            // $url2 = Storage::url($id . " upper_pembimbing1." . $extension2);
        }
        if ($request->upper_pembimbing2) {
            $lastName = 'upper_pembimbing2';
            $dirSave = 'semta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->upper_pembimbing2);
            $extension3 = $request->upper_pembimbing2->extension();

            // $request->upper_pembimbing2->storeAs('/public/semta', $id . " upper_pembimbing2." . $extension3);

            // $url3 = Storage::url($id . " upper_pembimbing2." . $extension3);
        }
        if ($request->sk_pembimbingta) {
            $lastName = 'sk_pembimbingta';
            $dirSave = 'semta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->sk_pembimbingta);
            $extension4 = $request->sk_pembimbingta->extension();

            // $request->sk_pembimbingta->storeAs('/public/semta', $id . " sk_pembimbingta." . $extension4);

            // $url4 = Storage::url($id . " sk_pembimbingta." . $extension4);
        }
        if ($request->lembar_pembimbingta) {
            $lastName = 'lembar_pembimbingta';
            $dirSave = 'semta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->lembar_pembimbingta);
            $extension5 = $request->lembar_pembimbingta->extension();

            // $request->lembar_pembimbingta->storeAs('/public/semta', $id . " lembar_pembimbingta." . $extension5);

            // $url5 = Storage::url($id . " lembar_pembimbingta." . $extension5);
        }
        if ($request->transkip) {
            $lastName = 'transkip';
            $dirSave = 'semta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->transkip);
            $extension6 = $request->transkip->extension();

            // $request->transkip->storeAs('/public/semta', $id . " transkip." . $extension6);

            // $url6 = Storage::url($id . " transkip." . $extension6);
        }
        if ($request->bukti_penyerahan_lapkp) {
            $lastName = 'bukti_penyerahan_lapkp';
            $dirSave = 'semta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->bukti_penyerahan_lapkp);
            $extension7 = $request->bukti_penyerahan_lapkp->extension();

            // $request->bukti_penyerahan_lapkp->storeAs('/public/semta', $id . " bukti_penyerahan_lapkp." . $extension7);

            // $url7 = Storage::url($id . " bukti_penyerahan_lapkp." . $extension7);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfsemta = new TransWFsemta();
        $transwfsemta->history = $history;
        $pengajuansemta = new Pengajuansemta();
        $pengajuansemta->email = $request->email;
        $pengajuansemta->nama = $request->nama;
        $pengajuansemta->nohp = $request->nohp;
        $pengajuansemta->nim = $request->nim;
        $pengajuansemta->jurusan = $request->jurusan;
        $pengajuansemta->jenis_surat = $request->jenis_surat;
        $pengajuansemta->tgl_pengajuan = $request->tgl_pengajuan;
        $pengajuansemta->nm_pembimbing1 = $request->nm_pembimbing1;
        $pengajuansemta->nm_pembimbing2 = $request->nm_pembimbing2;
        $pengajuansemta->upper_seminar = $request->upper_seminar;
        if ($request->for_seminar) {
            $pengajuansemta->for_seminar = $id . " for_seminar." . $extension1;
        }
        if ($request->upper_pembimbing1) {
            $pengajuansemta->upper_pembimbing1 = $id . " upper_pembimbing1." . $extension2;
        }
        if ($request->upper_pembimbing2) {
            $pengajuansemta->upper_pembimbing2 = $id . " upper_pembimbing2." . $extension3;
        }
        if ($request->sk_pembimbingta) {
            $pengajuansemta->sk_pembimbingta = $id . " sk_pembimbingta." . $extension4;
        }
        if ($request->lembar_pembimbingta) {
            $pengajuansemta->lembar_pembimbingta = $id . " lembar_pembimbingta." . $extension5;
        }
        if ($request->transkip) {
            $pengajuansemta->transkip = $id . " transkip." . $extension6;
        }
        if ($request->bukti_penyerahan_lapkp) {
            $pengajuansemta->bukti_penyerahan_lapkp = $id . " bukti_penyerahan_lapkp." . $extension7;
        } else {
            $takelampiran = Pengajuansemta::where('nim', $id)->first();

            $pengajuansemta->for_seminar = $takelampiran->for_seminar;
            $pengajuansemta->upper_pembimbing1 = $takelampiran->upper_pembimbing1;
            $pengajuansemta->upper_pembimbing2 = $takelampiran->upper_pembimbing2;
            $pengajuansemta->sk_pembimbingta = $takelampiran->sk_pembimbingta;
            $pengajuansemta->lembar_pembimbingta = $takelampiran->lembar_pembimbingta;
            $pengajuansemta->transkip = $takelampiran->transkip;
            $pengajuansemta->bukti_penyerahan_lapkp = $takelampiran->bukti_penyerahan_lapkp;
        }
        $pengajuansemta->user_id = $request->created_by;
        $pengajuansemta->created_date = now();

        $pengajuansemta->save();
        $pengajuansemta->transwfsemta()->save($transwfsemta);

        // $notif = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'Pengajuansemta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        // return redirect()->route('mahasiswa.pengajuansemta')->with('success','Pengajuan sidang proposal tugas akhir berhasil dilakukan.');
        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Pengajuan seminar tugas akhir berhasil dilakukan, cek track record secara berkala!');
    }



    public function pengajuansta()
    {
        // return view('mahasiswa.pengajuansta');
        $data = Pengajuansta::with('user', 'transwfsta', 'transwfsta.wfr')->where('id_user', auth()->id())->get();
        return view('mahasiswa/pengajuansta', compact('data'));
    }

    public function pengajuanstastore(Request $request)
    {

        $datas = Pengajuansta::with('user', 'transwfsta', 'transwfsta.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'nim' => 'required',
                'jurusan' => 'required',
                'tgl_pengajuan' => 'required',
                'nm_pembimbing1' => 'required',
                'nm_pembimbing2' => 'required',
                'uppersta' => 'required',
                //    'for_ta' => 'required',
                //    'upper_pembimbing1' => 'required',
                //    'upper_pembimbing2' => 'required',
                   'sk_pembimbingta' => 'required',
                   'transkip' => 'required',
                   'buksum_artikel' => 'required',
                   'lembar_revisi_seminar' => 'required',
                   'draft_ta' => 'required',
                   'bukbayar_ukt' => 'required',
                   'tes_telp' => 'required',
                   'cek_plagiat' => 'required',
                'kerja' => 'required',
                // 'jabatan' => 'required',
                // 'nm_perusahaan' => 'required',
                // 'alamat_perusahaan' => 'required',
                // 'jenis_perjanjiankerja' => 'required',
                // 'tgl_mulai' => 'required',
                // 'gaji' => 'required',
                // 'email_perusahaan' => 'required',
                // 'notelp_perusahaan' => 'required',
                // 'pernyataan' => 'required',
            ]);


        $id = $request->nim;
        if ($request->for_ta) {
            $lastName = 'for_ta';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->for_ta);
            $extension1 = $request->for_ta->extension();
            // $request->for_ta->storeAs('/public/sta', $id . " for_ta." . $extension1);
            // $url1 = Storage::url($id . " for_ta." . $extension1);
        }
        if ($request->upper_pembimbing1) {
            $lastName = 'upper_pembimbing1';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->upper_pembimbing1);
            $extension2 = $request->upper_pembimbing1->extension();
            // $request->upper_pembimbing1->storeAs('/public/sta', $id . " upper_pembimbing1." . $extension2);
            // $url2 = Storage::url($id . " upper_pembimbing1." . $extension2);
        }
        if ($request->upper_pembimbing2) {
            $lastName = 'upper_pembimbing2';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->upper_pembimbing2);
            $extension3 = $request->upper_pembimbing2->extension();
            // $request->upper_pembimbing2->storeAs('/public/sta', $id . " upper_pembimbing2." . $extension3);
            // $url3 = Storage::url($id . " upper_pembimbing2." . $extension3);
        }
        if ($request->sk_pembimbingta) {
            $lastName = 'sk_pembimbingta';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->sk_pembimbingta);
            $extension4 = $request->sk_pembimbingta->extension();
            // $request->sk_pembimbingta->storeAs('/public/sta', $id . " sk_pembimbingta." . $extension4);
            // $url4 = Storage::url($id . " sk_pembimbingta." . $extension4);
        }
        if ($request->transkip) {
            $lastName = 'transkip';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->transkip);
            $extension5 = $request->transkip->extension();
            // $request->transkip->storeAs('/public/sta', $id . " transkip." . $extension5);
            // $url5 = Storage::url($id . " transkip." . $extension5);
        }
        if ($request->buksum_artikel) {
            $lastName = 'buksum_artikel';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->buksum_artikel);
            $extension6 = $request->buksum_artikel->extension();
            // $request->buksum_artikel->storeAs('/public/sta', $id . " buksum_artikel." . $extension6);
            // $url6 = Storage::url($id . " buksum_artikel." . $extension6);
        }
        if ($request->lembar_revisi_seminar) {
            $lastName = 'lembar_revisi_seminar';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->lembar_revisi_seminar);
            $extension7 = $request->lembar_revisi_seminar->extension();
            // $request->lembar_revisi_seminar->storeAs('/public/sta', $id . " lembar_revisi_seminar." . $extension7);
            // $url7 = Storage::url($id . " lembar_revisi_seminar." . $extension7);
        }
        if ($request->draft_ta) {
            $lastName = 'draft_ta';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->draft_ta);
            $extension8 = $request->draft_ta->extension();
            // $request->draft_ta->storeAs('/public/sta', $id . " draft_ta." . $extension8);
            // $url8 = Storage::url($id . " draft_ta." . $extension8);
        }
        if ($request->bukbayar_ukt) {
            $lastName = 'bukbayar_ukt';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->bukbayar_ukt);
            $extension9 = $request->bukbayar_ukt->extension();
            // $request->bukbayar_ukt->storeAs('/public/sta', $id . " bukbayar_ukt." . $extension9);
            // $url9 = Storage::url($id . " bukbayar_ukt." . $extension9);
        }
        if ($request->tes_telp) {
            $lastName = 'tes_telp';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->tes_telp);
            $extension10 = $request->tes_telp->extension();
            // $request->tes_telp->storeAs('/public/sta', $id . " tes_telp." . $extension10);
            // $url10 = Storage::url($id . " tes_telp." . $extension10);
        }
        if ($request->cek_plagiat) {
            $lastName = 'cek_plagiat';
            $dirSave = 'sta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->cek_plagiat);
            $extension11 = $request->cek_plagiat->extension();
            // $request->cek_plagiat->storeAs('/public/sta', $id . " cek_plagiat." . $extension11);
            // $url11 = Storage::url($id . " cek_plagiat." . $extension11);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfsta = new TransWFsta();
        $transwfsta->history = $history;
        $pengajuansta = new Pengajuansta();
        $pengajuansta->email = $request->email;
        $pengajuansta->nama = $request->nama;
        $pengajuansta->nohp = $request->nohp;
        $pengajuansta->nim = $request->nim;
        $pengajuansta->jurusan = $request->jurusan;
        $pengajuansta->jenis_surat = $request->jenis_surat;
        $pengajuansta->tgl_pengajuan = $request->tgl_pengajuan;
        $pengajuansta->nm_pembimbing1 = $request->nm_pembimbing1;
        $pengajuansta->nm_pembimbing2 = $request->nm_pembimbing2;
        $pengajuansta->uppersta = $request->uppersta;
        if ($request->for_ta) {
            $pengajuansta->for_ta = $id . " for_ta." . $extension1;
        }
        if ($request->upper_pembimbing1) {
            $pengajuansta->upper_pembimbing1 = $id . " upper_pembimbing1." . $extension2;
        }
        if ($request->upper_pembimbing2) {
            $pengajuansta->upper_pembimbing2 = $id . " upper_pembimbing2." . $extension3;
        }
        if ($request->sk_pembimbingta) {
            $pengajuansta->sk_pembimbingta = $id . " sk_pembimbingta." . $extension4;
        }
        if ($request->transkip) {
            $pengajuansta->transkip = $id . " transkip." . $extension5;
        }
        if ($request->buksum_artikel) {
            $pengajuansta->buksum_artikel = $id . " buksum_artikel." . $extension6;
        }
        if ($request->lembar_revisi_seminar) {
            $pengajuansta->lembar_revisi_seminar = $id . " lembar_revisi_seminar." . $extension7;
        }
        if ($request->draft_ta) {
            $pengajuansta->draft_ta = $id . " draft_ta." . $extension8;
        }
        if ($request->bukbayar_ukt) {
            $pengajuansta->bukbayar_ukt = $id . " bukbayar_ukt." . $extension9;
        }
        if ($request->tes_telp) {
            $pengajuansta->tes_telp = $id . " tes_telp." . $extension10;
        }
        if ($request->cek_plagiat) {
            $pengajuansta->cek_plagiat = $id . " cek_plagiat." . $extension11;
        } else {
            $takelampiran = Pengajuansta::where('nim', $id)->first();

            $pengajuansta->for_ta = $takelampiran->for_ta;
            $pengajuansta->upper_pembimbing1 = $takelampiran->upper_pembimbing1;
            $pengajuansta->upper_pembimbing2 = $takelampiran->upper_pembimbing2;
            $pengajuansta->sk_pembimbingta = $takelampiran->sk_pembimbingta;
            $pengajuansta->transkip = $takelampiran->transkip;
            $pengajuansta->buksum_artikel = $takelampiran->buksum_artikel;
            $pengajuansta->lembar_revisi_seminar = $takelampiran->lembar_revisi_seminar;
            $pengajuansta->draft_ta = $takelampiran->draft_ta;
            $pengajuansta->bukbayar_ukt = $takelampiran->bukbayar_ukt;
            $pengajuansta->tes_telp = $takelampiran->tes_telp;
            $pengajuansta->cek_plagiat = $takelampiran->cek_plagiat;
        }

        $pengajuansta->kerja = $request->kerja;
        $pengajuansta->jabatan = $request->jabatan;
        $pengajuansta->nm_perusahaan = $request->nm_perusahaan;
        $pengajuansta->alamat_perusahaan = $request->alamat_perusahaan;
        $pengajuansta->jenis_perjanjiankerja = $request->jenis_perjanjiankerja;
        $pengajuansta->tgl_mulai = $request->tgl_mulai;
        $pengajuansta->gaji = $request->gaji;
        $pengajuansta->email_perusahaan = $request->email_perusahaan;
        $pengajuansta->notelp_perusahaan = $request->notelp_perusahaan;
        $pengajuansta->pernyataan = $request->pernyataan;

        $pengajuansta->id_user = $request->created_by;
        $pengajuansta->created_date = now();

        $pengajuansta->save();
        $pengajuansta->transwfsta()->save($transwfsta);

        // $notif = Notifikasi::where('jenis', 'Pengajuansta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'Pengajuansta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Pengajuan sidang tugas akhir berhasil dilakukan, cek track record secara berkala!');
    }

    public function pengajuanskp()
    {
        // return view('mahasiswa.pengajuanskp');
        $data = Pengajuanskp::with('user', 'transwfskp', 'transwfskp.wfr')->where('id_user', auth()->id())->get();
        return view('mahasiswa/pengajuanskp', compact('data'));
    }
    public function pengajuanskpstore(Request $request)
    {

        $datas = Pengajuanskp::with('user', 'transwfskp', 'transwfskp.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'nim' => 'required',
                'jurusan' => 'required',
                'tgl_pengajuan' => 'required',
                'nm_pembimbing' => 'required',
                'forper_kp' => 'required',
                //    'upfor_ajuan' => 'required',
                //    'upper_pembimbing' => 'required',
                //    'surat_selesaikp' => 'required',
                //    'daftarhadirkp' => 'required',
                //    'nilaikp_pembimbing' => 'required',
                //    'sk_pembimbingkp' => 'required',
                //    'lembar_pembimbingkp' => 'required',
                //    'transkip' => 'required',
                //    'draft_lapkp' => 'required',
            ]);


        $id = $request->nim;
        if ($request->upfor_ajuan) {
            $lastName = 'upfor_ajuanta';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->upfor_ajuan);
            $extension1 = $request->upfor_ajuan->extension();
            // $request->upfor_ajuan->storeAs('/public/skp', $id . " upfor_ajuan." . $extension1);
            // $url1 = Storage::url($id . " upfor_ajuan." . $extension1);
        }
        if ($request->upper_pembimbing) {
            $lastName = 'upper_pembimbing';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->upper_pembimbing);
            $extension2 = $request->upper_pembimbing->extension();
            // $request->upper_pembimbing->storeAs('/public/skp', $id . " upper_pembimbing." . $extension2);
            // $url2 = Storage::url($id . " upper_pembimbing." . $extension2);
        }
        if ($request->surat_selesaikp) {
            $lastName = 'surat_selesaikp';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->surat_selesaikp);
            $extension3 = $request->surat_selesaikp->extension();
            // $request->surat_selesaikp->storeAs('/public/skp', $id . " surat_selesaikp." . $extension3);
            // $url3 = Storage::url($id . " surat_selesaikp." . $extension3);
        }
        if ($request->daftarhadirkp) {
            $lastName = 'daftarhadirkp';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->daftarhadirkp);
            $extension4 = $request->daftarhadirkp->extension();
            // $request->daftarhadirkp->storeAs('/public/skp', $id . " daftarhadirkp." . $extension4);
            // $url4 = Storage::url($id . " daftarhadirkp." . $extension4);
        }
        if ($request->nilaikp_pembimbing) {
            $lastName = 'nilaikp_pembimbing';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->nilaikp_pembimbing);
            $extension5 = $request->nilaikp_pembimbing->extension();
            // $request->nilaikp_pembimbing->storeAs('/public/skp', $id . " nilaikp_pembimbing." . $extension5);
            // $url5 = Storage::url($id . " nilaikp_pembimbing." . $extension5);
        }
        if ($request->sk_pembimbingkp) {
            $lastName = 'sk_pembimbingkp';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->sk_pembimbingkp);
            $extension6 = $request->sk_pembimbingkp->extension();
            // $request->sk_pembimbingkp->storeAs('/public/skp', $id . " sk_pembimbingkp." . $extension6);
            // $url6 = Storage::url($id . " sk_pembimbingkp." . $extension6);
        }
        if ($request->lembar_pembimbingkp) {
            $lastName = 'lembar_pembimbingkp';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->lembar_pembimbingkp);
            $extension7 = $request->lembar_pembimbingkp->extension();
            // $request->lembar_pembimbingkp->storeAs('/public/skp', $id . " lembar_pembimbingkp." . $extension7);
            // $url7 = Storage::url($id . " lembar_pembimbingkp." . $extension7);
        }
        if ($request->transkip) {
            $lastName = 'transkipft_ta';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->transkip);
            $extension8 = $request->transkip->extension();
            // $request->transkip->storeAs('/public/skp', $id . " transkip." . $extension8);
            // $url8 = Storage::url($id . " transkip." . $extension8);
        }
        if ($request->draft_lapkp) {
            $lastName = 'draft_lapkpta';
            $dirSave = 'skp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->draft_lapkp);
            $extension9 = $request->draft_lapkp->extension();
            // $request->draft_lapkp->storeAs('/public/skp', $id . " draft_lapkp." . $extension9);
            // $url9 = Storage::url($id . " draft_lapkp." . $extension9);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfskp = new TransWFskp();
        $transwfskp->history = $history;
        $pengajuanskp = new Pengajuanskp();
        $pengajuanskp->email = $request->email;
        $pengajuanskp->nama = $request->nama;
        $pengajuanskp->nohp = $request->nohp;
        $pengajuanskp->nim = $request->nim;
        $pengajuanskp->jurusan = $request->jurusan;
        $pengajuanskp->jenis_surat = $request->jenis_surat;
        $pengajuanskp->tgl_pengajuan = $request->tgl_pengajuan;
        $pengajuanskp->nm_pembimbing = $request->nm_pembimbing;
        $pengajuanskp->forper_kp = $request->forper_kp;
        if ($request->upfor_ajuan) {
            $pengajuanskp->upfor_ajuan = $id . " upfor_ajuan." . $extension1;
        }
        if ($request->upper_pembimbing) {
            $pengajuanskp->upper_pembimbing = $id . " upper_pembimbing." . $extension2;
        }
        if ($request->surat_selesaikp) {
            $pengajuanskp->surat_selesaikp = $id . " surat_selesaikp." . $extension3;
        }
        if ($request->daftarhadirkp) {
            $pengajuanskp->daftarhadirkp = $id . " daftarhadirkp." . $extension4;
        }
        if ($request->nilaikp_pembimbing) {
            $pengajuanskp->nilaikp_pembimbing = $id . " nilaikp_pembimbing." . $extension5;
        }
        if ($request->sk_pembimbingkp) {
            $pengajuanskp->sk_pembimbingkp = $id . " sk_pembimbingkp." . $extension6;
        }
        if ($request->lembar_pembimbingkp) {
            $pengajuanskp->lembar_pembimbingkp = $id . " lembar_pembimbingkp." . $extension7;
        }
        if ($request->transkip) {
            $pengajuanskp->transkip = $id . " transkip." . $extension8;
        }
        if ($request->draft_lapkp) {
            $pengajuanskp->draft_lapkp = $id . " draft_lapkp." . $extension9;
        } else {
            $takelampiran = Pengajuanskp::where('nim', $id)->first();

            $pengajuanskp->upfor_ajuan = $takelampiran->upfor_ajuan;
            $pengajuanskp->upper_pembimbing = $takelampiran->upper_pembimbing;
            $pengajuanskp->surat_selesaikp = $takelampiran->surat_selesaikp;
            $pengajuanskp->daftarhadirkp = $takelampiran->daftarhadirkp;
            $pengajuanskp->nilaikp_pembimbing = $takelampiran->nilaikp_pembimbing;
            $pengajuanskp->sk_pembimbingkp = $takelampiran->sk_pembimbingkp;
            $pengajuanskp->lembar_pembimbingkp = $takelampiran->lembar_pembimbingkp;
            $pengajuanskp->transkip = $takelampiran->transkip;
            $pengajuanskp->draft_lapkp = $takelampiran->draft_lapkp;
        }

        $pengajuanskp->id_user = $request->created_by;
        $pengajuanskp->created_date = now();

        $pengajuanskp->save();
        $pengajuanskp->transwfskp()->save($transwfskp);

        // $notif = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Pengajuan sidang kerja praktek berhasil dilakukan, cek track record secara berkala!');
    }

    public function pengajuanpskkp()
    {
        // return view('mahasiswa.pengajuanpskkp');
        $data = Pengajuanpskkp::with('user', 'transwfpskkp', 'transwfpskkp.wfr')->where('id_user', auth()->id())->get();
        return view('mahasiswa/pengajuanpskkp', compact('data'));
    }
    public function pengajuanpskkpstore(Request $request)
    {

        $datas = Pengajuanpskkp::with('user', 'transwfpskkp', 'transwfpskkp.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'nim' => 'required',
                'jurusan' => 'required',
                'tgl_pengajuan' => 'required',
                'nm_pembimbing' => 'required',
                'bukti_ajuankp' => 'required',
                //    'upfor_ajuan' => 'required',
                //    'upper_pembimbing' => 'required',
                'scanombuspbn' => 'required',
                //    'up_ombus' => 'required',
                //    'up_pbn' => 'required',
                //    'transkip' => 'required',
                //    'pernyataan' => 'required',
            ]);

        $id = $request->nim;
        if ($request->upfor_ajuan) {
            $lastName = 'upfor_ajuan';
            $dirSave = 'pskkp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->upfor_ajuan);
            $extension1 = $request->upfor_ajuan->extension();

            // $request->upfor_ajuan->storeAs('/public/pskkp', $id . " upfor_ajuan." . $extension1);

            // $url1 = Storage::url($id . " upfor_ajuan." . $extension1);
        }
        if ($request->upper_pembimbing) {
            $lastName = 'upper_pembimbing';
            $dirSave = 'pskkp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->upper_pembimbing);
            $extension2 = $request->upper_pembimbing->extension();

            // $request->upper_pembimbing->storeAs('/public/pskkp', $id . " upper_pembimbing." . $extension2);

            // $url2 = Storage::url($id . " upper_pembimbing." . $extension2);
        }
        if ($request->up_ombus) {
            $lastName = 'up_ombus';
            $dirSave = 'pskkp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->up_ombus);
            $extension3 = $request->up_ombus->extension();

            // $request->up_ombus->storeAs('/public/pskkp', $id . " up_ombus." . $extension3);

            // $url3 = Storage::url($id . " up_ombus." . $extension3);
        }
        if ($request->up_pbn) {
            $lastName = 'up_pbn';
            $dirSave = 'pskkp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->up_pbn);
            $extension4 = $request->up_pbn->extension();

            // $request->up_pbn->storeAs('/public/pskkp', $id . " up_pbn." . $extension4);

            // $url4 = Storage::url($id . " up_pbn." . $extension4);
        }
        if ($request->transkip) {
            $lastName = 'transkip';
            $dirSave = 'pskkp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->transkip);
            $extension5 = $request->transkip->extension();

            // $request->transkip->storeAs('/public/pskkp', $id . " transkip." . $extension5);

            // $url5 = Storage::url($id . " transkip." . $extension5);
        }
        if ($request->pernyataan) {
            $lastName = 'pernyataan';
            $dirSave = 'pskkp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->pernyataan);
            $extension6 = $request->pernyataan->extension();

            // $request->pernyataan->storeAs('/public/pskkp', $id . " pernyataan." . $extension6);

            // $url6 = Storage::url($id . " pernyataan." . $extension6);
        }
        if ($request->pmagang) {
            $lastName = 'pmagang';
            $dirSave = 'pskkp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->pmagang);
            $extension7 = $request->pmagang->extension();

            // $request->pmagang->storeAs('/public/pskkp', $id . " pmagang." . $extension7);

            // $url7 = Storage::url($id . " pmagang." . $extension7);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfpskkp = new TransWFpskkp();
        $transwfpskkp->history = $history;
        $pengajuanpskkp = new Pengajuanpskkp();
        $pengajuanpskkp->email = $request->email;
        $pengajuanpskkp->nama = $request->nama;
        $pengajuanpskkp->nohp = $request->nohp;
        $pengajuanpskkp->nim = $request->nim;
        $pengajuanpskkp->jurusan = $request->jurusan;
        $pengajuanpskkp->jenis_surat = $request->jenis_surat;
        $pengajuanpskkp->tgl_pengajuan = $request->tgl_pengajuan;
        $pengajuanpskkp->nm_pembimbing = $request->nm_pembimbing;
        $pengajuanpskkp->bukti_ajuankp = $request->bukti_ajuankp;
        if ($request->upfor_ajuan) {
            $pengajuanpskkp->upfor_ajuan = $id . " upfor_ajuan." . $extension1;
        }
        if ($request->upper_pembimbing) {
            $pengajuanpskkp->upper_pembimbing = $id . " upper_pembimbing." . $extension2;
        }
        if ($request->up_ombus) {
            $pengajuanpskkp->up_ombus = $id . " up_ombus." . $extension3;
        }
        if ($request->up_pbn) {
            $pengajuanpskkp->up_pbn = $id . " up_pbn." . $extension4;
        }
        if ($request->transkip) {
            $pengajuanpskkp->transkip = $id . " transkip." . $extension5;
        }
        if ($request->pernyataan) {
            $pengajuanpskkp->pernyataan = $id . " pernyataan." . $extension6;
        }
        if ($request->pmagang) {
            $pengajuanpskkp->pmagang = $id . " pmagang." . $extension7;
        } else {
            $takelampiran = Pengajuanpskkp::where('nim', $id)->first();

            $pengajuanpskkp->upfor_ajuan = $takelampiran->upfor_ajuan;
            $pengajuanpskkp->upper_pembimbing = $takelampiran->upper_pembimbing;
            $pengajuanpskkp->up_ombus = $takelampiran->up_ombus;
            $pengajuanpskkp->up_pbn = $takelampiran->up_pbn;
            $pengajuanpskkp->transkip = $takelampiran->transkip;
            $pengajuanpskkp->pernyataan = $takelampiran->pernyataan;
            $pengajuanpskkp->pmagang = $takelampiran->pmagang;
        }

        $pengajuanpskkp->scanombuspbn = $request->scanombuspbn;
        $pengajuanpskkp->id_user = $request->created_by;
        $pengajuanpskkp->created_date = now();

        $pengajuanpskkp->save();
        $pengajuanpskkp->transwfpskkp()->save($transwfpskkp);

        // $notif = Notifikasi::where('jenis', 'Pengajuanpskkp')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'Pengajuanpskkp')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);


        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Pengajuan pengusulan sk kp berhasil dilakukan, cek track record secara berkala!');
    }

    public function pengajuanpptakp()
    {
        // return view('mahasiswa.pengajuanpptakp');
        $data = Pengajuanpptakp::with('user', 'transwfpptakp', 'transwfpptakp.wfr')->where('id_user', auth()->id())->get();
        return view('mahasiswa/pengajuanpptakp', compact('data'));
    }
    public function pengajuanpptakpstore(Request $request)
    {

        $datas = Pengajuanpptakp::with('user', 'transwfpptakp', 'transwfpptakp.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'nim' => 'required',
                'jurusan' => 'required',
                'permohonan_dok' => 'required',
                //    'skpembimbing_akhir' => 'required',
                //    'uppernyataan_perspem' => 'required',
            ]);

        $id = $request->nim;
        if ($request->skpembimbing_akhir) {
            $lastName = 'skpembimbing_akhir';
            $dirSave = 'pptakp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->skpembimbing_akhir);
            $extension1 = $request->skpembimbing_akhir->extension();

            // $request->skpembimbing_akhir->storeAs('/public/pptakp', $id . " skpembimbing_akhir." . $extension1);

            // $url1 = Storage::url($id . " skpembimbing_akhir." . $extension1);
        }
        if ($request->uppernyataan_perspem) {
            $lastName = 'uppernyataan_perspem';
            $dirSave = 'pptakp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->uppernyataan_perspem);
            $extension2 = $request->uppernyataan_perspem->extension();

            // $request->uppernyataan_perspem->storeAs('/public/pptakp', $id . " uppernyataan_perspem." . $extension2);

            // $url2 = Storage::url($id . " uppernyataan_perspem." . $extension2);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfpptakp = new TransWFpptakp();
        $transwfpptakp->history = $history;
        $pengajuanpptakp = new Pengajuanpptakp();
        $pengajuanpptakp->email = $request->email;
        $pengajuanpptakp->nama = $request->nama;
        $pengajuanpptakp->nohp = $request->nohp;
        $pengajuanpptakp->nim = $request->nim;
        $pengajuanpptakp->jurusan = $request->jurusan;
        $pengajuanpptakp->jenis_surat = $request->jenis_surat;
        $pengajuanpptakp->permohonan_dok = $request->permohonan_dok;
        if ($request->skpembimbing_akhir) {
            $pengajuanpptakp->skpembimbing_akhir = $id . " skpembimbing_akhir." . $extension1;
        }
        if ($request->uppernyataan_perspem) {
            $pengajuanpptakp->uppernyataan_perspem = $id . " uppernyataan_perspem." . $extension2;
        } else {
            $takelampiran = Pengajuanpptakp::where('nim', $id)->first();

            $pengajuanpptakp->skpembimbing_akhir = $takelampiran->skpembimbing_akhir;
            $pengajuanpptakp->uppernyataan_perspem = $takelampiran->uppernyataan_perspem;
        }

        $pengajuanpptakp->id_user = $request->created_by;
        $pengajuanpptakp->created_date = now();

        $pengajuanpptakp->save();
        $pengajuanpptakp->transwfpptakp()->save($transwfpptakp);

        // $notif = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Pengajuan perpanjangan ta atau kp berhasil dilakukan, cek track record secara berkala!');
    }

    public function pengajuanulta()
    {
        // return view('mahasiswa.pengajuanulta');
        $data = Pengajuanulta::with('user', 'transwfulta', 'transwfulta.wfr')->get();
        return view('mahasiswa/pengajuanulta', compact('data'));
    }
    public function pengajuanultastore(Request $request)
    {

        $datas = Pengajuanulta::with('user', 'transwfulta', 'transwfulta.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nim' => 'required',
                'nama' => 'required',
                'jurusan' => 'required',
                'tgl_pengumpulan' => 'required',
                'judul_ta' => 'required',
                'nm_pembimbing1' => 'required',
                'nm_pembimbing2' => 'required',
                'tgl_sidangta' => 'required',
                //    'file_laporanaplikasi' => 'required',
            ]);

        // $data = Pengajuanulta::create($request->all());
        // if ($request->hasFile('file_laporanaplikasi')){
        //     $request->file('file_laporanaplikasi')->move('pengajuanulta/', $request->file('file_laporanaplikasi')->getClientOriginalName());
        //     $data->file_laporanaplikasi = $request->file('file_laporanaplikasi')->getClientOriginalName();
        //     $data->save();
        // }


        $id = $request->nim;
        if ($request->file_laporanaplikasi) {
            $lastName = 'file_laporanaplikasi';
            $dirSave = 'ulta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->file_laporanaplikasi);
            $extension1 = $request->file_laporanaplikasi->extension();

            // $request->file_laporanaplikasi->storeAs('/public/ulta', $id . " file_laporanaplikasi." . $extension1);

            // $url1 = Storage::url($id . " file_laporanaplikasi." . $extension1);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfulta = new TransWFulta();
        $transwfulta->history = $history;
        $pengajuanulta = new Pengajuanulta();
        $pengajuanulta->email = $request->email;
        $pengajuanulta->nim = $request->nim;
        $pengajuanulta->nama = $request->nama;
        $pengajuanulta->jurusan = $request->jurusan;
        $pengajuanulta->tgl_pengumpulan = $request->tgl_pengumpulan;
        $pengajuanulta->judul_ta = $request->judul_ta;
        $pengajuanulta->nm_pembimbing1 = $request->nm_pembimbing1;
        $pengajuanulta->nm_pembimbing2 = $request->nm_pembimbing2;
        $pengajuanulta->tgl_sidangta = $request->tgl_sidangta;
        if ($request->file_laporanaplikasi) {
            $pengajuanulta->file_laporanaplikasi = $id . " file_laporanaplikasi." . $extension1;
        } else {
            $takelampiran = Pengajuanulta::where('nim', $id)->first();

            $pengajuanulta->file_laporanaplikasi = $takelampiran->file_laporanaplikasi;
        }
        $pengajuanulta->id_user = $request->created_by;
        $pengajuanulta->created_date = now();

        $pengajuanulta->save();
        $pengajuanulta->transwfulta()->save($transwfulta);


        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Unggah laporan TA berhasil dilakukan');
    }

    public function pengajuanulkp()
    {
        //return view('mahasiswa.pengajuanulkp');
        $data = Pengajuanulkp::with('user', 'transwfulkp', 'transwfulkp.wfr')->get();
        return view('mahasiswa/pengajuanulkp', compact('data'));
    }
    public function pengajuanulkpstore(Request $request)
    {

        $datas = Pengajuanulkp::with('user', 'transwfulkp', 'transwfulkp.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nim' => 'required',
                'nama' => 'required',
                'jurusan' => 'required',
                'tgl_pengumpulan' => 'required',
                'judulkp' => 'required',
                'nm_pembimbing' => 'required',
                'instansi' => 'required',
                'tgl_sidangkp' => 'required',
                //    'file_laporanaplikasi' => 'required',
            ]);

        $id = $request->nim;
        if ($request->file_laporanaplikasi) {
            $lastName = 'file_laporanaplikasi';
            $dirSave = 'ulkp';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->file_laporanaplikasi);
            $extension1 = $request->file_laporanaplikasi->extension();

            // $request->file_laporanaplikasi->storeAs('/public/ulkp', $id . " file_laporanaplikasi." . $extension1);

            // $url1 = Storage::url($id . " file_laporanaplikasi." . $extension1);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfulkp = new TransWFulkp();
        $transwfulkp->history = $history;
        $pengajuanulkp = new Pengajuanulkp();
        $pengajuanulkp->email = $request->email;
        $pengajuanulkp->nim = $request->nim;
        $pengajuanulkp->nama = $request->nama;
        $pengajuanulkp->jurusan = $request->jurusan;
        $pengajuanulkp->tgl_pengumpulan = $request->tgl_pengumpulan;
        $pengajuanulkp->judulkp = $request->judulkp;
        $pengajuanulkp->nm_pembimbing = $request->nm_pembimbing;
        $pengajuanulkp->instansi = $request->instansi;
        $pengajuanulkp->tgl_sidangkp = $request->tgl_sidangkp;
        if ($request->file_laporanaplikasi) {
            $pengajuanulkp->file_laporanaplikasi = $id . " file_laporanaplikasi." . $extension1;
        } else {
            $takelampiran = Pengajuanulkp::where('nim', $id)->first();

            $pengajuanulkp->file_laporanaplikasi = $takelampiran->file_laporanaplikasi;
        }
        $pengajuanulkp->id_user = $request->created_by;
        $pengajuanulkp->created_date = now();

        $pengajuanulkp->save();
        $pengajuanulkp->transwfulkp()->save($transwfulkp);

        // $notif = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);


        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Unggah laporan KP berhasil dilakukan');
    }

    public function pengajuanbpit()
    {
        // return view('mahasiswa.pengajuanbpit');
        $data = Pengajuanbpit::with('user', 'transwfbpit', 'transwfbpit.wfr')->get();
        return view('mahasiswa/pengajuanbpit', compact('data'));
    }
    public function pengajuanbpitstore(Request $request)
    {
        $datas = Pengajuanbpit::with('user', 'transwfbpit', 'transwfbpit.wfr')->get();

        foreach ($datas as $data)

            $request->validate([
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tgi_lahir' => 'required',
                'nim' => 'required',
                'no_ijazah' => 'required',
                'jurusan' => 'required',
                'tgl_lulus' => 'required',
                'tgl_terbitijazah' => 'required',
                'nohp' => 'required',
                'email' => 'required',
                'alamat' => 'required',
                'nm_pengambil' => 'required',
                'nobuku_pengambilan' => 'required',
                //    'foto_pengambilan' => 'required',
                //    'kerja' => 'required',
                //    'jabatan' => 'required',
                //    'nm_perusahaan' => 'required',
                //    'alamat_perusahaan' => 'required',
                //    'jenis_pernjanjiankerja' => 'required',
                //    'tgl_mulai' => 'required',
                //    'gaji' => 'required',
                //    'email_perusahaan' => 'required',
                //    'notelp_perusahaan' => 'required',
                //    'pernyataan' => 'required',
                //    'keterangan' => 'required',
                //    'alasan' => 'required',
            ]);


        $id = $request->nim;
        if ($request->foto_pengambilan) {
            $lastName = 'foto_pengambilan';
            $dirSave = 'bpit';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->foto_pengambilan);
            $extension1 = $request->foto_pengambilan->extension();

            // $request->foto_pengambilan->storeAs('/public/ulta', $id . " foto_pengambilan." . $extension1);

            // $url1 = Storage::url($id . " foto_pengambilan." . $extension1);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfbpit = new TransWFbpit();
        $transwfbpit->history = $history;
        $pengajuanbpit = new Pengajuanbpit();
        $pengajuanbpit->nama = $request->nama;
        $pengajuanbpit->tempat_lahir = $request->tempat_lahir;
        $pengajuanbpit->tgi_lahir = $request->tgi_lahir;
        $pengajuanbpit->nim = $request->nim;
        $pengajuanbpit->no_ijazah = $request->no_ijazah;
        $pengajuanbpit->jurusan = $request->jurusan;
        $pengajuanbpit->tgl_lulus = $request->tgl_lulus;
        $pengajuanbpit->tgl_terbitijazah = $request->tgl_terbitijazah;
        $pengajuanbpit->nohp = $request->nohp;
        $pengajuanbpit->email = $request->email;
        $pengajuanbpit->alamat = $request->alamat;
        $pengajuanbpit->nm_pengambil = $request->nm_pengambil;
        $pengajuanbpit->nobuku_pengambilan = $request->nobuku_pengambilan;
        if ($request->foto_pengambilan) {
            $pengajuanbpit->foto_pengambilan = $id . " foto_pengambilan." . $extension1;
        } else {
            $takelampiran = Pengajuanbpit::where('nim', $id)->first();

            $pengajuanbpit->foto_pengambilan = $takelampiran->foto_pengambilan;
        }
        // dd($request->foto_pengambilan->path());



        $pengajuanbpit->kerja = $request->kerja;
        $pengajuanbpit->jabatan = $request->jabatan;
        $pengajuanbpit->nm_perusahaan = $request->nm_perusahaan;
        $pengajuanbpit->alamat_perusahaan = $request->alamat_perusahaan;
        $pengajuanbpit->jenis_pernjanjiankerja = $request->jenis_pernjanjiankerja;
        $pengajuanbpit->tgl_mulai = $request->tgl_mulai;
        $pengajuanbpit->gaji = $request->gaji;
        $pengajuanbpit->email_perusahaan = $request->email_perusahaan;
        $pengajuanbpit->notelp_perusahaan = $request->notelp_perusahaan;
        $pengajuanbpit->pernyataan = $request->pernyataann;
        $pengajuanbpit->keterangan = $request->keterangan;
        $pengajuanbpit->alasan = $request->alasan;

        $pengajuanbpit->id_user = $request->created_by;
        $pengajuanbpit->created_date = now();

        $pengajuanbpit->save();
        $pengajuanbpit->transwfbpit()->save($transwfbpit);

        // $notif = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Unggah bukti pengambilan ijazah dan transkip nilai berhasil dilakukan');
    }

    public function legalisasi()
    {
        // return view('mahasiswa.legalisasi');
        $data = Legalisasi::with('user', 'transwflegalisasi', 'transwflegalisasi.wfr')->where('id_user', auth()->id())->get();
        return view('mahasiswa/legalisasi', compact('data'));
    }
    public function legalisasistore(Request $request)
    {

        $datas = Legalisasi::with('user', 'transwflegalisasi', 'transwflegalisasi.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nama' => 'required',
                'nim' => 'required',
                'jurusan' => 'required',
                'nohp' => 'required',
                'jenisdok' => 'required',
                // 'file_asli' => 'required',
                // 'file_fotocopy' => 'required',
                'jumlah' => 'required',
            ]);

        $id = $request->nim;
        if ($request->file_asli) {
            $lastName = 'file_asli';
            $dirSave = 'legalisasi';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->file_asli);
            $extension1 = $request->file_asli->extension();

            // $request->file_asli->storeAs('/public/legalisasi', $id . " file_asli." . $extension1);

            // $url1 = Storage::url($id . " file_asli." . $extension1);
        }
        if ($request->file_fotocopy) {
            $lastName = 'file_fotocopy';
            $dirSave = 'legalisasi';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->file_fotocopy);
            $extension2 = $request->file_fotocopy->extension();

            // $request->file_fotocopy->storeAs('/public/legalisasi', $id . " file_fotocopy." . $extension2);

            // $url2 = Storage::url($id . " file_fotocopy." . $extension2);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwflegalisasi = new TransWFlegalisasi();
        $transwflegalisasi->history = $history;
        $legalisasi = new Legalisasi();
        $legalisasi->email = $request->email;
        $legalisasi->nama = $request->nama;
        $legalisasi->nohp = $request->nohp;
        $legalisasi->nim = $request->nim;
        $legalisasi->jurusan = $request->jurusan;
        $legalisasi->jenis_surat = $request->jenis_surat;
        $legalisasi->jenisdok = $request->jenisdok;
        if ($request->file_asli) {
            $legalisasi->file_asli = $id . " file_asli." . $extension1;
        }
        if ($request->file_fotocopy) {
            $legalisasi->file_fotocopy = $id . " file_fotocopy." . $extension2;
        } else {
            $takelampiran = Legalisasi::where('nim', $id)->first();

            $legalisasi->file_asli = $takelampiran->file_asli;
            $legalisasi->file_fotocopy = $takelampiran->file_fotocopy;
        }
        $legalisasi->jumlah = $request->jumlah;
        $legalisasi->id_user = $request->created_by;
        $legalisasi->created_date = now();

        $legalisasi->save();
        $legalisasi->transwflegalisasi()->save($transwflegalisasi);

        // $notif = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Pengajuan legalisasi berhasil!');
    }

    public function pengajuanpskta()
    {
        // return view('mahasiswa.pengajuanpskta');
        $data = Pengajuanpskta::with('user', 'transwfpskta', 'transwfpskta.wfr')->where('id_user', auth()->id())->get();
        return view('mahasiswa/pengajuanpskta', compact('data'));
    }
    public function pengajuanpsktastore(Request $request)
    {

        $datas = Pengajuanpskta::with('user', 'transwfpskta', 'transwfpskta.wfr')->get();
        foreach ($datas as $data)

            $request->validate([
                'email' => 'required',
                'nama' => 'required',
                'nohp' => 'required',
                'nim' => 'required',
                'jurusan' => 'required',
                'tgl_pengajuan' => 'required',
                'nm_pembimbing1' => 'required',
                'nm_pembimbing2' => 'required',
                'ba_up' => 'required',
            ]);

        $id = $request->nim;
        if ($request->ba_up) {
            $lastName = 'ba_up';
            $dirSave = 'pskta';
            GoogleDriveHelper::upload($dirSave, $id, $lastName, $request->ba_up);
            $extension1 = $request->ba_up->extension();

            // $request->ba_up->storeAs('/public/legalisasi', $id . " ba_up." . $extension1);

            // $url1 = Storage::url($id . " ba_up." . $extension1);
        }

        $date = date('d/m/Y  G:i:s');
        $array = [
            "Surat Diajukan",
            $date
        ];
        $history = json_encode($array);

        $transwfpskta = new TransWFpskta();
        $transwfpskta->history = $history;
        $pengajuanpskta = new Pengajuanpskta();
        $pengajuanpskta->email = $request->email;
        $pengajuanpskta->nama = $request->nama;
        $pengajuanpskta->nohp = $request->nohp;
        $pengajuanpskta->nim = $request->nim;
        $pengajuanpskta->jurusan = $request->jurusan;
        $pengajuanpskta->jenis_surat = $request->jenis_surat;
        $pengajuanpskta->tgl_pengajuan = $request->tgl_pengajuan;
        $pengajuanpskta->nm_pembimbing1 = $request->nm_pembimbing1;
        $pengajuanpskta->nm_pembimbing2 = $request->nm_pembimbing2;
        if ($request->ba_up) {
            $pengajuanpskta->ba_up = $id . " ba_up." . $extension1;
        } else {
            $takelampiran = Pengajuanpskta::where('nim', $id)->first();

            $pengajuanpskta->ba_up = $takelampiran->ba_up;
        }
        $pengajuanpskta->id_user = $request->created_by;
        $pengajuanpskta->created_date = now();

        $pengajuanpskta->save();
        $pengajuanpskta->transwfpskta()->save($transwfpskta);

        // $notif = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->first();
        // $jumlahnotif = $notif->jumlah + 1;
        // $update = Notifikasi::where('jenis', 'spta')->where('flag', 'Administrator')->update([
        //     'jumlah' => $jumlahnotif,
        // ]);

        return redirect()->route('mahasiswa.beranda')->withToastSuccess('Pengajuan pengajuan perpanjangan sk ta berhasil!');
    }

    public function pengajuanSuratSptatracing($id)
    {
        $data = TransWF::where('pengajuanspta_id', $id)->get();
        return response()->json(array('data' => $data), 200);
    }

    public function pengajuanSuratSemtatracing($id)
    {
        $data = TransWFsemta::where('pengajuansemta_id', $id)->get();
        return response()->json(array('data' => $data), 200);
    }

    public function pengajuanSuratStatracing($id)
    {
        $data = TransWFsta::where('pengajuansta_id', $id)->get();
        return response()->json(array('data' => $data), 200);
    }

    public function pengajuanSuratSkptracing($id)
    {
        $data = TransWFskp::where('pengajuanskp_id', $id)->get();
        return response()->json(array('data' => $data), 200);
    }

    public function pengajuanSuratPskkptracing($id)
    {
        $data = TransWFpskkp::where('pengajuanpskkp_id', $id)->get();
        return response()->json(array('data' => $data), 200);
    }

    public function pengajuanSuratPptakptracing($id)
    {
        $data = TransWFpptakp::where('pengajuanpptakp_id', $id)->get();
        return response()->json(array('data' => $data), 200);
    }

    public function pengajuanLegalisasitracing($id)
    {
        $data = TransWFlegalisasi::where('legalisasi_id', $id)->get();
        return response()->json(array('data' => $data), 200);
    }

    public function pengajuanSuratPsktatracing($id)
    {
        $data = TransWFpskta::where('pengajuanpskta_id', $id)->get();
        return response()->json(array('data' => $data), 200);
    }

}
