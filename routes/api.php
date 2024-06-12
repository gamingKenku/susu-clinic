<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkingHoursController;
use App\Http\Controllers\VacancyController;
use App\Models\Clinic;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'admin/resources/events' => EventController::class,
    'admin/resources/documents' => DocumentController::class,
    'admin/resources/clinics' => ClinicController::class,
    'admin/resources/categories' => CategoryController::class,
    'admin/resources/services' => ServiceController::class,
    'admin/resources/discounts' => DiscountsController::class,
    'admin/resources/staff' => StaffController::class,
    'admin/resources/positions' => PositionController::class,
    'admin/resources/working-hours' => WorkingHoursController::class,
    'admin/resources/users' => UserController::class,
    'admin/content/links' => LinksController::class
]);
