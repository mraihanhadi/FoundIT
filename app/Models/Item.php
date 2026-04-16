<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'nama_barang',
        'deskripsi_barang',
        'lokasi',
        'status',
        'tanggal',
        'contact_person',
        'janji_temu',
        'foto',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}