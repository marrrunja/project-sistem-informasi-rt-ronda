<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori' => 'Aktivitas Mencurigakan'
            ],
            [
                'kategori' => 'Gangguan Keamanan'
            ],
            [
                'kategori' => 'Kehilangan'
            ],
        ];
        Kategori::insert($data);
    }
}
