<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_imam_muazin_anggotas', function (Blueprint $table) {
            $table->enum('peran', ['imam', 'muazin'])->default('imam')->after('pengurus_id');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_imam_muazin_anggotas', function (Blueprint $table) {
            $table->dropColumn('peran');
        });
    }
};