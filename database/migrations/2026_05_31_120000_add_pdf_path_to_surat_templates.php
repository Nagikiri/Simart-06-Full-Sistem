<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_templates', function (Blueprint $table) {
            if (! Schema::hasColumn('surat_templates', 'file_path')) {
                $table->string('file_path')->nullable()->after('content');
            }
            if (! Schema::hasColumn('surat_templates', 'file_name')) {
                $table->string('file_name')->nullable()->after('file_path');
            }
        });

        Schema::table('pengajuan', function (Blueprint $table) {
            if (! Schema::hasColumn('pengajuan', 'id_template')) {
                $table->unsignedBigInteger('id_template')->nullable()->after('jenis_surat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surat_templates', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'file_name']);
        });

        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn('id_template');
        });
    }
};
