<?php

namespace App\Http\Resources\Carts;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Cart;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'table_name' => $this->table_name,
            'user' => $this->user->name,
            'amount' => $this->amount,
            'sold' => $this->sold,
            // 'created_at' => $this->created_at->format('H:m A, jS D M Y'),
            // 'created_at' => $this->created_at->format('H:m A, jS D M Y'),
            'created_at' => $this->created_at

            // Timezone::convertToLocal($thiscreated_at)
        ];
    }
}
