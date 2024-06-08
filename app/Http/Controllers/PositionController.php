<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Staff;
use Illuminate\Http\Request;

class PositionController extends Controller
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
        $positions = Position::query();

        if ($request->has('filter'))
        {
            $positions = $this->filterColumns($positions, $request->input('filter'), ['name']);
            $positions = $this->filterRelatedColumns($positions, $request->input('filter'), [
                'staff' => [
                    'first_name',
                    'last_name',
                    'patronym'
                ]
            ]);
        }

        $positions = $positions->orderBy('name')->paginate(25);

        return view('resources.positions.index', [
            'positions' => $positions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.positions.create', [
            'staff' => Staff::query()
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->orderBy('patronym')
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:65535'],
            'responsibilities' => ['required', 'max:16777215'],
            'requirements' => ['required', 'max:16777215'],
            'conditions' => ['required', 'max:16777215'],
            'has_vacancy' => ['boolean', 'nullable'],
            'staff' => ['array'], 
            'staff.*' => ['exists:staff,id'],
        ]);

        $position = Position::create([
            'name' => $validated_data['name'],
            'description' => $validated_data['description'],
            'responsibilities' =>  $validated_data['responsibilities'],
            'requirements' =>  $validated_data['requirements'],
            'conditions' =>  $validated_data['conditions'],
        ]);

        if (in_array('has_vacancy', $validated_data)) {
            $position->has_vacansy = $validated_data['has_vacansy'];
        }

        $position->staff()->attach($validated_data['staff'] ?? []);

        $position->save();

        return redirect('/admin/resources/positions');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('resources.positions.show', [
            'position' => Position::query()->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.positions.edit', [
            'position' => Position::query()->findOrFail($id),
            'staff' => Staff::query()
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->orderBy('patronym')
                ->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:65535'],
            'responsibilities' => ['required', 'max:16777215'],
            'requirements' => ['required', 'max:16777215'],
            'conditions' => ['required', 'max:16777215'],
            'has_vacancy' => ['boolean', 'nullable'],
            'staff' => ['array'], 
            'staff.*' => ['exists:staff,id'],
        ]);

        $position = Position::query()->findOrFail($id);
        $position->name = $validated_data['name'];
        $position->description = $validated_data['description'];
        $position->responsibilities = $validated_data['responsibilities'];
        $position->requirements = $validated_data['requirements'];
        $position->conditions = $validated_data['conditions'];

        if (array_key_exists('has_vacancy', $validated_data)) {
            $position->has_vacancy = $validated_data['has_vacancy'];
        }
        else {
            $position->has_vacancy = false;
        }

        $position->staff()->sync($validated_data['staff'] ?? []);
        
        $position->save();

        return redirect('/admin/resources/positions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Position::query()->findOrFail($id)->delete();

        return redirect('/admin/resources/positions');
    }
}
