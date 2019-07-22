<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $table = 'disposisis';
    protected $primaryKey = 'id_disposisi';
    protected $fillable = [
        'tanggal_disposisi', 'pesan_disposisi', 'status_disposisi', 'id_pimpinan', 'id_staf', 'id_surat'
    ];

    public function pimpinan()
    {
        return $this->belongsTo(Pimpinan::class, 'id_pimpinan');
    }

    public function staf()
    {
        return $this->belongsTo(Staf::class, 'id_staf');
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }
}

