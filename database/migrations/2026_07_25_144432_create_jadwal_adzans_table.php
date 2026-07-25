public function up(): void
{
    Schema::create('jadwal_adzans', function (Blueprint $table) {
        $table->id();

        $table->date('tanggal');

        $table->enum('waktu', [
            'Dzuhur',
            'Ashar'
        ]);

        $table->string('muadzin');
        $table->string('imam');

        $table->text('keterangan')->nullable();

        $table->timestamps();
    });
}