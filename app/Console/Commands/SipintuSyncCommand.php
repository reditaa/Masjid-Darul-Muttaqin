<?php

namespace App\Console\Commands;

use App\Models\Pengurus;
use App\Services\SipintuApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SipintuSyncCommand extends Command
{
    protected $signature = 'sipintu:sync';
    protected $description = 'Sinkronkan data Siswa dan Guru dari SiPintu Gateway ke data SIMADI';

    public function handle(SipintuApiService $sipintuService): int
    {
        $this->info('=== Memulai Sinkronisasi Data dari SiPintu Gateway ===');

        $totalSiswaSynced = 0;
        $totalGuruSynced = 0;

        // 1. Sinkronisasi Data Siswa
        $this->info('1. Mengambil data Siswa dari SiPintu...');
        $studentResponse = $sipintuService->getStudents();

        if ($studentResponse['success'] ?? false) {
            $studentsData = $studentResponse['data']['data']['data']
                ?? $studentResponse['data']['data']
                ?? $studentResponse['data']
                ?? [];

            if (is_array($studentsData)) {
                foreach ($studentsData as $student) {
                    $nama = trim($student['nama'] ?? '');
                    if (!$nama) continue;

                    $nik = $student['nis'] ?? $student['nisn'] ?? null;
                    if (!$nik && isset($student['id'])) {
                        $nik = 'SISWA-' . $student['id'];
                    }

                    $email = $student['user']['email'] ?? $student['email'] ?? null;
                    $hp = $student['hp'] ?? $student['no_hp'] ?? null;
                    $alamat = $student['alamat'] ?? null;
                    $jkRaw = $student['jk'] ?? 'L';
                    $jenisKelamin = ($jkRaw == 1 || strtoupper((string)$jkRaw) === 'L') ? 'L' : 'P';

                    $query = Pengurus::query();
                    if ($nik) {
                        $pengurus = $query->where('nik', $nik)->first();
                    } else {
                        $pengurus = null;
                    }

                    if (!$pengurus && $email) {
                        $pengurus = Pengurus::where('email', $email)->first();
                    }

                    if (!$pengurus) {
                        $pengurus = Pengurus::where('nama', $nama)->where('asal', 'siswa')->first();
                    }

                    $dataToUpdate = [
                        'nama'          => $nama,
                        'nik'           => $nik,
                        'asal'          => 'siswa',
                        'jenis_kelamin' => $jenisKelamin,
                        'no_hp'         => $hp,
                        'email'         => $email,
                        'alamat'        => $alamat,
                        'status'        => 'aktif',
                    ];

                    if ($pengurus) {
                        $pengurus->update($dataToUpdate);
                    } else {
                        Pengurus::create($dataToUpdate + ['jabatan_id' => null]);
                    }

                    $totalSiswaSynced++;
                }
                $this->info("   [OK] Berhasil menyinkronkan {$totalSiswaSynced} data siswa.");
            }
        } else {
            $this->error('   [FAIL] Gagal mengambil data siswa: ' . ($studentResponse['error'] ?? 'Unknown error'));
        }

        // 2. Sinkronisasi Data Guru
        $this->info('2. Mengambil data Guru dari SiPintu...');
        $teacherResponse = $sipintuService->getTeachers();

        if ($teacherResponse['success'] ?? false) {
            $teachersData = $teacherResponse['data']['data']['data']
                ?? $teacherResponse['data']['data']
                ?? $teacherResponse['data']
                ?? [];

            if (is_array($teachersData)) {
                foreach ($teachersData as $teacher) {
                    $nama = trim($teacher['nama'] ?? '');
                    if (!$nama) continue;

                    $nik = $teacher['nip'] ?? null;
                    if (!$nik && isset($teacher['id'])) {
                        $nik = 'GURU-' . $teacher['id'];
                    }

                    $email = $teacher['user']['email'] ?? $teacher['email'] ?? null;
                    $hp = $teacher['hp'] ?? $teacher['no_hp'] ?? null;
                    $alamat = $teacher['alamat'] ?? null;
                    $jkRaw = $teacher['jk'] ?? 'L';
                    $jenisKelamin = ($jkRaw == 1 || strtoupper((string)$jkRaw) === 'L') ? 'L' : 'P';

                    $query = Pengurus::query();
                    if ($nik) {
                        $pengurus = $query->where('nik', $nik)->first();
                    } else {
                        $pengurus = null;
                    }

                    if (!$pengurus && $email) {
                        $pengurus = Pengurus::where('email', $email)->first();
                    }

                    if (!$pengurus) {
                        $pengurus = Pengurus::where('nama', $nama)->where('asal', 'guru')->first();
                    }

                    $dataToUpdate = [
                        'nama'          => $nama,
                        'nik'           => $nik,
                        'asal'          => 'guru',
                        'jenis_kelamin' => $jenisKelamin,
                        'no_hp'         => $hp,
                        'email'         => $email,
                        'alamat'        => $alamat,
                        'status'        => 'aktif',
                    ];

                    if ($pengurus) {
                        $pengurus->update($dataToUpdate);
                    } else {
                        Pengurus::create($dataToUpdate + ['jabatan_id' => null]);
                    }

                    $totalGuruSynced++;
                }
                $this->info("   [OK] Berhasil menyinkronkan {$totalGuruSynced} data guru.");
            }
        } else {
            $this->error('   [FAIL] Gagal mengambil data guru: ' . ($teacherResponse['error'] ?? 'Unknown error'));
        }

        $this->info("=== Sinkronisasi Selesai: Total {$totalGuruSynced} Guru & {$totalSiswaSynced} Siswa ===");
        return Command::SUCCESS;
    }
}
