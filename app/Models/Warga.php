<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'id_warga';

    protected $fillable = [
        'nama',
        'nama_panggilan',
        'no_hp',
        'email',
        'password',
        'role',
        'gender',
        'alamat',
        'foto_profil',
        'tanda_tangan',
    ];

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_warga');
    }
}
