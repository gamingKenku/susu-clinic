<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('content_edit.index');
    }

    public function aboutEdit()
    {
        $about = Storage::get('content_html\about.html');

        return view('content_edit.about', [
            'about' => $about,
        ]);
    }

    public function aboutUpdate(Request $request)
    {   
        $validated_response = $request->validate([
            'content' => ['required', 'max:16777215']
        ]);

        Storage::put('content_html\about.html', $validated_response['content']);

        return redirect(route('contentIndex'));
    }

    public function contactsEdit()
    {
        $contacts = Storage::get('content_html\contacts.html');

        return view('content_edit.contacts', [
            'contacts' => $contacts,
        ]);
    }

    public function contactsUpdate(Request $request)
    {
        $validated_response = $request->validate([
            'content' => ['required', 'max:16777215']
        ]);

        Storage::put('content_html\contacts.html', $validated_response['content']);

        return redirect(route('contentIndex'));
    }

    public function licenseEdit()
    {
        return view('content_edit.license');
    }

    public function licenseUpdate(Request $request)
    {
        $request->validate([
            'license' => ['required', 'mimes:pdf'],
        ]);

        if ($request->hasFile('license'))
        {
            $file = $request->file('license');

            Storage::disk('public')->delete('license.pdf');

            $file->storeAs('', 'license.pdf', 'public');
        }

        return redirect(route('contentIndex'));
    }

    public function linksIndex()
    {
        
    }

    public function linksEdit()
    {

    }

    public function linksUpdate()
    {

    }
}
