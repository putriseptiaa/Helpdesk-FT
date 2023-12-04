<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legalisasi extends Model
{
    use HasFactory;

    protected $table = 'legalisasi';

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

    public function transwflegalisasi(){
        return $this->hasMany(TransWFlegalisasi::class);
    }
}
