<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 

class Pengajuansemta extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pengajuansemta';

    protected $primaryKey = 'id';

    protected $dates = ['created_date'];


    protected $guarded = [];

    protected $fillable = [
        'created_by',
        'created_date',
        'current_wp',
        'user_id' 
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transwfsemta(){
        return $this->hasMany(TransWFsemta::class);
    }
}
