<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuanskp extends Model
{
    use HasFactory;

    protected $table = 'pengajuanskp';

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

    public function transwfskp(){
        return $this->hasMany(TransWFskp::class);
    }
}
