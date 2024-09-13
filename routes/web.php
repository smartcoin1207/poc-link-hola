<?php

// Controllers

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BikeCalculateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectDetailController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\SolarCalculateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationStatusController;
use Illuminate\Support\Facades\Artisan;
// Packages
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => ['role:admin']], function() {
        Route::get('/role-permission', [RolePermission::class, 'index'])->name('role.permission.list');
        Route::resource('permission', PermissionController::class);
        Route::resource('role', RoleController::class);
    });
    // Permission Module
    // Route::get('/role-permission',[RolePermission::class, 'index'])->name('role.permission.list');
    // Route::resource('permission',PermissionController::class);
    // Route::resource('role', RoleController::class);

    Route::get('register-step2', [RegisteredUserController::class, 'showStep2'])->name('register.step2');
    Route::post('register-step2', [RegisteredUserController::class, 'postStep2'])->name('register.step2');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile-detailed', [ProfileController::class, 'updateDetailed'])->name('profile.update.detailed');
    Route::get('/bike-calculate', [BikeCalculateController::class, 'form'])->name('bike.form');
    Route::post('/bike-calculate', [BikeCalculateController::class, 'action'])->name('bike.action');
    Route::get('/bike-check', [BikeCalculateController::class, 'check'])->name('bike.check');

    Route::get('/solar-calculate-upload', [SolarCalculateController::class, 'upload'])->name('solar.calculate.upload');
    Route::post('/solar-calculate-upload-csv', [SolarCalculateController::class, 'uploadCsv'])->name('solar.calculate.upload_csv');
    Route::get('/solar-calculate-processed-data', [SolarCalculateController::class, 'processedData'])->name('solar.calculate.processed_data');

    Route::resource('users', UserController::class);

    Route::resource('solar-calculate', SolarCalculateController::class, [
        'names' => [
            'index' => 'solar.calculate.index',
            'create' => 'solar.calculate.create',
            'store' => 'solar.calculate.store',
            'show' => 'solar.calculate.show',
            'edit' => 'solar.calculate.edit',
            'update' => 'solar.calculate.update',
            'destroy' => 'solar.calculate.destroy',
        ]
    ]);

    Route::resource('project_details', ProjectDetailController::class, [
        'except' => ['edit'],
        'names' => [
            'index' => 'project.detail.index',
            'create' => 'project.detail.create',
            'store' => 'project.detail.store',
            'show' => 'project.detail.show',
            'update' => 'project.detail.update',
            'destroy' => 'project.detail.destroy',
        ]
    ]);
    Route::get('/project_details/{id}/edit', [ProjectDetailController::class, 'edit'])->name('project.detail.edit');

    //Evaluator
    Route::get('/project-evaluate', [ProjectDetailController::class, 'projectEvaluateIndex'])->name('project.detail_evaluate.index');
    Route::get('/project-evaluate/{projectDetail}', [ProjectDetailController::class, 'evaluateShow'])->name('project.detail_evaluate.show');

    Route::patch('/project/{id}/approve', [ProjectDetailController::class, 'approve'])->name('project.detail_evaluate.approve');
    Route::patch('/project/{id}/reject', [ProjectDetailController::class, 'reject'])->name('project.detail_evaluate.reject');

    Route::get('/project-verification', [VerificationStatusController::class, 'index'])->name('project.verification.index');
});

//Auth pages Routs
Route::group(['prefix' => 'auth'], function() {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});
