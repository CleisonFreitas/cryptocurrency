<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoinResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);

      return [
        'coin_name' => $this->coin_name,
        'coin_id' => $this->coin_id,
        'last_updated' => date('d-m-Y h:m:i', strtotime($this->updated_at))
      ];
    }
}
