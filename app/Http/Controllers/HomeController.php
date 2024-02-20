<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clinic;
use App\Models\Discount;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Staff;
use App\Models\Position;
use App\Models\WorkingHours;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('home.index', [
            'events' => Event::query()->latest()->take(5),
            'discounts' => Discount::query()->latest()->take(3),
            'categories' => Category::query()->orderBy('created_at')->take(15),
            'clinics' => Clinic::all(),
        ]);
    }

    public function staffIndex(Request $request)
    {
        $staff = Staff::query();

        if ($request->has('last_name_filter')) {
            $last_name_filter = $request->input('last_name_filter');

            $staff = $staff->where('last_name', 'like', "%{{$last_name_filter}}%");
        }

        if ($request->has('type_filter')) {
            $staff = $staff->where('staff_type', '=', $request->input('type_filter'));
        }

        $staff = $staff->paginate(16);

        return view('home.staff', [
            'staff' => $staff,
        ]);
    }

    public function feedbackIndex()
    {
        return view('home.feedback.index', [
            'feedback' => Feedback::query()
                            ->where('moderated', '=', true)
                            ->where('blocked', '=', false)
                            ->orderBy('created_at')
                            ->paginate(12),
        ]);
    }

    public function feedbackCreate()
    {
        return view('home.feedback.create');
    }

    public function feedbackStore(Request $request)
    {
        $validated_data = $request->validate([
            'content' => ['required', 'max:65535'],
            'author' => ['required', 'max:255'],
            'rating' => ['required', 'integer', 'gte:1', 'lte:5'],
            'mail' => ['required', 'max:255', 'email'],
        ]);

        Feedback::create([
            'content' => $validated_data['content'],
            'author' => $validated_data['author'],
            'rating' => $validated_data['rating'],
            'mail' => $validated_data['mail'],
            'moderated' => false,
            'blocked' => false,
        ]);

        return redirect(route('feedbackIndex'));
    }

    public function servicesIndex()
    {
        return view('home.services.index', [
            'clinics' => Clinic::all(),
        ]);
    }
    
    public function servicesShow(string $id)
    {
        return view('home.services.show', [
            'services' => Category::query()->findOrFail($id)->services(),
        ]);
    }

    public function managementIndex()
    {
        return view('home.management', [
            'management' => Staff::query()->where('staff_type', '=', 'administrator'),
        ]);
    }

    public function contactsIndex()
    {
        return view('home.contacts', [
            'clinics' => Clinic::all(),
        ]);
    }

    public function discountsIndex()
    {
        return view('home.discounts.index', [
            'discounts' => Discount::query()->latest()->paginate(10),
        ]);
    }

    public function discountsShow(string $id)
    {
        return view('home.discounts.show', [
            'discount' => Discount::query()->findOrFail($id),
        ]);
    }

    public function vacanciesIndex()
    {
        return view('home.vacancies.index', [
            'positions' => Position::query()->where('has_vacancy', '=', true)->paginate(10),
        ]);
    }

    public function vacanciesShow(string $id)
    {
        return view('home.vacancies.show', [
            'position' => Position::query()->findOrFail($id),
        ]);
    }

    public function workingHoursIndex(Request $request)
    {
        $staff = Staff::query();

        if ($request->has('last_name_filter')) {
            $last_name_filter = $request->input('last_name_filter');
            $staff = Staff::query()->where('staff_type', '=', 'doctor')->where('last_name', 'like', "%{{$last_name_filter}}%");
        }

        $staff = $staff->get();

        return view('home.working_hours', [
            'staff' => $staff, 
        ]);
    }
}
