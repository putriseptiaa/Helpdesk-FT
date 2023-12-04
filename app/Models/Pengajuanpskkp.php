<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuanpskkp extends Model
{
    use HasFactory;

    protected $table = 'pengajuanpskkp';

    protected $primaryKey = 'id';

    protected $dates = ['created_date'];


    protected $guarded = [];

    protected $fillable = [
        'created_by',
        'created_date',
        'current_wp',
        'id_user',
        'pmagang' 
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transwfpskkp(){
        return $this->hasMany(TransWFpskkp::class);
    }
}
