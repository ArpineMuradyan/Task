<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'name' => 'user1',
          'email' => 'user1@gmail.com',
          'password' => Hash::make('123456'),
      ]);
      DB::table('users')->insert([
          'name' => 'user2',
          'email' => 'user2@gmail.com',
          'password' => Hash::make('123456'),
      ]);
      DB::table('users')->insert([
          'name' => 'user3',
          'email' => 'user3@gmail.com',
          'password' => Hash::make('123456'),
      ]);
      DB::table('users')->insert([
          'name' => 'user4',
          'email' => 'user4@gmail.com',
          'password' => Hash::make('123456'),
      ]);
      DB::table('users')->insert([
          'name' => 'user5',
          'email' => 'user5@gmail.com',
          'password' => Hash::make('123456'),
      ]);
    }
}
