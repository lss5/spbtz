<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'error' => null,
            'result' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'date_birthday' => $this->date_birthday ?  $this->date_birthday->format('d.m.Y') : 'Не указана',
            ]
        ];
    }
}
