<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'gambar',
        'judul_berita',
        'detail_berita',
        'tanggal_post',
        'created_by'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

