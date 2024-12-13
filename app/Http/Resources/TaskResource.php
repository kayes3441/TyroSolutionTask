<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request):array
    {
        return [
            'id'            => $this->id,
            'title'          => $this->title,
            'description'   => $this->description,
            'assigned_to'   => $this->assigned_to,
            'status'        =>  $this->status,
            'created_at'    => $this->created_at->format('d-m-Y'),
            'updated_at'    => $this->updated_at->format('d-m-Y'),
        ];
    }
}
