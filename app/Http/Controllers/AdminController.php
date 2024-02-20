<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        return view('admin.dashboard', [
            'unmodded_feedback_count' => Feedback::query()->where('moderated', '=', false),
        ]);
    }

    public function resources()
    {
        return view('admin.resources');
    }

    public function moderationIndex(Request $request)
    {
        if ($request->boolean('unchecked')) {
            $feedback = Feedback::paginate(30);
        }
        else {
            $feedback = Feedback::query()->where('moderated', '=', false)->paginate(30);
        }

        return view('admin.moderation.index', [
            'feedback' => $feedback,
        ]);
    }

    public function moderationEdit(string $id)
    {
        return view('admin.moderation.edit', [
            'feedback' => Feedback::query()->findOrFail($id),
        ]);
    }

    public function moderationUpdate(Request $request, string $id)
    {
        $feedback = Feedback::query()->findOrFail($id);

        $validated_data = $request->validate([
            'moderated' => ['required', 'boolean'],
            'blocked' => ['required', 'boolean'],
            'deleted' => ['required', 'boolean'],
        ]);

        if ($validated_data['deleted'] == true) {
            $feedback->delete();
        }

        $feedback->moderated = $validated_data['moderated'];
        $feedback->blocked = $validated_data['blocked'];

        return redirect(route('moderationIndex'));
    }
}
