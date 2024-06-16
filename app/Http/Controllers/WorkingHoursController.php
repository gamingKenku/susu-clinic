<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\WorkingHours;
use App\Rules\EndTimeAfter;
use App\Rules\HasEndTime;
use App\Rules\HasStartTime;
use App\Rules\WorkingHoursEndTimeAfter;
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
    public function index(Request $request)
    {
        $staff = Staff::query();

        if ($request->has('filter'))
        {
            $staff_types = [
                'врач' => 'doctor',
                'медсестра' => 'nurse',
                'медбрат' => 'nurse',
                'руководство' => 'administrator'
            ];

            $filter = mb_strtolower($request->input('filter'));
            $filter = $staff_types[$filter] ?? $filter;

            $staff = $this->filterColumns($staff, $filter, [
                'first_name',
                'last_name',
                'patronym',
                'staff_type',
                'experience'
            ]);
            $staff = $this->filterRelatedColumns($staff, $filter, [
                'positions' => ['name'],
            ]);        
        }

        $staff = $staff->orderBy('staff_type')->orderBy('last_name')->orderBy('first_name')->orderBy('patronym')->paginate(25);

        if ($request->wantsJson())
        {
            return response()->json([
                'staff' => $staff
            ]);
        } 
        else 
        {
            return view('resources.working_hours.index', [
                'staff' => $staff
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
        // return view('resources.working_hours.create', [
        //     'staff' =>  Staff::all(),
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);

        // $validated_data = $request->validate([
        //     'weekday' => ['required', 'integer', 'between:0,6'],
        //     'start_time' => ['required', 'date', 'date_format:H:i'],
        //     'end_time' => ['required', 'date', 'date_format:H:i', 'after:start_time'],
        //     'staff_id' => ['required', 'exists:staff,id'],
        // ]);

        // WorkingHours::create([
        //     'weekday' => $validated_data['weekday'],
        //     'start_time' => $validated_data['start_time'],
        //     'end_time' => $validated_data['end_time'],
        //     'staff_id' => $validated_data['staff_id'],
        // ]);

        // return redirect('/admin/resources/working_hours');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'staff' => Staff::query()->findOrFail($id)->workingHours()->get(),
            ]);
        } 
        else 
        {
            return view('resources.working_hours.show', [
                'staff' => Staff::query()->findOrFail($id),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.working_hours.edit', [
            'staff' => Staff::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $weekdays_rules = array_map(function ($weekday_index) use ($request) {
            $end_time = ["end_time.$weekday_index" => [new HasEndTime($request->input("start_time.$weekday_index")), new EndTimeAfter($request->input("start_time.$weekday_index"))]];
            $start_time = ["start_time.$weekday_index" => [new HasStartTime($request->input("end_time.$weekday_index"))]];
        
            return array_merge($end_time, $start_time);
        }, [0, 1, 2, 3, 4, 5, 6]);

        $weekdays_rules = [
            'start_time.*' => ['nullable', 'date_format:H:i'],
            'end_time.*' => ['nullable', 'date_format:H:i'],
            'start_time' => ['array', 'required'],
            'end_time' => ['array', 'required'],
        ] + array_merge(...$weekdays_rules);

        // dd($weekdays_rules);

        $validated_data = $request->validate($weekdays_rules);

        for($i = 0; $i <= 6; $i++)
        {
            if ($validated_data['start_time'][$i] && $validated_data['end_time'][$i])
            {
                WorkingHours::updateOrCreate(
                    ['staff_id' => $id, 'weekday' => $i],
                    ['start_time' => $validated_data['start_time'][$i], 'end_time' => $validated_data['end_time'][$i]],
                );
            }
            else
            {
                $work_weekday = WorkingHours::where('staff_id', '=', $id)->where('weekday', '=', $i);
                if ($work_weekday->exists())
                {
                    $work_weekday->delete();
                }
            }
        }

        if ($request->wantsJson())
        {
            return response()->json([
                'staff' => Staff::findOrFail($id)->workingHours()->orderBy('weekday')->get(),
            ]);
        } 
        else 
        {
            session()->flash('success_message', 'Операция прошла успешно!');
            return redirect(route('working-hours.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);

        // WorkingHours::query()->findOrFail($id)->delete();

        // return redirect('/admin/resources/working_hours');
    }
}
