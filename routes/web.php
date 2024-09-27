<?php

use App\Http\Controllers\BaremeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MissionOrderController;
use App\Http\Controllers\MissionApproveController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Home route, which redirects based on user roles
Route::get('/', function () {
    if (auth()->check()) {
        /*$role = auth()->user()->employee->role;

        switch ($role) {
            case 'employee':
            case 'supervisor':
                return redirect()->route('mission_orders.index');
            case 'hr':
                return redirect()->route('mission_orders.hrIndex');
            case 'sg':
                return redirect()->route('mission_orders.sgIndex');
            default:
                return redirect()->route('login');
        }*/
        return redirect()->route('mission_orders.index');
    } else {
        return redirect()->route('login');
    }
})->middleware('auth');

// Mission Orders routes


// Mission Orders additional routes for HR and SGA role-specific views
//Route::get('mission_orders/hr','MissionOrderController@hrIndex')->name('mission_orders.hrIndex');
/*Route::get('mission_orders/hr', [MissionOrderController::class, 'hrIndex'])->name('mission_orders.hrIndex')->middleware('auth', 'role:hr');
Route::get('mission_orders/sg', [MissionOrderController::class, 'sgIndex'])->name('mission_orders.sgIndex')->middleware('auth', 'role:sg');*/
Route::resource('mission_orders', MissionOrderController::class)->middleware('auth');
// routes/web.php

Route::get('/mission-orders/{id}/report', [MissionOrderController::class, 'showReport'])->middleware('auth')->name('mission_orders.report');


// Mission Approves routes
Route::resource('mission_approves', MissionApproveController::class)->middleware('auth');
Route::get('mission_approves/supervisor_approve/{missionOrder}',[MissionApproveController::class, 'supervisor_approve'])->name('supervisor_approve')->middleware(['auth', 'role:supervisor']);
Route::get('mission_approves/hr_approve/{missionOrder}',[MissionApproveController::class, 'hr_approve'])->name('hr_approve')->middleware(['auth', 'role:hr']);
Route::get('mission_approves/sg_approve/{missionOrder}',[MissionApproveController::class, 'sg_approve'])->name('sg_approve')->middleware(['auth', 'role:sg']);

// Expenses routes
Route::resource('expenses', ExpenseController::class)->middleware('auth');

// Employees routes (restricted to HR only)
Route::resource('employees', EmployeeController::class)->middleware(['auth', 'role:hr']);

// Departments routes (could be accessible to all roles depending on the policy)
Route::resource('departments', DepartmentController::class)->middleware(['auth', 'role:hr']);

// Baremes routes
Route::resource('baremes', BaremeController::class)->middleware(['auth','role:hr']);

// Authentication routes (Laravel Breeze)
require __DIR__ . '/auth.php';
