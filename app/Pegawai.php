<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';
    protected $primaryKey = 'id_pegawai';
    protected $fillable = [
        'foto_pegawai', 'nama_pegawai', 'nip', 'no_telp_pegawai', 'email_pegawai', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jabatanable(){
        return $this->morphTo();
    }
}
