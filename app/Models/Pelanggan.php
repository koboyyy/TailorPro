<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'status',
        'member_since',
        'avatar_url',
    ];

    public function ukuranBaju(): HasOne
    {
        return $this->hasOne(UkuranBaju::class, 'pelanggan_id');
    }

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'pelanggan_id');
    }

    public function polaBusana(): HasMany
    {
        return $this->hasMany(PolaBusana::class, 'pelanggan_id');
    }
}
