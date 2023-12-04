<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 1,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

        User::create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 2,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

        User::create([
            'name' => 'Lala',
            'email' => 'lala@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

        User::create([
            'name' => 'Putri Septia Amalia',
            'email' => 'putri@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

        User::create([
            'name' => 'Adliani Awalia Nopebrian',
            'email' => 'adliani@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

        User::create([
            'name' => 'Hedy Sholihat Ruhaedi',
            'email' => 'hedy@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

        User::create([
            'name' => 'Popy Anisa',
            'email' => 'popy@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

        User::create([
            'name' => 'Irgi Arya',
            'email' => 'irgi@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

        User::create([
            'name' => 'Hamzah Ahmad Maulana',
            'email' => 'hamzah@gmail.com',
            'password' => bcrypt('11111111'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s', time()), 
            'updated_at' =>  date('Y-m-d H:i:s', time())
        ]);

    }
}