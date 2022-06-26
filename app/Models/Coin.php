<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $table = 'coin';

    protected $fillable = [
        'coin_name',
        'coin_id',
        'current_price',
    ];

    public $timestamps = true;
}
