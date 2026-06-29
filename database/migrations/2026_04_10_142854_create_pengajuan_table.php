<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id('id_pengajuan');

            $table->foreignId('id_warga')
                ->constrained('warga', 'id_warga')
                ->cascadeOnDelete();

            $table->string('jenis_surat');
            $table->date('tanggal_pengajuan');
            $table->enum('status', ['pending', 'diproses', 'ditolak', 'selesai'])
                ->default('pending');
            $table->string('file_dokumen')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
