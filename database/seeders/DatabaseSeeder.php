<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'nip' => 'admin',
            'name' => 'Admin',
            'level' => 'admin',
            'password' =>Hash::make('123')
        ]);
        User::create([
            'nip' => '19650024',
            'name' => 'Moh Alfin',
            'password' =>Hash::make('123')
        ]);

        User::create([
            'nip' => '19650026',
            'name' => 'Andy Kustiawan',
            'password' =>Hash::make('123')
        ]);
        User::create([
            'nip' => '19650012',
            'name' => 'Risky Abdul',
            'password' =>Hash::make('123')
        ]);
        User::create([
            'nip' => '19650117',
            'name' => 'Deri Fauzi',
            'password' =>Hash::make('123')
        ]);
        User::create([
            'nip' => '19650204',
            'name' => 'Muhammad Zulfan',
            'password' =>Hash::make('123')
        ]);

        $this->call([
            MasterSeeder::class,
            DokumenSeeder::class
        ]);
    }
}
