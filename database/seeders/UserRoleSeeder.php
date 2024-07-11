<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ["user_id" => "1", "role_id" => "AD"],
            ["user_id" => "1", "role_id" => "EE"],
            ["user_id" => "1", "role_id" => "ME"],
            ["user_id" => "1", "role_id" => "BW"],
            ["user_id" => "1", "role_id" => "BM"],
        ];

        foreach ($data as $x) {
            if (!UserRole::where('user_id', $x['user_id'])
                ->where('role_id', $x['role_id'])->first()) {
                $m = new UserRole();
                $m->user_id = $x['user_id'];
                $m->role_id = $x['role_id'];
                $m->save();
            }
        }
    }
}
