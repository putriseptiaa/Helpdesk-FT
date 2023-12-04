<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wfreference extends Model
{

    protected $table = 'wfreference';

    protected $guarded = [];

    public function transwf(){
        return $this->hasMany(TransWF::class);
    }

    public function transwfsemta(){
        return $this->hasMany(TransWFsemta::class);
    }

}
