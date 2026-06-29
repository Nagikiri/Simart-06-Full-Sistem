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
        Schema::table('warga', function (Blueprint $table) {
            // Add gender column if it doesn't exist
            if (!Schema::hasColumn('warga', 'gender')) {
                $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable()->after('no_hp');
            }
            // Add nama_panggilan if not exists
            if (!Schema::hasColumn('warga', 'nama_panggilan')) {
                $table->string('nama_panggilan')->nullable()->after('nama');
            }
            // Add alamat if not exists
            if (!Schema::hasColumn('warga', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_hp');
            }
            // Add foto_profil if not exists
            if (!Schema::hasColumn('warga', 'foto_profil')) {
                $table->string('foto_profil')->nullable()->after('alamat');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->dropColumn(['gender', 'nama_panggilan', 'alamat', 'foto_profil']);
        });
    }
};
