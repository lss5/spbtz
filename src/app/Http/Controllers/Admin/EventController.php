<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Services\Event\Service;

class EventController extends Controller
{
    
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;

        $this->authorizeResource(Event::class, 'event');
    }

    public function index()
    {
        return view('admin.event.index', [
            'events_all' => Event::all(),
            'events_creator' => Auth::user()->events_creator()->get(),
            'events_participant' => Auth::user()->events_participants()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.event.create', [
            'events_all' => Event::all(),
            'events_creator' => Auth::user()->events_creator()->get(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $event = $this->service->store($data);

        return redirect()->route('admin.events.show', $event);
    }

    public function show(Event $event)
    {
        $participant = Auth::user()->events_participants()->where('events.id', $event->id)->first();

        return view('admin.event.show', [
            'events_all' => Event::all(),
            'events_creator' => Auth::user()->events_creator()->get(),
            'event' => $event,
            'participant' => $participant,
        ]);
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', [
            'events_all' => Event::all(),
            'events_creator' => Auth::user()->events_creator()->get(),
            'event' => $event,
        ]);
    }

    public function update(UpdateRequest $request, Event $event)
    {
        $data = $request->validated();

        $event = $this->service->update($event, $data);

        return redirect()->route('admin.events.show', $event);
    }

    /**
     * Change status user to event
     */
    public function participant(Event $event)
    {
        $user = $event->participants()->where('users.id', Auth::id())->first();

        if ($user) {
            $user->events_participants()->detach($event->id);
            $participant = 'detach';
        } else {
            $event->users()->attach(Auth::id(), ['role' => 'participant']);
            $participant = 'attach';
        }

        return response()->json([
            'error' => null,
            'participant' => $participant,
            'participants_count' => $event->participants()->count(),
        ]);
    }
}
