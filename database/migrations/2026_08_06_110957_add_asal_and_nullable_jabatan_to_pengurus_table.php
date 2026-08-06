<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            // Kategori asal pengurus: Guru, Siswa, atau Umum
            $table->enum('asal', ['guru', 'siswa', 'umum'])
                ->nullable()
                ->after('jabatan_id');
        });

        Schema::table('pengurus', function (Blueprint $table) {
            // Lepas dulu foreign key lama supaya bisa diubah jadi nullable
            $table->dropForeign(['jabatan_id']);
        });

        Schema::table('pengurus', function (Blueprint $table) {
            $table->foreignId('jabatan_id')
                ->nullable()
                ->change();

            $table->foreign('jabatan_id')
                ->references('id')->on('jabatans')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {
            $table->dropColumn('asal');
            $table->dropForeign(['jabatan_id']);
        });

        Schema::table('pengurus', function (Blueprint $table) {
            $table->foreignId('jabatan_id')
                ->nullable(false)
                ->change();

            $table->foreign('jabatan_id')
                ->references('id')->on('jabatans')
                ->cascadeOnDelete();
        });
    }
};