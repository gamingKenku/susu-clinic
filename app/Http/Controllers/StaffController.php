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
    public function index()
    {
        return view('resources.staff.index', [
            'staffObjects' => Staff::query()->orderBy('staff_type')->orderBy('last_name')->orderBy('first_name')->orderBy('patronym')->paginate(25),
        ]);
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
        $validated_data = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'patronym' => ['max:255'],
            'specialities' => ['required', 'max:16777215'],
            'experience' => ['required', 'date', 'before:now'],
            'photo_path' => ['file', 'image'],
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

        $path = $request->file('photo_path')->storeAs('staff_photos', "staff{$staff->id}" . '.' . $request->file('photo_path')->getExtension());
        $staff->photo_path = $path;
        $staff->positions()->attach($validated_data['positions']);

        $staff->save();

        return redirect('/admin/resources/staff');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('resources.staff.show', [
            'staff' => Staff::query()->findOrFail($id),
        ]);
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
            'patronym' => ['max:255', 'string'],
            'specialities' => ['required', 'max:16777215'],
            'experience' => ['required', 'date', 'before:now'],
            'photo_path' => ['file', 'image'],
            'staff_type' => ['required', 'in:doctor,nurse,administrator'],
            'positions' => ['array'],
            'positions.*' => ['exists:positions,id'],
        ]);

        $staff = Staff::query()->findOrFail($id);

        $staff->first_name = $validated_data['first_name'];
        $staff->last_name = $validated_data['last_name'];
        $staff->patronym = $validated_data['patronym'];
        $staff->specialities = $validated_data['specialities'];
        $staff->experience = $validated_data['experience'];
        $staff->staff_type = $validated_data['staff_type'];
        $staff->positions()->sync($validated_data['positions']);

        Storage::delete($staff->photo_path);
        $path = $request->file('photo_path')->storeAs('staff_photos', "staff{$staff->id}" . '.'. $request->file('photo_path')->getExtension());
        $staff->photo_path = $path;

        $staff->save();

        return redirect('/admin/resources/staff');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::query()->findOrFail($id);

        Storage::delete($staff->photo_path);

        $staff->delete();
        
        return redirect('/admin/resources/staff');
    }
}
