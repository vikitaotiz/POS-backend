<?php

namespace App\Http\Resources\Logs;

use Illuminate\Http\Resources\Json\JsonResource;

class LoggedInUserResource extends JsonResource
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
            'department' => $this->department,
            'role' => $this->role,
            'time' => $this->time,
            'user_id' => $this->user_id
        ];
    }
}
