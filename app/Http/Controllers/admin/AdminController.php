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
        $today = date('Y-m-d');
        $oneWeekLater = date('Y-m-d', strtotime('+1 week'));

        $tasksWithDeadline = Task::whereBetween('deadline', [$today, $oneWeekLater])
                         ->where('status', '!=', 'completed')
                         ->get();
                         
        $tasksWithDeadlineCount = count($tasksWithDeadline);
        $customers = Customer::all();
        // get all projects where status is not completed
        

        $projects = Project::orderBy('created_at', 'desc')->where('status', '!=', 'completed')->take(3)->get();
        $projectsCount = count(Project::all()->where('status', '!=', 'completed'));
        $tasks = Task::orderBy('created_at', 'desc')->where('status', '=', 'pending')->take(3)->get();
        $users = User::where('deleted_at', null)->get();
        return view('admin.dashboard', compact('customers', 'projects', 'users', 'tasks', 'tasksWithDeadline', 'tasksWithDeadlineCount', 'projectsCount'));
    }
}
