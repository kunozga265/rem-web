<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'start_time'        =>  $this->formatDate($this->start_time),
            'end_time'          =>  $this->end_time?$this->formatDate($this->end_time):"Present",
            "error"             =>  $this->error
        ];
    }

    private function formatDate($timestamp){
        return Carbon::createFromTimestamp($timestamp,'Africa/Blantyre')->format("M d, Y H:i");
    }
}
