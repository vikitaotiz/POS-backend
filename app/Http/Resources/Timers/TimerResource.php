<?php

namespace App\Http\Resources\Timers;

use Illuminate\Http\Resources\Json\JsonResource;

class TimerResource extends JsonResource
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
            'module' => $this->module,
            'user_order' => $this->user_order,
            'table_name' => $this->table_name,
            'timer' => $this->timer,
            'content' => $this->content,
            'amount' => $this->amount,
            'user' => $this->user->name,
            'created_at' => $this->created_at
        ];
    }
}
