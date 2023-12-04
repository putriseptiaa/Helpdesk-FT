<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $primaryKey = 'id';

    protected $fillable = ['jumlah'];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
