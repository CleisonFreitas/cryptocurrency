<?php

namespace Tests\Feature;

use App\Models\Crypto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotationTest extends TestCase
{
    use RefreshDatabase;
    
    public function testNotationInsert()
    {
        $coin_notation = Crypto::create([
          'coin_id' => 'ruby',
          'coin_name' => 'Ruby',
          'price_at_time' => 1200,
          'query_date' => "21-05-2022"
        ]);


        $this->assertInstanceOf(Crypto::class, $coin_notation);
        $this->assertDatabaseHas('crypto_notation', ['coin_id' => $coin_notation->coin_id]);
        
    }
}
