<?php

namespace App\Http\Resources\Logs;

use Illuminate\Http\Resources\Json\JsonResource;

class LoggerResource extends JsonResource
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
            'created_at' => $this->created_at->format('H:m A D M Y'),
            'content' => $this->content,
            'module' => $this->module,
            'user' => $this->user->name
        ];
    }
}
