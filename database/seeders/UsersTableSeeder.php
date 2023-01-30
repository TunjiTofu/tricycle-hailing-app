<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            //Admin
            [
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('111'),
                'surname' => 'System',
                'other_name' => 'Admin',
                'sex' => 'male',
                'dob' => '11/11/11',
                'phone' => '+23489443534',
                'role' => 'admin',
                'status' => 'active',
            ],
            //Riders
            [
                'username' => 'Rider',
                'email' => 'rider@gmail.com',
                'password' => Hash::make('111'),
                'surname' => 'System',
                'other_name' => 'Rider',
                'sex' => 'male',
                'dob' => '11/11/11',
                'phone' => '+23489443534',
                'role' => 'rider',
                'status' => 'active',
            ],
            //Users
            [
                'username' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('111'),
                'surname' => 'System',
                'other_name' => 'User',
                'sex' => 'male',
                'dob' => '11/11/11',
                'phone' => '+23489443534',
                'role' => 'user',
                'status' => 'active',
            ]
        ]);
    }
}
