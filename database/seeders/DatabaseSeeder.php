<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outlet;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $outlet1 = Outlet::create([
            'kode_outlet'     => 'KP-CMH-01',
            'nama_outlet'     => 'Kopi Senja Cimahi',
            'alamat'          => 'Jl. Amir Machmud No. 45',
            'kota'            => 'Cimahi',
            'no_telepon'      => '081234567890',
            'email'           => 'cimahi@kopisenja.com',
            'nama_manager'    => 'Budi Santoso',
            'jam_buka'        => '08:00:00',
            'jam_tutup'       => '22:00:00',
            'kapasitas_kursi' => 40,
            'status'          => 'buka'
        ]);

        $outlet2 = Outlet::create([
            'kode_outlet'     => 'KP-BDG-02',
            'nama_outlet'     => 'Kopi Senja Braga',
            'alamat'          => 'Jl. Braga No. 88',
            'kota'            => 'Bandung',
            'no_telepon'      => '081298765432',
            'email'           => 'braga@kopisenja.com',
            'nama_manager'    => 'Siti Rahmawati',
            'jam_buka'        => '09:00:00',
            'jam_tutup'       => '23:00:00',
            'kapasitas_kursi' => 65,
            'status'          => 'buka'
        ]);

        Menu::create([
            'outlet_id' => $outlet1->id,
            'nama_menu' => 'Es Kopi Susu Gula Aren',
            'kategori'  => 'coffee',
            'harga'     => 22000,
            'deskripsi' => 'Espresso house blend dengan susu segar dan gula aren asli',
            'tersedia'  => true
        ]);

        Menu::create([
            'outlet_id' => $outlet1->id,
            'nama_menu' => 'Matcha Latte',
            'kategori'  => 'non-coffee',
            'harga'     => 25000,
            'deskripsi' => 'Pure ceremonial matcha dengan susu creamy',
            'tersedia'  => true
        ]);

        Menu::create([
            'outlet_id' => $outlet2->id,
            'nama_menu' => 'Caramel Macchiato',
            'kategori'  => 'coffee',
            'harga'     => 28000,
            'deskripsi' => 'Espresso dengan vanilla syrup, susu steam, dan saus karamel',
            'tersedia'  => true
        ]);

        Menu::create([
            'outlet_id' => $outlet2->id,
            'nama_menu' => 'Croissant Butter',
            'kategori'  => 'snack',
            'harga'     => 20000,
            'deskripsi' => 'Croissant renyah panggang hangat dengan butter Prancis',
            'tersedia'  => true
        ]);
    }
}
