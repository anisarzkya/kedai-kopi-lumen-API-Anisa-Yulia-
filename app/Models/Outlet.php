<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'outlets';

    protected $fillable = [
        'kode_outlet',
        'nama_outlet',
        'alamat',
        'kota',
        'no_telepon',
        'email',
        'nama_manager',
        'jam_buka',
        'jam_tutup',
        'kapasitas_kursi',
        'status'
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d-m-Y H:i:s');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'outlet_id', 'id');
    }
}
