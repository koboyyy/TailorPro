<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_statuses';

    protected $fillable = [
        'pesanan_id',
        'status',
        'time',
        'author',
        'location',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}
