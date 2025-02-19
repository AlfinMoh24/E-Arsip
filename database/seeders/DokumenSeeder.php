<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    public function run()
    {
        $dokumens = [];

        for ($i = 1; $i <= 10; $i++) {
            $kode_dok = 'DK' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $dokumens[] = [
                'no_dok'    => $kode_dok,
                'kode_dok'  => $kode_dok,
                'nama_dok'  => 'Dokumen ' . $i,
                'rak_id'    => rand(1, 5),
                'ruang_id'    => rand(1, 5),
                'map_id'    => rand(1, 5),
                'box_id'    => rand(1, 5),
                'urut_id'    => rand(1, 5),
                'file'      => 'dokumen_' . $i . '.pdf',
                'ukuran'    => rand(100, 500) . ' KB',
                'deskripsi' => 'Deskripsi dokumen ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('dokumens')->insert($dokumens);
    }
}
