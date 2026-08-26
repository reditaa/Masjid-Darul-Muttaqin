<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Enum di MySQL tidak bisa diubah langsung via Schema::table(), jadi pakai raw SQL
        DB::statement("ALTER TABLE jadwal_jumat_anggotas MODIFY peran ENUM('khatib','imam','bilal') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE jadwal_jumat_anggotas MODIFY peran ENUM('khatib','imam') NOT NULL");
    }
};