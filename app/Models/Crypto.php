<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

    protected $table = 'crypto_notation';

    protected $fillable = [
        'coin_name',
        'price_at_time',
    ];

    public $timestamps = true;

    static function coin_currency()
    {
        $coin = Self::paginate();
    }
}
