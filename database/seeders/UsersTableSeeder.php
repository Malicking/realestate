<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'name' => 'MalickRoi',
                'username' => 'malickroi',
                'email' => 'worldpython3@gmail.com',
                'password' => Hash::make('test'),
                'role' => 'admin',
                'status' => 'active',
                'created_at' => Carbon::now()
            ],

            // Agent
            [
                'name' => 'Agent One',
                'username' => 'agent_one',
                'email' => 'user2.malickroi@gmail.com',
                'password' => Hash::make('test'),
                'role' => 'agent',
                'status' => 'active',
                'created_at' => Carbon::now()
            ],

            // User
            [
                'name' => 'User One',
                'username' => 'user_one',
                'email' => 'user3.malickroi@gmail.com',
                'password' => Hash::make('test'),
                'role' => 'user',
                'status' => 'active',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
