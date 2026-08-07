<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_bilals', function (Blueprint $table) {
            $table->dropForeign(['pengurus_id']);
            $table->dropColumn(['tanggal', 'pengurus_id']);

            $table->enum('pasaran', ['legi', 'pahing', 'pon', 'wage', 'kliwon'])
                ->after('id');
        });

        Schema::table('jadwal_bilals', function (Blueprint $table) {
            $table->unique('pasaran');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_bilals', function (Blueprint $table) {
            $table->dropUnique(['pasaran']);
            $table->dropColumn('pasaran');

            $table->date('tanggal')->nullable();
            $table->foreignId('pengurus_id')->nullable()->constrained('pengurus')->cascadeOnDelete();
        });
    }
};