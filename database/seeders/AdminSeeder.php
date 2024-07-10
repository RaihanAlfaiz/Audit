<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (!User::where('username', 'admin')->first()) {
            User::create([
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'no-reply@jgu.ac.id',
                'password' => bcrypt('adminadmin'),
            ]);
        }
    }
}
