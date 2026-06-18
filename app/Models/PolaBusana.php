<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PolaBusana extends Model
{
    protected $table = 'pola_busanas';

    protected $fillable = [
        'pelanggan_id',
        'name',
        'type',
        'date_created',
        'status',
        'l_dada',
        'p_baju',
        'l_bahu',
        'p_lengan',
        'l_pinggang',
        'l_pinggul',
        'p_celana',
        'p_rok',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
