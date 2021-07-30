<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'description' => $this->description,
            'date' => $this->created_at->format('d M Y'),
            'date_for_human' => $this->created_at->diffForHumans(),
            'completed' => $this->completed_at !== null ? true : false,
        ];
    }
}
