<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tasks = Task::where('customer_id', $user->customer_id)->orderBy('created_at', 'desc')->take(3)->get();
        $tasksWithDeadlineCount = count(Task::where('customer_id', $user->customer_id)->whereNotNull('deadline')->get());
        $projectsCount = count(Project::where('customer_id', $user->customer_id)->get());
        $projects = Project::where('customer_id', $user->customer_id)->orderBy('created_at', 'desc')->take(3)->get();
        return view('customer.dashboard', compact('tasks', 'projects', 'tasksWithDeadlineCount', 'projectsCount'));
    }
}
