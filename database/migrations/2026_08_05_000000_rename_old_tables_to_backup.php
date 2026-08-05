<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'gurus',
        'siswas',
        'anggotas',
        'jadwal_adzans',
        'jadwal_imams',
        'jadwal_jumats',
        'jadwal_pikets',
        'pengurus',
        'pengumuman',
    ];

    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && ! Schema::hasTable($table . '_old')) {
                Schema::rename($table, $table . '_old');
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $table) {
            if (Schema::hasTable($table . '_old') && ! Schema::hasTable($table)) {
                Schema::rename($table . '_old', $table);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};