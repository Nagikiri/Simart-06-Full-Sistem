<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTemplate extends Model
{
    protected $fillable = [
        'jenis_surat',
        'nama_surat',
        'content',
        'file_path',
        'file_name',
    ];

    public function hasPdf(): bool
    {
        return ! empty($this->file_path);
    }
}
