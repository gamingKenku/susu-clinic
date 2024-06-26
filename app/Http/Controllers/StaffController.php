<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
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

            $filter = strtolower($request->input('filter'));
            $filter = $staff_types[strtolower($request->input('filter'))] ?? $filter;

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
                'staffObjects' => $staff  
            ]);
        }
        else
        {
            return view('resources.staff.index', [
                'staffObjects' => $staff
            ]);        
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.staff.create', [
            'positions' => Position::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated_data = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'patronym' => ['max:255'],
            'specialities' => ['required', 'max:16777215'],
            'experience' => ['required', 'date', 'before:now'],
            'photo_path' => ['image'],
            'staff_type' => ['required', 'in:doctor,nurse,administrator'],
            'positions' => ['array'],
            'positions.*' => ['exists:positions,id'],
        ]);

        
        $staff = Staff::create([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'patronym' => $validated_data['patronym'],
            'specialities' => $validated_data['specialities'],
            'experience' => $validated_data['experience'],
            'staff_type' => $validated_data['staff_type']
        ]);
        
        if ($request->hasFile('photo_path'))
        {
            // dd($request->hasFile('photo_path'));
            $path = $request->file('photo_path')->storeAs('staff_photos', "staff{$staff->id}" . '.' . $request->file('photo_path')->getClientOriginalExtension(), 'public');
            $staff->photo_path = $path;
        }

        // dd($validated_data);
        
        $staff->positions()->attach($validated_data['positions']  ?? []);

        $staff->save();

        if ($request->wantsJson())
        {
            return response()->json([
                'staff' => $staff  
            ]);
        }
        else
        {
            session()->flash('success_message', 'Операция прошла успешно!');
            return redirect('/admin/resources/staff');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'staff' => Staff::query()->findOrFail($id),
            ]);
        }
        else
        {
            return view('resources.staff.show', [
                'staff' => Staff::query()->findOrFail($id),
            ]);        
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.staff.edit', [
            'staff' => Staff::query()->findOrFail($id),
            'positions' => Position::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'patronym' => ['max:255'],
            'specialities' => ['required', 'max:16777215'],
            'experience' => ['required', 'date', 'before:now'],
            'photo_path' => ['image'],
            'staff_type' => ['required', 'in:doctor,nurse,administrator'],
            'positions' => ['array'],
            'positions.*' => ['exists:positions,id'],
        ]);

        $staff = Staff::query()->findOrFail($id);

        // dd($staff);

        $staff->first_name = $validated_data['first_name'];
        $staff->last_name = $validated_data['last_name'];
        $staff->patronym = $validated_data['patronym'];
        $staff->specialities = $validated_data['specialities'];
        $staff->experience = $validated_data['experience'];
        $staff->staff_type = $validated_data['staff_type'];
        $staff->positions()->sync($validated_data['positions'] ?? []);

        if (!$request->has('keep_file'))
        {
            if ($staff->photo_path) {
                Storage::disk('public')->delete($staff->photo_path);
            }

            $staff->photo_path = null;
            
            if ($request->hasFile('photo_path'))
            {
                $path = $request->file('photo_path')->storeAs('staff_photos', "photo{$staff->id}" . '.' . $request->file('photo_path')->getClientOriginalExtension(), 'public');
                $staff->photo_path = $path;
            }
        }

        $staff->save();

        if ($request->wantsJson())
        {
            return response()->json([
                'staff' => $staff,
            ]);
        }
        else
        {
            session()->flash('success_message', 'Операция прошла успешно!');
            return redirect('/admin/resources/staff');  
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $staff = Staff::query()->findOrFail($id);

        if ($staff->photo_path) {
            Storage::disk('public')->delete($staff->photo_path);
        }        

        $staff->delete();
        
        if ($request->wantsJson())
        {
            return response()->json([], 204);
        }
        else
        {
            session()->flash('success_message', 'Операция прошла успешно!');
            return redirect('/admin/resources/staff');
        }
    }
}
