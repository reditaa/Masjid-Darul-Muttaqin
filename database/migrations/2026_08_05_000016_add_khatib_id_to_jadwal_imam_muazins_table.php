<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_imam_muazins', function (Blueprint $table) {
            $table->foreignId('khatib_id')
                ->nullable()
                ->after('imam_id')
                ->constrained('pengurus')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_imam_muazins', function (Blueprint $table) {
            $table->dropConstrainedForeignId('khatib_id');
        });
    }
};