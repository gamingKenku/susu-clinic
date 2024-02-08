<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\WorkingHours;
use Illuminate\Http\Request;

class WorkingHoursController extends Controller
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
        return view('resources.working_hours.index', [
            'working_hours' => WorkingHours::query()->orderBy('staff_id')->orderBy('weekday'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.working_hours.create', [
            'staff' =>  Staff::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'weekday' => ['required', 'integer', 'between:0,6'],
            'start_time' => ['required', 'date', 'date_format:H:i'],
            'end_time' => ['required', 'date', 'date_format:H:i', 'after:start_time'],
            'staff_id' => ['required', 'exists:staff,id'],
        ]);

        WorkingHours::create([
            'weekday' => $validated_data['weekday'],
            'start_time' => $validated_data['start_time'],
            'end_time' => $validated_data['end_time'],
            'staff_id' => $validated_data['staff_id'],
        ]);

        return redirect('/admin/resources/working_hours');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('resources.working_hours.show', [
            'working_hours' => WorkingHours::query()->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.working_hours.edit', [
            'staff' => Staff::all(),
            'working_hours' => WorkingHours::query()->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'weekday' => ['required', 'integer', 'between:0,6'],
            'start_time' => ['required', 'date', 'date_format:H:i'],
            'end_time' => ['required', 'date', 'date_format:H:i', 'after:start_time'],
            'staff_id' => ['required', 'exists:staff,id'],
        ]);

        $working_hours = WorkingHours::query()->findOrFail($id);

        $working_hours->weekday = $validated_data['weekday'];
        $working_hours->start_time = $validated_data['start_time'];
        $working_hours->end_time = $validated_data['end_time'];
        $working_hours->staff()->associate(Staff::query()->findOrFail($validated_data['staff_id']));

        $working_hours->save();

        return redirect('/admin/resources/working_hours');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        WorkingHours::query()->findOrFail($id)->delete();

        return redirect('/admin/resources/working_hours');
    }
}
