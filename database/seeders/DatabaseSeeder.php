<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\KategoriSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            KategoriSeeder::class
        ];
       
        $this->call($data);
        DB::table('users')->insert([
            'is_admin' => 1,
            'nama_lengkap' => 'Muammar Irfan',
            'username' => 'adm123',
            'password' => Hash::make('admin12345')
        ]);
    }
}
