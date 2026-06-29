<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id_surat';

    protected $fillable = [
        'id_pengajuan',
        'nomor_surat',
        'tanggal_terbit',
        'file_surat'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }
}
