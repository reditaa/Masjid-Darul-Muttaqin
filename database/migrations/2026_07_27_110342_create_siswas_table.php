<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->string('kelas');
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};