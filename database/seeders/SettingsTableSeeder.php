<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    DB::table('settings')->insert([
        ['key' => 'site_name', 'value' => 'Admin'],
        ['key' => 'site_email', 'value' => 'admin@gmail.com'],
    ]);
    }
}
