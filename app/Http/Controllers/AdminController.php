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
            'unmodded_feedback_count' => Feedback::query()->where('moderated', '=', false)->count(),
        ]);
    }

    public function resources(Request $request)
    {
        $tables = [
            // 'users',
            'documents',
            'events',
            'clinics',
            'categories',
            'services',
            'discounts',
            'staff',
            'positions',
            'working_hours',
        ];

        if ($request->wantsJson()) {
            return response()->json([
                'tables' => $tables,
            ]);
        } else {
            return view('admin.resources', [
                'tables' => $tables,
            ]);
        }
    }

    public function moderationIndex(Request $request)
    {
        if (!$request->boolean('unchecked')) {
            $feedback = Feedback::where('confirmed', '=', true)->paginate(15);
        }
        else {
            $feedback = Feedback::query()->where('confirmed', '=', true)->where('moderated', '=', false)->paginate(15);
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
            return redirect(route('moderationIndex', ['unchecked' => true]));
        }

        $feedback->moderated = $validated_data['moderated'];
        $feedback->blocked = $validated_data['blocked'];

        $feedback->save();

        return redirect(route('moderationIndex', ['unchecked' => true]));
    }
}
