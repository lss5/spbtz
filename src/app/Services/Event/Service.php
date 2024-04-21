<?php

namespace App\Services\Event;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class Service
{
    public function store($data): Event
    {
        $event = Event::create($data);
        $event->users()->attach(Auth::user(), ['role' => 'creator']);
        $event->users()->attach(Auth::user(), ['role' => 'participant']);

        return $event;
    }

    public function update(Event $event, $data): Event
    {
        $event->update($data);
        $event->fresh();
        
        return $event;
    }

    public function destroy(Event $event): void
    {
        $event->users()->detach();
        $event->delete();
    }
}