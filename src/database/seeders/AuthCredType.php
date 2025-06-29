<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthCredType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('auth_cred_types')->insert([
            ['id' => 1, 'name' => 'google',],
            ['id' => 2, 'name' => 'yandex',],
        ]);
    }
}
