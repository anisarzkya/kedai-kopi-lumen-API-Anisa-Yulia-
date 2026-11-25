<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'outlet_id',
        'nama_menu',
        'kategori',
        'harga',
        'deskripsi',
        'tersedia'
    ];

    protected $casts = [
        'tersedia' => 'boolean',
        'harga'    => 'integer',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d-m-Y H:i:s');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'id');
    }
}
