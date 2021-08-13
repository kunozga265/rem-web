<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'id'                =>  $this->id,
            'status'            =>  $this->status,
            'start_time'        =>  date("M d, Y H:i",$this->start_time),
            'end_time'          =>  $this->end_time?date("M d, Y H:i",$this->end_time):"Present",
            "error"             =>  $this->error
        ];
    }
}
