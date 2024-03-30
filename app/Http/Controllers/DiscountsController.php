<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Service;
use Illuminate\Http\Request;

class DiscountsController extends Controller
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
        $discounts = Discount::query();

        if ($request->has('filter'))
        {
            $discounts = $this->filterColumns($discounts, $request->input('filter'), ['header', 'start_date', 'end_date']);
            $discounts = $this->filterRelatedColumns($discounts, $request->input('filter'), [
                'services' => ['name']
            ]);
        }

        $discounts = $discounts->orderBy('start_date')->paginate(25);

        return view('resources.discounts.index', [
            'discounts' => $discounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.discounts.create', [
            'services' => Service::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'header' => ['required', 'max:255'],
            'markup' => ['required', 'max:16777215'],
            'start_date' => ['date', 'before_or_equal:end_date'],
            'end_date' => ['date'],
            'services' => ['array'],
            'services.*' => ['exists:services,id'],
        ]);

        $discount = Discount::create([
            'header' => $validated_data['header'],
            'markup' => $validated_data['markup'],
            'start_date' => $validated_data['start_date'],
            'end_date' => $validated_data['end_date'],
        ]);

        $discount->services()->attach($validated_data['services']);

        $discount->save();

        return redirect('/admin/resources/discounts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('resources.discounts.show', [
            'discount' => Discount::query()->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('resources.discounts.edit', [
            'services' => Service::query()->orderBy('name')->get(),
            'discount' => Discount::query()->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_data = $request->validate([
            'header' => ['required', 'max:255'],
            'markup' => ['required', 'max:16777215'],
            'start_date' => ['date', 'before_or_equal:end_date'],
            'end_date' => ['date'],
            'services' => ['array'],
            'services.*' => ['exists:services,id'],
        ]);

        $discount = Discount::query()->findOrFail($id);
        $discount->header = $validated_data['header'];
        $discount->markup = $validated_data['markup'];
        $discount->start_date = $validated_data['start_date'];
        $discount->end_date = $validated_data['end_date'];

        $discount->services()->sync($validated_data['services']);

        $discount->save();

        return redirect('/admin/resources/discounts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Discount::query()->findOrFail($id)->delete();

        return redirect('/admin/resources/discounts');
    }
}
