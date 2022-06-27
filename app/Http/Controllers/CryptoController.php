<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoinResource;
use App\Models\Coin;
use App\Models\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CryptoController extends Controller
{
   
    public function index(Request $request)
    {
        try{
            $coin_id = $request->coin_id ?? 'bitcoin';
            $get_currency = $this->getCurrency($coin_id);

            if(isset($get_currency['error'])) {
                throw new \Exception($get_currency['error']);
            }

            $coin = $this->saveCoin($get_currency['data']);
            
            if(isset($coin['error'])){
                throw new \Exception($coin['error']);
            }


            $coin_at_time = $this->CoinAtTime($coin['coin']);

            if(isset($coin_at_time['error'])){
                throw new \Exception($coin_at_time['error']);
            }

            return response()->json($coin,200);

        }catch(\Exception $ex) {
            return response()->json(['error' => [$ex->getMessage()]],404);
        }
    }

    public function CoinOnPeriod(Request $request)
    {
        try{

            $page = $request->page ?? "1";
            $st_period = date('Y-m-d h:m:i',strtotime($request->st_date. " ".$request->st_hour));
            $end_period = date('Y-m-d h:m:i',strtotime($request->end_date. " ".$request->end_hour));
            
            $coin_period = Crypto::CurrencyPeriod($st_period,$end_period,$page);

            return response()->json($coin_period,200);

        }catch(\Exception $ex) {
            return response()->json($ex->getMessage(),404);
        }
    }

    private function getCurrency($coin_id)
    {

            $url = "https://api.coingecko.com/api/v3/coins/$coin_id?localization=false&tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false";
        
            $currency = curl_init('http://404.php.net/');
            curl_setopt($currency, CURLOPT_URL, $url);
            curl_setopt($currency, CURLOPT_HEADER, false);
            curl_setopt($currency, CURLOPT_NOBODY, false);
            curl_setopt($currency, CURLOPT_RETURNTRANSFER, true);
            $curl = curl_exec($currency);
            curl_close($currency);

            $get_content = json_decode($curl);

            if(isset($get_content->error)){
                return ['error' => "Could not find coin with the given id"];
            }

            $details = [
                'coin_id' => $get_content->id,
                'coin_name' => $get_content->name,
                'current_price' => $get_content->market_data->current_price->usd
            ];

            return ['data' => $details];
        
    }

    private function saveCoin(array $coin_data)
    {
        try{
            $coin = Coin::Where('coin_id',$coin_data['coin_id'])->first();

            if(empty($coin)){
                $coin_register = Coin::create([
                    'coin_id' => $coin_data['coin_id'],
                    'coin_name' => $coin_data['coin_name'],
                    'current_price' => $coin_data['current_price']
                ]);
            }else{
                $coin_register = Coin::find($coin->id);
                $coin_register->update([
                    'current_price' => $coin_data['current_price'],
                ]);
            }

            if($coin_register == false){
                throw new \Exception("There was an error trying to register");
            }

            return ['coin' => new CoinResource($coin_register)];

        }catch(\Exception $ex){
            return ['error' => $ex->getMessage()];
        }

    }

    private function CoinAtTime(object $coin)
    {
        try{
            $current_notation = Crypto::create([
                'coin_id' => $coin->coin_id,
                'coin_name' => $coin->coin_name,
                'price_at_time' => $coin->current_price
            ]);
    
            if($current_notation == false){
                throw new \Exception("There was an error trying to register");
            }
    
            return ['data' => $current_notation];

        }catch(\Exception $ex){
            return ['error' => $ex->getMessage()];
        }
        
    }
}
