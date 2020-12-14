<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'admin@admin.com',
            'password' => Hash::make('viernes13')
        ]);
        DB::table('users')->insert([
            'name' => 'usuario prueba',
            'email' => 'prueba@prueba.com',
            'password' => Hash::make('viernes13')
        ]);
    }
}
