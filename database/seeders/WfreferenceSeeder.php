<?php

namespace Database\Seeders;

use App\Models\Wfreference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WfreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wfreference::create([
            'wpname' => 'Surat diajukan',
            'wpnext' => 'Menunggu persetujuan',
            'status' => 'On Progress'
        ]);

        Wfreference::create([
            'wpname' => 'Surat disetujui dan sedang diproses',
            'wpnext' => 'Mohon untuk menunggu proses surat',
            'status' => 'Approved'
        ]);

        Wfreference::create([
            'wpname' => 'Surat Selesai dibuat',
            'wpnext' => 'Untuk mengambil surat yang diajukan dapat mengunjungi Ruangan Pelayanan Fakultas Teknik atau langsung Ke Jurusan masing-masing',
            'status' => 'Success'
        ]);

        Wfreference::create([
            'wpname' => 'Surat ditolak',
            'wpnext' => 'Beberapa data tidak valid!',
            'status' => 'Reject'
        ]);
    }
}
