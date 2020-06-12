<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'image' => $this->image,
            'description' => $this->description,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'category' => $this->category->name,
            'item_type' => $this->item_type,
            'user' => $this->user->name,
            'created_at' => $this->created_at->format('H:m A D M Y')
        ];
    }
}
