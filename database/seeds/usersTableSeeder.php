<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'nama' => 'aji nurcahyo hidayat',
            'username'  => 'ajihidayat',
            'email' =>'ajihidayat2806@gmail.com',
            'password'  => bcrypt('12345678'),
            'role' => 'admin'
        ]);
    }
}
