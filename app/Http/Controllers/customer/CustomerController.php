<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\Project;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $today = now();
        $inFiveDays = now()->addDays(5);

        $user = auth()->user();
        $tasks = Task::where('customer_id', $user->customer_id)->orderBy('created_at', 'desc')->take(3)->get();
        $tasksWithDeadlineCount = count(Task::where('customer_id', $user->customer_id)->whereNotNull('deadline')->get());

        // $tasksWithDeadlineCount = Task::where('customer_id', $user->customer_id)
        //     ->whereNotNull('deadline')
        //     ->whereDate('deadline', '>=', $today)
        //     ->whereDate('deadline', '<=', $inFiveDays)
        //     ->get()
        //     ->count();


        $projectsCount = count(Project::where('customer_id', $user->customer_id)->where('status', '!=', 'approved')->get());
        $projects = Project::where('customer_id', $user->customer_id)->where('status', '!=', 'approved')->orderBy('created_at', 'desc')->take(3)->get();
        return view('customer.dashboard', compact('tasks', 'projects', 'tasksWithDeadlineCount', 'projectsCount'));
    }
}
