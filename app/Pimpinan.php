<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Pegawai
{
    protected $table = 'pimpinans';
    protected $primaryKey = 'id_pimpinan';
    protected $fillable = [
        'id_superadmin'
    ];

    public function superadmin()
    {
        return $this->belongsTo(Superadmin::class, 'id_superadmin');
    }

    public function disposisis()
    {
       return $this->hasMany(Disposisi::class);
    }

    public function arsips()
    {
        return $this->hasMany(Arsip::class);
    }

    //fungsi inherit pegawai
    public function pegawais()
    {
        return $this->morphMany('App\Pegawai', 'jabatanable');
    }

}