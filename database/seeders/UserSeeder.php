<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Dennisse',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'telp' => '0821211121',
                'alamat' => 'Singosari',
                'status' => 'aktif',
            ],
            [
                'name' => 'Marcell',
                'username' => 'penjual',
                'email' => 'agenn@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'penjual',
                'telp' => '230982480',
                'alamat' => 'Lawang',
                'status' => 'aktif',
            ],
            [
                'name' => 'Yanuardy',
                'username' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'telp' => '0283402049',
                'alamat' => 'Malang',
                'status' => 'aktif',
            ],



        ]);
    }
}
