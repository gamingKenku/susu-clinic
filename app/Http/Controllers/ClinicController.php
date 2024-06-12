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
            $clinicsObjects = $this->filterColumns($clinicsObjects, $request->input('filter'), ['name', 'address']);
        }

        $clinicsObjects = $clinicsObjects->orderBy('name')->paginate(25);

        if ($request->wantsJson())
        {
            return response()->json([
                'clinicsObjects' => $clinicsObjects
            ]);
        }
        else 
        {
            return view('resources.clinics.index', ['clinicsObjects' => $clinicsObjects]);
        }
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

        $clinic = Clinic::create([
            'name' => $validated_data['name'],
            'address' => $validated_data['address'],
        ]);

        if ($request->wantsJson())
        {
            return response()->json([
                'clinicsObjects' => $clinic
            ]);
        }
        else 
        {
            return redirect('/admin/resources/clinics');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $clinic = Clinic::query()->findOrFail($id);

        if ($request->wantsJson())
        {
            return response()->json([
                'clinic' => $clinic
            ]);
        }
        else 
        {
            return view('resources.clinics.show', ['clinic' => $clinic]);
        }
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

        if ($request->wantsJson())
        {
            return response()->json([
                'clinic' => $clinic
            ]);
        }
        else 
        {
            return redirect('/admin/resources/clinics');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Clinic::query()->findOrFail($id)->delete();
        
        if ($request->wantsJson())
        {
            return response()->json([], 204);
        }
        else 
        {
            return redirect('/admin/resources/clinics');
        }
    }
}
