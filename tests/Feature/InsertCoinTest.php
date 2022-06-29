<?php

namespace Tests\Feature;

use App\Models\Coin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InsertCoinTest extends TestCase
{
  use RefreshDatabase;
    public function testInsertCoin()
    {
        $insertcoin = Coin::create([
          'coin_id' => 'ruby',
          'coin_name' => 'Ruby',
          'current_price' => 1200,
        ]);


        $this->assertInstanceOf(Coin::class, $insertcoin);
        $this->assertDatabaseHas('coin', ['coin_id' => $insertcoin->coin_id]);
        
    }
}
