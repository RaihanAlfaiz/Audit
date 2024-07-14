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
        if (!User::where('username', 'admin_auditorium')->first()) {
            User::create([
                'name' => 'Admin Auditorium',
                'username' => 'Admin Auditorium',
                'email' => 'adminauditorium@jgu.ac.id',
                'password' => bcrypt('adminauditoriumjgu2024'),
            ]);
        }
    }
}
