<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

    protected $table = 'crypto_notation';

    protected $fillable = [
        'coin_id',
        'coin_name',
        'price_at_time',
        'query_date'
    ];

    public $timestamps = true;

    /**
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */

    protected function CreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d-m-Y h:m:i ',strtotime($value)),
        );
    }

    protected function PriceAtTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value,2,',','.'),
        );
    }

}
