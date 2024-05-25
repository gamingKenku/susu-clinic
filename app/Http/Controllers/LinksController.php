<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('content_edit.links.index', [
            'links' => Link::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content_edit.links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_response = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url'],
        ]);

        Link::create([
            'title' => $validated_response['title'],
            'link' => $validated_response['link'],
        ]);

        return redirect(route('links.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('content_edit.links.show', [
            'link' => Link::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('content_edit.links.edit', [
            'link' => Link::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_response = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'link' => ['required', 'url'],
        ]);

        $link = Link::findOrFail($id);

        $link->title = $validated_response['title'];
        $link->link = $validated_response['link'];

        $link->save();

        return redirect(route('links.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Link::findOrFail($id)->delete();

        return redirect(route('links.index'));
    }
}
