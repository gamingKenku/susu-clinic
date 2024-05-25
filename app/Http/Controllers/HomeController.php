<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clinic;
use App\Models\Discount;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Staff;
use App\Models\Position;
use App\Models\Service;
use App\Models\WorkingHours;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('home.index', [
            'events' => Event::query()->latest()->take(5)->get(),
            'discounts' => Discount::query()->whereDate('start_date', '<=', now('Asia/Yekaterinburg'))->whereDate('end_date', '>=', now('Asia/Yekaterinburg'))->latest('end_date')->take(3)->get(),
            'categories' => Category::query()->orderBy('name')->take(18)->get(),
            'clinics' => Clinic::all(),
        ]);
    }

    public function eventShow(string $id, Request $request)
    {
        return view('home.events.show', [
            'event' => Event::findOrFail($id),
        ]);
    }

    public function about()
    {
        return view('home.about', [
            'about' => Storage::get('content_html\about.html'),
        ]);
    }

    public function staffIndex(Request $request)
    {
        $staff = Staff::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->orderBy('patronym');

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

        $staff = $staff->paginate(16);

        return view('home.staff.index', [
            'staff' => $staff,
            'clinics' => Clinic::all(),
        ]);
    }

    public function staffShow(Request $request, $id)
    {
        return view('home.staff.show', [
            'staff' => Staff::findOrFail($id),
        ]);
    }

    public function feedbackIndex()
    {
        return view('home.feedback.index', [
            'feedback' => Feedback::query()
                            ->where('moderated', '=', true)
                            ->where('blocked', '=', false)
                            ->latest('created_at')
                            ->paginate(12),
            'clinics' => Clinic::all(),
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

    public function servicesIndex(Request $request)
    {    
        if ($request->has('filter')) 
        {
            $filter = strtolower($request->input('filter'));
    
            $categories = Clinic::where('name', '=', $filter)->first()->categories()->orderBy('name')->get();
        }
        else 
        {
            $categories = Clinic::where('name', '=', Clinic::first()->name)->first()->categories()->orderBy('name')->get();
        }

        $services = Service::query()->whereIn('category_id', $categories->pluck('id'))->orderBy('name')->get();
    
        return view('home.services.index', [
            'clinics' => Clinic::all(),
            'categories' => $categories,
            'services' => $services,
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
            'contacts' => Storage::get('content_html\contacts.html'),
        ]);
    }

    public function discountsIndex()
    {
        $now = Carbon::now();

        $current_discounts = Discount::query()
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->paginate(10);

        return view('home.discounts.index', [
            'discounts' => $current_discounts,
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
            'vacancies' => Position::query()->where('has_vacancy', '=', true)->paginate(10),
        ]);
    }

    public function vacanciesShow(string $id)
    {
        $vacancy = Position::query()->findOrFail($id);

        if (!$vacancy->has_vacancy)
        {
            abort(404);
        }

        return view('home.vacancies.show', [
            'vacancy' => $vacancy,
        ]);
    }

    public function workingHoursIndex(Request $request)
    {
        $staff = Staff::query()
            ->whereIn('staff_type', ['doctor', 'administrator'])
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->orderBy('patronym');

        if ($request->has('filter')) 
        {
            $filter = strtolower($request->input('filter'));

            $staff = $this->filterColumns($staff, $filter, [
                'first_name',
                'last_name',
                'patronym',
            ]);
        }

        $staff = $staff->paginate(15);

        return view('home.working_hours', [
            'staff' => $staff, 
        ]);
    }

    public function licenseShow(Request $request)
    {
        return response()->file(public_path() . "\storage\license.pdf")->setPrivate();
    }
}
