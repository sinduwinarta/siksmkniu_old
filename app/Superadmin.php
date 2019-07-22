<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Superadmin extends Authenticatable
{
    protected $table = 'superadmins';
    protected $primaryKey = 'id_superadmin';
    protected $fillable = [
        'username', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pimpinans()
    {
       return $this->hasMany(Pimpinan::class);
    }

    public function admins()
    {
       return $this->hasMany(Admin::class);
    }
}