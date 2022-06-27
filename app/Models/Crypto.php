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
    ];

    public $timestamps = true;

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */

    protected function CreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d h:m:i ',strtotime($value)),
        );
    }

    static function CurrencyPeriod($st_period,$end_period,$coin,$page)
    {
        $coin_period = Crypto::WhereBetween('created_at', [$st_period,$end_period])
        ->where('coin_id',$coin)
        ->paginate($perPage = 10, $columns = ['*'], $pageName = 'page');

        $data = [];
        foreach($coin_period as $coin_p) {
            $data[] = [
                'coin_id' => $coin_p->coin_id,
                'coin_name' => $coin_p->coin_name,
                'price_at_time' => $coin_p->price_at_time,
                'date' =>  date('d-m-Y h:m:i',strtotime($coin_p->created_at)),
            ];
        }

        return [
            'currentPage' => $coin_period->currentPage(),
            'data' => $data,
            'firstItem' => $coin_period->firstItem(),
            'lastPage' => $coin_period->lastPage(),
            'lastItem' => $coin_period->lastItem(),
            'perPage' => $coin_period->perPage(),
            'total' => $coin_period->total(),
        ];
    }
}
