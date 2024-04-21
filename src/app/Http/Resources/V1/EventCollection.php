<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'error' => null,
            'result' => $this->collection,
        ];
    }
}
