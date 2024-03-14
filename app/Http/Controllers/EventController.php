<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::query()->orderBy('created_at', 'desc')->paginate(25);

        return view('resources.events.index', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'header' => ['required', 'max:255'],
            'content' => ['required', 'max:16777215'],
            'picture_path' => ['image'],
        ]);

        $event = Event::create([
            'header' => $validated_data['header'],
            'content' => $validated_data['content'],
        ]);

        if ($request->hasFile('picture_path'))
        {
            $path = $request->file('picture_path')->storeAs('event_pictures', "event{$event->id}" . '.' . $request->file('picture_path')->getClientOriginalExtension());
            $event->picture_path = $path;
        }

        $event->save();

        return redirect('/admin/resources/events');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::query()->findOrFail($id);

        return view('resources.events.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::query()->findOrFail($id);

        return view('resources.events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'header' => ['required', 'max:255'],
            'content' => ['required', 'max:16777215'],
            'picture_path' => ['file', 'image'],
        ]);

        $event = Event::query()->findOrFail($id);

        $event->header = $validated_data['header'];
        $event->content = $validated_data['content'];

        if (!$request->has('keep_file'))
        {
            Storage::delete($event->picture_path);
            $event->picture_path = null;
            
            if ($request->hasFile('picture_path'))
            {
                $path = $request->file('picture_path')->storeAs('event_pictures', "event{$event->id}" . '.' . $request->file('picture_path')->getClientOriginalExtension());
                $event->picture_path = $path;
            }
        }

        $event->save();

        return redirect('/admin/resources/events');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::query()->findOrFail($id);

        if (isset($event->picture_path)) {
            Storage::delete(optional($event->picture_path));
        }
        
        $event->delete();

        return redirect('/admin/resources/events');
    }
}
