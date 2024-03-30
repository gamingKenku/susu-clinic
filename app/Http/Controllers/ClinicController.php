<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
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
        $clinicsObjects = Clinic::query();

        if ($request->has('filter'))
        {
            $clinicsObjects = $this->filterColumns($clinicsObjects, ['name', 'address'], $request->input('filter'));
        }

        $clinicsObjects = $clinicsObjects->orderBy('name')->paginate(25);

        return view('resources.clinics.index', ['clinicsObjects' => $clinicsObjects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.clinics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'max:255'],
            'address' => ['required'],
        ]);

        // address validation?

        Clinic::create([
            'name' => $validated_data['name'],
            'address' => $validated_data['address'],
        ]);

        return redirect('/admin/resources/clinics');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clinic = Clinic::query()->findOrFail($id);

        return view('resources.clinics.show', ['clinic' => $clinic]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $clinic = Clinic::query()->findOrFail($id);

        return view('resources.clinics.edit', ['clinic' => $clinic]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'max:255'],
            'address' => ['required'],
        ]);

        $clinic = Clinic::query()->findOrFail($id);

        $clinic->name = $validated_data['name'];
        $clinic->address = $validated_data['address'];

        $clinic->save();

        return redirect('/admin/resources/clinics');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Clinic::query()->findOrFail($id)->delete();
        
        return redirect('/admin/resources/clinics');
    }
}
