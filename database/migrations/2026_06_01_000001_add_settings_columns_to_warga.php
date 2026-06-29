<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            if (!Schema::hasColumn('warga', 'alamat')) {
                $table->string('alamat')->nullable()->after('role');
            }
            if (!Schema::hasColumn('warga', 'foto_profil')) {
                $table->string('foto_profil')->nullable()->after('alamat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('warga', function (Blueprint $table) {
            $table->dropColumn(['alamat', 'foto_profil']);
        });
    }
};
