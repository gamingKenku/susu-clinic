<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $services = Service::query();

        if ($request->has('filter'))
        {
            $services = $this->filterColumns($services, $request->input('filter'), ['name', 'price']);
            $services = $this->filterRelatedColumns($services, $request->input('filter'), [
                'discounts' => [
                    'header',
                ],
                'category' => [
                    'name',
                ]
            ]);
        }

        $services = $services->orderBy('category_id')->orderBy('name')->paginate(25);

        if ($request->wantsJson())
        {
            return response()->json([
                'services' => $services
            ]);
        }
        else
        {
            return view('resources.services.index', [
                'services' => $services
            ]);        
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.services.create', [
            'categories' => Category::query()->orderBy('name')->get(),
            'discounts' => Discount::query()->orderBy('start_date')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'decimal:0,2', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'discounts' => ['array'],
            'discounts.*' => ['exists:discounts,id'],
        ]);

        $service = Service::create([
            'name' => $validated_data['name'],
            'price' => $validated_data['price'],
            'category_id' => $validated_data['category_id'],
        ]);

        if (array_key_exists('discounts', $validated_data))
        {
            $service->discounts()->attach($validated_data['discounts']);
        }

        $service->save();


        if ($request->wantsJson())
        {
            return response()->json([
                'service' => $service
            ]);
        }
        else
        {
            return redirect('/admin/resources/services');
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
                'service' => Service::query()->findOrFail($id)
            ]);
        }
        else
        {
            return view('resources.services.show', ['service' => Service::query()->findOrFail($id)]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.services.edit', [
            'service' => Service::query()->findOrFail($id),
            'categories' => Category::query()->orderBy('name')->get(),
            'discounts' => Discount::query()->orderBy('start_date')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'decimal:0,2', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'discounts' => ['array'],
            'discounts.*' => ['exists:discounts,id'],
        ]);

        $service = Service::query()->findOrFail($id);

        $service->name = $validated_data['name'];
        $service->price = $validated_data['price'];
        $service->category()->associate(Category::query()->findOrFail($validated_data['category_id']));
        if (array_key_exists('discounts', $validated_data))
        {
            $service->discounts()->sync($validated_data['discounts']);
        }
        
        $service->save();

        if ($request->wantsJson())
        {
            return response()->json([
                'service' => $service
            ]);
        }
        else
        {
            return redirect('/admin/resources/services');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Service::query()->findOrFail($id)->delete();

        if ($request->wantsJson())
        {
            return response()->json([], 204);
        }
        else
        {
            return redirect('/admin/resources/services');
        }
    }
}
