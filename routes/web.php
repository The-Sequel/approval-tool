<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

// Models
use App\Models\Customer;
use App\Models\Project;
use App\Models\User;

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

// Admin routes

Route::middleware(['auth', 'verified'])->group(function () {
    // Admin side
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // User
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destory'])->name('admin.users.destroy');

    // Customer
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/admin/customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');
    Route::post('/admin/customers', [CustomerController::class, 'store'])->name('admin.customers.store');
    Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    // Project
    Route::get('/admin/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    // Route::get('/admin/projects', [ProjectController::class, 'adminIndex'])->name('admin.projects.index');
    Route::get('admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::get('admin/show/{id}', [ProjectController::class, 'show'])->name('admin.projects.show');

    // Task
    Route::get('/admin/tasks', [TaskController::class, 'adminIndex'])->name('admin.tasks.index');
    Route::get('/admin/tasks/create', [TaskController::class, 'adminCreate'])->name('admin.tasks.create');
    Route::post('/admin/tasks', [TaskController::class, 'store'])->name('admin.tasks.store');

    Route::get('/admin/logs', [LogController::class, 'index'])->name('admin.logs.index');

    // Messages
    Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages.index');


    // Filter
    Route::get('/filter-projects', [FilterController::class, 'filterProjects'])->name('filter.projects');
});

// Project routes

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/show/{project}', [ProjectController::class, 'show'])->name('project.show');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
    Route::put('/project/{project}', [ProjectController::class, 'updateProject'])->name('project.update');
});

Route::get('/', function () {
    $customers = Customer::all();
    $projects = Project::all();
    return view('dashboard', compact('customers', 'projects'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    return view('test');
})->name('test');

require __DIR__.'/auth.php';
