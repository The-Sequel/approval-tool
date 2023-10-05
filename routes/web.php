<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\MessageController;

// Customer Controllers
use App\Http\Controllers\customer\ProjectController as CustomerProjectController;
use App\Http\Controllers\customer\TaskController as CustomerTaskController;
use App\Http\Controllers\customer\MessageController as CustomerMessageController;
use App\Http\Controllers\customer\UserController as CustomerUserController;
use App\Http\Controllers\customer\CustomerController as CustomerCustomerController;
use App\Http\Controllers\customer\ContactController as CustomerContactController;

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
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');

    // Customer
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/admin/customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');
    Route::post('/admin/customers', [CustomerController::class, 'store'])->name('admin.customers.store');
    Route::get('/admin/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('/admin/customers/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

    // Project
    Route::get('/admin/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::get('admin/projects/show/{project}', [ProjectController::class, 'show'])->name('admin.projects.show');
    Route::delete('/admin/project/{project}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
    Route::post('/admin/projects/finish/{project}', [ProjectController::class, 'finish'])->name('admin.projects.finish');

    // Task
    Route::get('/admin/tasks', [TaskController::class, 'adminIndex'])->name('admin.tasks.index');
    Route::get('/admin/tasks/create/', [TaskController::class, 'adminCreate'])->name('admin.tasks.create');
    Route::post('/admin/tasks', [TaskController::class, 'store'])->name('admin.tasks.store');
    Route::get('/admin/tasks/create/{project}', [TaskController::class, 'projectCreate'])->name('admin.tasks.project.create');
    Route::get('/admin/tasks/show/{task}', [TaskController::class, 'show'])->name('admin.tasks.show');
    Route::put('/admin/tasks/finish/{task}', [TaskController::class, 'finish'])->name('admin.tasks.finish');
    Route::delete('/admin/tasks/{task}', [TaskController::class, 'destroy'])->name('admin.tasks.destroy');

    // Messages
    Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.messages.index');



    // Customer side
    Route::get('/', [CustomerCustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/contact', [CustomerContactController::class, 'index'])->name('customer.contact');
    Route::post('/contact', [CustomerContactController::class, 'send'])->name('customer.contact.send');

    // User
    Route::get('/users', [CustomerUserController::class, 'index'])->name('customer.users.index');

    // Project
    Route::get('/projects', [CustomerProjectController::class, 'index'])->name('customer.projects.index');
    Route::get('/projects/show/{project}', [CustomerProjectController::class, 'show'])->name('customer.projects.show');

    // Task
    Route::get('/tasks', [CustomerTaskController::class, 'index'])->name('customer.tasks.index');
    Route::get('/tasks/show/{task}', [CustomerTaskController::class, 'show'])->name('customer.tasks.show');
    Route::put('/tasks/finish/{task}', [CustomerTaskController::class, 'finish'])->name('customer.tasks.finish');
    Route::get('/tasks/approve/{task}', [CustomerTaskController::class, 'approve'])->name('customer.tasks.approve');

    // Messages
    Route::get('/messages', [CustomerMessageController::class, 'index'])->name('customer.messages.index');


    // Test mails
    Route::get('/mail', function () {
        $task = App\Models\Task::find(1);
        return new App\Mail\Tasks\NewTaskMail($task);
    });
});

// Project routes

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/show/{project}', [ProjectController::class, 'show'])->name('project.show');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
    Route::put('/project/{project}', [ProjectController::class, 'updateProject'])->name('project.update');
});

// Route::get('/', function () {
//     $customers = Customer::all();
//     $projects = Project::all();
//     return view('dashboard', compact('customers', 'projects'));
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', function () {
    return view('test');
})->name('test');

require __DIR__.'/auth.php';
