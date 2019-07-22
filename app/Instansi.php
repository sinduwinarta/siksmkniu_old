<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansis';
    protected $primaryKey = 'id_instansi';
    protected $fillable = [
        'nama_instansi'
    ];

    public function surats()
    {
       return $this->hasMany(Surat::class);
    }
}
