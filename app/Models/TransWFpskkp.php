<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransWFpskkp extends Model
{

    protected $table = 'transwfpskkp';

    // protected $guarded = [];

    protected $fillable = [
        'pengajuanpskkp_id',
        'wfreference',
        'approved_by',
        'last_updated',
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

    public function wfr()
    {
        return $this->belongsTo(Wfreference::class, 'wfreference', 'id');
    }

    public function pengajuanpskkp()
    {
        return $this->belongsTo(Pengajuanpskkp::class);
    }
}
