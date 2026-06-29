<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengajuan>
 */
class PengajuanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statusOptions = ['pending', 'diproses', 'selesai', 'ditolak'];
        $suratOptions = [
            'surat_domisili',
            'surat_kematian',
            'surat_kelahiran',
            'surat_belum_menikah',
            'surat_nikah',
            'surat_cerai',
        ];

        return [
            'jenis_surat' => fake()->randomElement($suratOptions),
            'tanggal_pengajuan' => fake()->dateTimeThisMonth(),
            'status' => fake()->randomElement($statusOptions),
            'file_dokumen' => null,
            'catatan' => null,
        ];
    }
}
