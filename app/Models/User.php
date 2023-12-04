<?php
 
namespace App\Models;
 
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
 
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'photo'
    ];
 
    protected $hidden = [
        'password',
        'remember_token',
    ];
 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["user", "admin", "administrator"][$value],
        );
    }

    public function transwf(){
        return $this->hasMany(TransWF::class);
    }

    public function transwfsemta(){
        return $this->hasMany(TransWFsemta::class);
    }

    public function berita(){
        return $this->hasMany(Berita::class);
    }

    public function pengajuanspta(){
        return $this->hasMany(Pengajuanspta::class);
    }

    public function pengajuansemta(){
        return $this->hasMany(Pengajuansemta::class);
    }

    public function pengajuansta(){
        return $this->hasMany(Pengajuansta::class);
    }

    public function pengajuanskp(){
        return $this->hasMany(Pengajuanskp::class);
    }

    public function pengajuanpskkp(){
        return $this->hasMany(Pengajuanpskkp::class);
    }

    public function pengajuanpskta(){
        return $this->hasMany(Pengajuanpskta::class);
    }

    public function pengajuanpptakp(){
        return $this->hasMany(Pengajuanpptakp::class);
    }

    public function pengajuanbpit(){
        return $this->hasMany(Pengajuanbpit::class);
    }

    public function pengajuanulkp(){
        return $this->hasMany(Pengajuanulkp::class);
    }

    public function pengajuanulta(){
        return $this->hasMany(Pengajuanulta::class);
    }

    public function legalisasi(){
        return $this->hasMany(Legalisasi::class);
    }
}