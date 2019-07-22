<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = 'arsips';
    protected $primaryKey = 'id_arsip';
    protected $fillable = [
    	'id_pimpinan', 'id_surat'
    ];

    public function pimpinan()
    {
        return $this->belongsTo(Pimpinan::class, 'id_pimpinan');
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }
}
