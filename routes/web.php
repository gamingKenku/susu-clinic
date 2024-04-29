<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkingHoursController;
use App\Http\Controllers\VacancyController;
use App\Models\Clinic;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::resources([
    'admin/resources/events' => EventController::class,
    'admin/resources/documents' => DocumentController::class,
    'admin/resources/clinics' => ClinicController::class,
    'admin/resources/categories' => CategoryController::class,
    'admin/resources/services' => ServiceController::class,
    'admin/resources/discounts' => DiscountsController::class,
    'admin/resources/staff' => StaffController::class,
    'admin/resources/positions' => PositionController::class,
    'admin/resources/working-hours' => WorkingHoursController::class,
    // 'admin/resources/vacancies' => VacancyController::class,
    'admin/resources/users' => UserController::class,
]);

// Route::get('admin/resources/working-hours', [WorkingHoursController::class, 'index'])->name('working_hours.index');
// Route::get('admin/resources/working-hours/create', [WorkingHoursController::class, 'create'])->name('working_hours.create');
// Route::post('admin/resources/working-hours', [WorkingHoursController::class, 'store'])->name('working_hours.store');
// Route::get('admin/resources/working-hours/{id}', [WorkingHoursController::class, 'show'])->name('working_hours.show');
// Route::get('admin/resources/working-hours/{id}/edit', [WorkingHoursController::class, 'edit'])->name('working_hours.edit');
// Route::put('admin/resources/working-hours/{id}', [WorkingHoursController::class, 'update'])->name('working_hours.update');
// Route::delete('admin/resources/working-hours/{id}', [WorkingHoursController::class, 'destroy'])->name('working_hours.destroy');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/about', [HomeController::class, 'about'])->name('about');
Route::get('/home/management', [HomeController::class, 'managementIndex'])->name('managementIndex');
Route::get('/home/staff', [HomeController::class, 'staffIndex'])->name('staffIndex');
Route::get('/home/staff/{id}', [HomeController::class, 'staffShow'])->name('staffShow');
Route::get('/home/services', [HomeController::class, 'servicesIndex'])->name('servicesIndex');
Route::get('/home/services/{id}', [HomeController::class, 'servicesShow'])->name('servicesShow');
Route::get('/home/contacts', [HomeController::class, 'contactsIndex'])->name('contactsIndex');
Route::get('/home/feedback', [HomeController::class, 'feedbackIndex'])->name('feedbackIndex');
Route::get('/home/feedback/create', [HomeController::class, 'feedbackCreate'])->name('feedbackCreate');
Route::post('/home/feedback', [HomeController::class, 'feedbackStore'])->name('feedbackStore');
Route::get('/home/schedule', [HomeController::class, 'workingHoursIndex'])->name('workingHoursIndex');
Route::get('/home/discounts', [HomeController::class, 'discountsIndex'])->name('discountsIndex');
Route::get('/home/discounts/{id}', [HomeController::class, 'discountsShow'])->name('discountsShow');
Route::get('/home/vacancies', [HomeController::class, 'vacanciesIndex'])->name('vacanciesIndex');
Route::get('/home/vacancies/{id}', [HomeController::class, 'vacanciesShow'])->name('vacanciesShow');


Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/resources', [AdminController::class, 'resources'])->name('resources');

Route::get('/admin/moderation', [AdminController::class, 'moderationIndex'])->name('moderationIndex');
Route::get('/admin/moderation/{feedback}', [AdminController::class, 'moderationEdit'])->name('moderationEdit');
Route::put('/admin/moderation/{feedback}', [AdminController::class, 'moderationUpdate'])->name('moderationUpdate');

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// Auth::routes([
//     'register' => false,
//     'reset' => false,
// ]);
