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
            // Add role column if it doesn't exist
            if (!Schema::hasColumn('warga', 'role')) {
                $table->enum('role', ['warga', 'rt'])->default('warga')->after('password');
            }
            // Add catatan column for RT notes
            if (!Schema::hasColumn('warga', 'catatan')) {
                $table->text('catatan')->nullable()->after('role');
            }
        });

        Schema::table('pengajuan', function (Blueprint $table) {
            // Add catatan column for rejection reason
            if (!Schema::hasColumn('pengajuan', 'catatan')) {
                $table->text('catatan')->nullable()->after('file_dokumen');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->dropColumn(['role', 'catatan']);
        });

        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
    }
};
