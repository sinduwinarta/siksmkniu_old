<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    protected $table = 'sektors';
    protected $primaryKey = 'id_sektor';
    protected $fillable = [
        'nama_sektor'
    ];

    public function surats()
    {
       return $this->hasMany(Surat::class);
    }
}
