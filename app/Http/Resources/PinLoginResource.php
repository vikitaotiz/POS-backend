<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PinLoginResource extends JsonResource
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
            'email' => $this->email,
            'pwd_clr' => $this->pwd_clr,
            'created_at' => $this->created_at->diffForHumans(),
            'role' => $this->role->name,
            'department' => $this->department->name
        ];
    }
}
