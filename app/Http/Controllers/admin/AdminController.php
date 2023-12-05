<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Customer;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $tasksWithDeadline = Task::where('deadline', date('Y-m-d'))->where('status', '!=', 'completed')->get();
        $tasksWithDeadlineCount = count($tasksWithDeadline);
        $customers = Customer::all();
        $projects = Project::orderBy('created_at', 'desc')->take(3)->get();
        $projectsCount = count(Project::all());
        $tasks = Task::orderBy('created_at', 'desc')->where('status', '=', 'pending')->take(3)->get();
        $users = User::where('deleted_at', null)->get();
        return view('admin.dashboard', compact('customers', 'projects', 'users', 'tasks', 'tasksWithDeadline', 'tasksWithDeadlineCount', 'projectsCount'));
    }
}
