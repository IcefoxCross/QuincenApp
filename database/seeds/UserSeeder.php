<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('users')->insert([
            'name' => 'usuario',
            'email' => 'user@mail.com',
            'password' => 'pass123',
        ]);
    }
}
