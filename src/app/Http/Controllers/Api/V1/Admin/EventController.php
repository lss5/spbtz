<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Resources\V1\EventCollection;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use App\Services\Event\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
        return new EventCollection(Event::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeRequest = new StoreRequest();
        $validator = Validator::make($request->all(), $storeRequest->rules());

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        }

        $event = $this->service->store($validator->validated());

        return new EventResource($event);
    }

    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        if (Auth::user()->can('update', $event)) {
            $UpdateRequest = new UpdateRequest();
            $validator = Validator::make($request->all(), $UpdateRequest->rules());
    
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors(),
                ]);
            }
    
            $event = $this->service->update($event, $validator->validated());
    
            return new EventResource($event);
        }

        return response()->json([
            'error' => 'Нет прав на изменение данного события',
            'result' => null,
        ], 403);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if (Auth::user()->can('delete', $event)) {
            $this->service->destroy($event);
        }

        return response()->json([
            'error' => null,
            'result' => 'Deleted',
        ]);
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
