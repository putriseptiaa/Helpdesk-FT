<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 

class Pengajuanspta extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $primaryKey = 'id';

    protected $table = 'pengajuanspta';

    protected $primaryKey = 'id';

    protected $dates = ['created_date'];

    protected $guarded = [];
    
    // protected $fillable = [
    //     'email',
    //     'nama',
    //     'nohp',
    //     'nim',
    //     'jurusan',
    //     'jenis_surat',
    //     'tgl_pengajuan',
    //     'nm_pembimbing1',
    //     'nm_pembimbing2',
    //     'judul_prota',
    //     'berkas_penelitian',
    //     'transkip',
    //     'bukti_lapkp',
    //     'up_ombus',
    //     'up_pbn',
    //     'created_by',
    //     'created_date',
    //     'current_wp',
    //     'user_id' 
    // ];

    // protected $hidden = [
    //     'id',
    //     'created_at',
    //     'updated_at'
    // ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transwf(){
        return $this->hasMany(TransWF::class);
    }
}
