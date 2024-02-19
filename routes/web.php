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
    'admin/resources/working-hours' => ClinicController::class,
    'admin/resources/positions' => PositionController::class,
    // 'admin/resources/vacancies' => VacancyController::class,
    'admin/resources/users' => UserController::class,
]);


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/resources', [AdminController::class, 'resources'])->name('resources');
Route::get('/admin/moderation')->name('moderation');

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// Auth::routes([
//     'register' => false,
//     'reset' => false,
// ]);
