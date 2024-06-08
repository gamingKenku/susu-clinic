<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clinic;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::query();

        if ($request->has('filter'))
        {
            $categories = $this->filterColumns($categories, $request->input('filter'), ['name']);
            $categories = $this->filterRelatedColumns($categories, $request->input('filter'), [
                'clinic' => ['name']
            ]);
        }
        
        $categories = $categories->orderBy('clinic_id')->orderBy('name')->paginate(25);

        return view('resources.categories.index', ['categoriesObjects' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.categories.create', ['clinics' => Clinic::query()->orderBy('name')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'max:255'],
            'clinic_id' => ['required', 'exists:clinics,id'],
        ]);

        Category::create([
            'name' => $validated_data['name'],
            'clinic_id' => $validated_data['clinic_id'],
        ]);

        return redirect('/admin/resources/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('resources.categories.show', ['categories' => Category::query()->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.categories.edit', [
            'categories' => Category::query()->findOrFail($id),
            'clinics' => Clinic::query()->orderBy('name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'max:255'],
            'clinic_id' => ['required', 'exists:clinics,id'],
        ]);

        $category = Category::query()->findOrFail($id);

        $category->name = $validated_data['name'];
        $category->clinic()->associate(Clinic::query()->findOrFail($validated_data['clinic_id']));
        
        $category->save();

        return redirect('/admin/resources/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::query()->findOrFail($id)->delete();

        return redirect('/admin/resources/categories');
    }
}
