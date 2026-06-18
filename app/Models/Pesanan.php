<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanans';

    protected $fillable = [
        'pelanggan_id',
        'type',
        'quantity',
        'start_date',
        'deadline',
        'price',
        'status',
        'progress',
        'notes',
        'photo_reference',
        'l_badan',
        'l_pinggang',
        'l_punggung',
        'p_bahu',
        'p_lengan',
        'l_lengan',
        't_susu',
        't_pinggang',
        'l_pinggul',
        'p_baju',
        'p_rok',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function riwayatStatus(): HasMany
    {
        return $this->hasMany(RiwayatStatus::class, 'pesanan_id');
    }
}
