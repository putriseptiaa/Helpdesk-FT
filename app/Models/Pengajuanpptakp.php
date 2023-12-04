<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuanpptakp extends Model
{
    use HasFactory;

    protected $table = 'pengajuanpptakp';

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transwfpptakp(){
        return $this->hasMany(TransWFpptakp::class);
    }
}
