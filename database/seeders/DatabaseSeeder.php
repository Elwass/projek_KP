<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'email' => 'adityap.pratama17@gmail.com',
            'username' => 'aditya',
            'password' => bcrypt('12345'),
            'name' => 'Aditya Pratama',
            'role' => 'peserta',
        ]);
        
        User::create([
            'email' => 'admin@gmail.com',
            'username' => 'gede.aditya',
            'password' => bcrypt('12345'),
            'name' => 'Aditya Pratama',
            'role' => 'admin',
        ]);
    }
}
