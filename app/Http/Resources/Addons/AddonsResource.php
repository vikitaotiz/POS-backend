<?php

namespace App\Http\Resources\Addons;

use Illuminate\Http\Resources\Json\JsonResource;

class AddonsResource extends JsonResource
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
            'name' => $this->name,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'created_at' => $this->created_at->format('H:m A, jS D M Y')
        ];
    }
}
