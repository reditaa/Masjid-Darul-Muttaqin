<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SipintuApiService;

class CheckSipintuConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sipintu:check-connection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Periksa status koneksi dan validasi kredensial API SiPintu Gateway';

    /**
     * Execute the console command.
     */
    public function handle(SipintuApiService $sipintuService)
    {
        $this->info('=== Memeriksa Integrasi API SiPintu Gateway ===');
        $this->line('Base URL      : ' . config('services.sipintu.base_url'));
        $this->line('Client ID     : ' . config('services.sipintu.client_id'));
        $this->line('Client Secret : ' . substr(config('services.sipintu.client_secret'), 0, 6) . '****************');
        $this->newLine();

        $this->info('1. Mengirim Heartbeat / Ping Check...');
        $pingResult = $sipintuService->ping();

        if ($pingResult['success']) {
            $this->info('   [OK] Ping Berhasil! Response:');
            $this->line('   ' . json_encode($pingResult['data'], JSON_PRETTY_PRINT));
        } else {
            $this->warn('   [FAIL] Ping Gagal / Server offline. Detail error: ' . ($pingResult['error'] ?? json_encode($pingResult['data'])));
        }

        $this->newLine();
        $this->info('2. Memvalidasi Kredensial Client...');
        $validateResult = $sipintuService->validateClient();

        if ($validateResult['success']) {
            $this->info('   [OK] Validasi Kredensial Berhasil! Response:');
            $this->line('   ' . json_encode($validateResult['data'], JSON_PRETTY_PRINT));
        } else {
            $this->warn('   [FAIL] Validasi Kredensial Gagal. Detail error: ' . ($validateResult['error'] ?? json_encode($validateResult['data'])));
        }

        $this->newLine();
        $this->info('=== Selesai ===');
        return Command::SUCCESS;
    }
}
