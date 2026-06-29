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
        Schema::create('surat', function (Blueprint $table) {
            $table->id('id_surat');

            $table->foreignId('id_pengajuan')
                ->constrained('pengajuan', 'id_pengajuan')
                ->cascadeOnDelete();

            $table->string('nomor_surat');
            $table->date('tanggal_terbit');
            $table->string('file_surat')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
