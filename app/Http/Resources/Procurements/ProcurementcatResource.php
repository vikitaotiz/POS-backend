<?php

namespace App\Http\Resources\Procurements;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcurementcatResource extends JsonResource
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
            'procurements' => ProcurementResource::collection($this->procurements),
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
