<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVerification extends Model
{
    protected $fillable = [
        'item_id',
        'foto_bukti',
        'no_telp',
        'lokasi_ambil',
        'janji_temu',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
