<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Products\ProductResource;

class CategoryResource extends JsonResource
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
            'user' => $this->user->name,
            'products' => ProductResource::collection($this->products),
            'product_count' => $this->products->count(),
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
