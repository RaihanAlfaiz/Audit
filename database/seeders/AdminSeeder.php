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
        if (!User::where('name', 'Admin Auditorium')->first()) {
            User::create([
                'name' => 'Admin Auditorium',
                'email' => 'adminauditorium@jgu.ac.id',
                'status' => 'accepted',
                'password' => bcrypt('adminauditoriumjgu2024'),
            ]);
        }
    }
}
