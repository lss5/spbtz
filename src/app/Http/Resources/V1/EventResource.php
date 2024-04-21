<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'error' => null,
            'result' => [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'date_created' => $this->created_at->format('d.m.Y'),
            ],
        ];
    }
}
