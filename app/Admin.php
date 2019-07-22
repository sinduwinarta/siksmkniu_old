<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Pegawai
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'id_superadmin'
    ];

    public function superadmin()
    {
        return $this->belongsTo(Superadmin::class, 'id_superadmin');
    }

    public function surats()
    {
       return $this->hasMany(Surat::class);
    }

    //fungsi inherit pegawai
    public function pegawais()
    {
        return $this->morphMany('App\Pegawai', 'jabatanable');
    }

}