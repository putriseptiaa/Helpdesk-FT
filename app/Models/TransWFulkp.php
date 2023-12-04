<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransWFulkp extends Model
{

    protected $table = 'transwfulkp';

    // protected $guarded = [];

    protected $fillable = [
        'pengajuanulkp_id',
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

    public function pengajuanulkp()
    {
        return $this->belongsTo(Pengajuanulkp::class);
    }
}
