<?php

namespace App\Http\Resources\Departments;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class DepartmentsResource extends JsonResource
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
            'users' => $this->users->count(),
            'created by' => User::find($this->creator_id)->name,
            'created on' => $this->created_at->diffForHumans()
        ];
    }
}
