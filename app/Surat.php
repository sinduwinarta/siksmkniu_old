<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surats';
    protected $primaryKey = 'id_surat';
    protected $fillable = [
        'no_surat', 'perihal_surat', 'tanggal_surat', 'id_sektor', 'id_instansi', 'id_admin'
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function sektor()
    {
        return $this->belongsTo(Sektor::class, 'id_sektor');
    }

    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'id_disposisi');
    }

    public function dokumens()
    {
       return $this->hasMany(Dokumen::class);
    }
}
