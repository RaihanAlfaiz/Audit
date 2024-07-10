<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ["id" => "AD", "title" => "Admin"],
            ["id" => "ME", "title" => "Moon Event"],
            ["id" => "EE", "title" => "Engagement and enrollment"],
            ["id" => "BW", "title" => "Bu Widia"],
            ["id" => "BM", "title" => "Building Managment"],
        ];
        foreach ($data as $x) {
            if (!Role::where('id', $x['id'])->first()) {
                $m = new Role();
                $m->id = $x['id'];
                $m->title = $x['title'];
                $m->save();
            }
        }
    }
}
