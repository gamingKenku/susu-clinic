<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
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
        return view('resources.vacancies.index', [
            'vacancies' => Vacancy::query()->orderBy('position_id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.vacancies.index', [
            'positions' => Position::query()->orderBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'responsibilities' => ['required', 'max:16777215'],
            'requirements' => ['required', 'max:16777215'],
            'conditions' => ['required', 'max:16777215'],
            'position_id' => ['required', 'exists:position_id'], 
        ]);

        $vacancy = Position::create([
            'name' => $validated_data['name'],
            'responsibilities' =>  $validated_data['responsibilities'],
            'requirements' =>  $validated_data['requirements'],
            'conditions' =>  $validated_data['conditions'],
        ]);

        $vacancy->save();

        return redirect('/admin/resources/vacancies');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('resources.vacancies.show', [
            'vacancy' => Vacancy::query()->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.vacancies.edit', [
            'positions' => Position::query()->orderBy('name'),
            'vacancy' => Vacancy::query()->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'responsibilities' => ['required', 'max:16777215'],
            'requirements' => ['required', 'max:16777215'],
            'conditions' => ['required', 'max:16777215'],
            'position_id' => ['required', 'exists:position_id'], 
        ]);

        $vacancy = Position::query()->findOrFail($id);
    
        $vacancy->responsibilities = $validated_data['responsibilities'];
        $vacancy->requirements = $validated_data['requirements'];
        $vacancy->conditions = $validated_data['conditions'];
        
        $vacancy->position()->associate(Position::query()->findOrFail($validated_data['position_id']));

        $vacancy->save();

        return redirect('/admin/resources/vacancies');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vacancy::query()->findOrFail($id)->delete();

        return redirect('/admin/resources/vacancies');
    }
}
