<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id_pengajuan';

    protected $fillable = [
        'id_warga',
        'id_template',
        'jenis_surat',
        'konten_surat',
        'tanggal_pengajuan',
        'status',
        'file_dokumen',
        'catatan',
        'data_tambahan',
    ];

    protected $casts = [
        'data_tambahan' => 'array',
    ];

    public function template()
    {
        return $this->belongsTo(SuratTemplate::class, 'id_template');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga');
    }

    public function surat()
    {
        return $this->hasOne(Surat::class, 'id_pengajuan');
    }

    /**
     * Generate timeline steps based on pengajuan status
     */
    public function getTimelineSteps()
    {
        $steps = [
            [
                'label' => 'Diajukan',
                'description' => 'Data telah diterima sistem',
                'timestamp' => $this->created_at,
                'status' => 'completed'
            ],
            [
                'label' => 'Diverifikasi Admin',
                'description' => 'Kelengkapan berkas terverifikasi',
                'timestamp' => null,
                'status' => 'pending'
            ],
            [
                'label' => 'Disetujui Ketua RT',
                'description' => 'Menunggu tanda tangan Ketua RT',
                'timestamp' => null,
                'status' => 'pending'
            ],
            [
                'label' => 'Siap Diambil',
                'description' => 'Dokumen dapat diunduh atau diambil',
                'timestamp' => null,
                'status' => 'pending'
            ]
        ];

        // Update step status based on pengajuan status
        switch ($this->status) {
            case 'pending':
                $steps[0]['status'] = 'completed';
                $steps[1]['status'] = 'pending';
                $steps[2]['status'] = 'pending';
                $steps[3]['status'] = 'pending';
                break;
            case 'diproses':
                $steps[0]['status'] = 'completed';
                $steps[1]['status'] = 'active';
                $steps[1]['timestamp'] = $this->updated_at;
                $steps[2]['status'] = 'pending';
                $steps[3]['status'] = 'pending';
                $steps[1]['description'] = 'Sedang diverifikasi oleh admin';
                break;
            case 'disetujui':
                $steps[0]['status'] = 'completed';
                $steps[1]['status'] = 'completed';
                $steps[1]['timestamp'] = $this->updated_at;
                $steps[2]['status'] = 'active';
                $steps[2]['timestamp'] = $this->updated_at;
                $steps[3]['status'] = 'pending';
                $steps[2]['description'] = 'Sedang menunggu tanda tangan Ketua RT';
                break;
            case 'selesai':
                $steps[0]['status'] = 'completed';
                $steps[1]['status'] = 'completed';
                $steps[2]['status'] = 'completed';
                $steps[3]['status'] = 'completed';
                $steps[3]['timestamp'] = $this->surat?->created_at ?? $this->updated_at;
                $steps[2]['timestamp'] = $this->updated_at;
                $steps[1]['timestamp'] = $this->updated_at;
                break;
            case 'ditolak':
                $steps[0]['status'] = 'completed';
                $steps[1]['status'] = 'rejected';
                $steps[1]['timestamp'] = $this->updated_at;
                $steps[1]['description'] = 'Pengajuan ditolak: ' . ($this->catatan ?? 'Tidak memenuhi persyaratan');
                $steps[2]['status'] = 'pending';
                $steps[3]['status'] = 'pending';
                break;
        }

        return $steps;
    }
}