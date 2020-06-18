<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'pin' => $this->pin,
            'email' => $this->email,
            'role' => $this->role->name,
            'department' => $this->department->name,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
