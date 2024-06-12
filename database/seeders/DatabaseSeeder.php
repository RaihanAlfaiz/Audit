<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Package::factory()->create([
            'id' => '1',
            'Name' => 'FASILITAS AULA/AUDITORIUM PAKET A',
            'service' => '<ul><li>Gladi bersih&nbsp;</li><li>Sampah&nbsp;</li><li>Perizinan Keramaian&nbsp;</li></ul>',
            'item' => '<ul><li>1 (satu) Ruang Auditorium Kapasitas 1000 Orang&nbsp;</li><li>Podium Mimbar Bacdrop 3 set</li><li>800 Kursi Merah&nbsp;</li><li>Meja panjang + taplak batik 12 set&nbsp;</li><li>Sofa VIP 16 orang +8 Meja VIP&nbsp;</li><li>Sound System + 10 chanel mic/input&nbsp;</li><li>Partisi 20 PCS&nbsp;</li></ul>',
            'price' => '24750000.00',
            'type' => 'EE',
        ]);
        \App\Models\Package::factory()->create([
            'id' => '2',
            'Name' => 'FASILITAS AULA/AUDITORIUM PAKET B',
            'service' => '<ul><li>Gladi bersih&nbsp;</li><li>Sampah&nbsp;</li><li>Perizinan Keramaian&nbsp;</li></ul><div><br></div>',
            'item' => '<ul><li>1 (satu) Ruang Auditorium Kapasitas 1000 Orang&nbsp;</li><li>Lecture Theatre (Ruang Rias-1 ruangan)&nbsp;</li><li>Podium Mimbar + Bacdrap 3 set&nbsp;</li><li>800 Kursi Merah&nbsp;</li><li>Meja panjang + taplak batik 12 Set&nbsp;</li><li>Sofa VIP 16 orang + 8 Meja VIP&nbsp;</li><li>Sound System + 10 cha nel mic/input&nbsp;</li><li>Partisi 20 PCS&nbsp;</li></ul><div><br></div>',
            'price' => '28500000.00',
            'type' => 'EE',
        ]);
    }
}
