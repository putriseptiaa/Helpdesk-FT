<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuansta extends Model
{
    use HasFactory;

    protected $table = 'pengajuansta';

    protected $primaryKey = 'id';
    
    protected $dates = ['created_date'];


    protected $guarded = [];


    protected $fillable = [
        'email',
        'nama',
        'nohp',
        'nim',
        'jurusan',
        'tgl_pengajuan',
        'nm_pembimbing1',
        'nm_pembimbing2',
        'upper_ta',
        'for_ta',
        'upper_pembimbing1',
        'upper_pembimbing2',
        'sk_pembimbingta',
        'transkip',
        'buksum_artikel',
        'lembar_revisi_seminar',
        'draft_ta',
        'bukbayar_ukt',
        'tes_telp',
        'cek_plagiat',
        'kerja',
        'jabatan',
        'nm_perusahaan',
        'alamat_perusahaan',
        'jenis_perjanjiankerja',
        'tgl_mulai',
        'gaji',
        'email_perusahaan',
        'notelp_perusahaan',
        'pernyataan',
            'created_by',
            'created_date',
            'current_wp',
            'id_user' 

    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transwfsta(){
        return $this->hasMany(TransWFsta::class);
    }
}
