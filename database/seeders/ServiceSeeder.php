<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ["id" => "1", "item" => "Ruangan Lecture Theatre", "unit" => "1", "unit_name" => "Ruangan", "price" => "3750000.00"],
            ["id" => "2", "item" => "Proyektor Paket 3x4 M 5000 Lumen", "unit" => "2", "unit_name" => "Set", "price" => "1750000.00"],
            ["id" => "3", "item" => "Kursi Merah", "unit" => "1", "unit_name" => "Buah", "price" => "8000.00"],
            ["id" => "4", "item" => "Panggung Portable (3x2M)", "unit" => "1", "unit_name" => "Buah", "price" => "50000.00"],
            ["id" => "5", "item" => "Panggung Portable (1,5x2M)", "unit" => "1", "unit_name" => "Buah", "price" => "20000.00"],
            ["id" => "6", "item" => "Partisi Merah", "unit" => "1", "unit_name" => "Buah", "price" => "10000.00"],
            ["id" => "7", "item" => "Sofa Single", "unit" => "1", "unit_name" => "Buah", "price" => "30000.00"],
            ["id" => "8", "item" => "Kabel Jack Akai", "unit" => "1", "unit_name" => "Buah", "price" => "20000.00"],
            ["id" => "9", "item" => "Meja Panjang + Taplak", "unit" => "1", "unit_name" => "Buah", "price" => "20000.00"],
            ["id" => "10", "item" => "Over Time Auditroium", "unit" => "1", "unit_name" => "Buah", "price" => "500000.00"],
            ["id" => "11", "item" => "Over Time Lecture Theatre", "unit" => "1", "unit_name" => "Buah", "price" => "200000.00"],
            ["id" => "12", "item" => "Penambahan Kelas", "unit" => "1", "unit_name" => "Buah", "price" => "3000000.00"],

        ];
        foreach ($data as $package) {
            Service::create($package);
        }
    }
}
