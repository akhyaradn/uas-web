<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        DB::table('users')->insert([
            'uuid' => 'bd8e22ef-3e1c-425f-877a-47f8b1afc160',
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'is_admin' => 1,
            'address' => 'Malang',
            'created_at' => '2023-01-26 12:30:40',
            'updated_at' => '2023-01-26 12:30:40',
            'phone_number' => '0813345666',
        ]);
    }
}
