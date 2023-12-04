<?php

namespace App\Models;

use App\Helpers\GoogleDriveHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuanbpit extends Model
{
    use HasFactory;

    protected $table = 'pengajuanbpit';

    protected $primaryKey = 'id';

    protected $dates = ['created_date'];

    protected $guarded = [];

    protected $fillable = [
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transwfbpit()
    {
        return $this->hasMany(TransWFbpit::class);
    }

    public function download($fileName)
    {
        GoogleDriveHelper::download();
    }
}
