<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Map;
use App\Models\rak;
use App\Models\Ruang;
use App\Models\Urut;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         for ($i = 1; $i <= 5; $i++) {
            rak::create([
                'rak' => 'RK' . str_pad($i, 3, '0', STR_PAD_LEFT),
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            Ruang::create([
                'ruang' => 'RG' . str_pad($i, 3, '0', STR_PAD_LEFT),
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            Map::create([
                'map' => 'M' . str_pad($i, 3, '0', STR_PAD_LEFT),
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            Box::create([
                'box' => 'B' . str_pad($i, 3, '0', STR_PAD_LEFT),
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            Urut::create([
                'urut' =>str_pad($i, 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
