<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UkuranBaju extends Model
{
    protected $table = 'ukuran_bajus';

    protected $fillable = [
        'pelanggan_id',
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
}
