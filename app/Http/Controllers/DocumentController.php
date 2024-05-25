<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
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
        return view('resources.documents.index', [
            'documents' => Document::orderBy('name')->paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'document_path' => ['required', 'mimes:pdf'],
        ]);

        $document_file = $request->file('document_path');

        $document = new Document();

        $document->name = $validated_data['name'];
        $document->document_path = '';
        $document->save();

        $document->document_path = $document_file->storeAs('documents', "document{$document->id}." . $document_file->getClientOriginalExtension(), 'public');

        $document->save();

        return redirect(route('documents.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('resources.documents.show', [
            'document' => Document::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.documents.edit', [
            'document' => Document::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->has('keep_file'))
        {
            $validated_data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'document_path' => ['mimes:pdf'],
            ]);
        }
        else
        {
            $validated_data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'document_path' => ['required', 'mimes:pdf'],
            ]);
        }

        $document_file = $request->file('document_path');

        $document = Document::findOrFail($id);

        $document->name = $validated_data['name'];

        if (!$request->has('keep_file'))
        {
            Storage::disk('public')->delete($document->document_path);
            $document->document_path = $document_file->storeAs('documents', "document{$document->id}." . $document_file->getClientOriginalExtension(), 'public');
        }

        $document->save();

        return redirect(route('documents.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Document::findOrFail($id)->delete();

        return redirect(route('documents.index'));
    }
}
