<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $projects = Project::where('customer_id', $user->customer_id)->get();
        $departments = Department::all();
        $users = User::where('deleted_at', null)->get();
        return view('customer.projects.index', compact('projects', 'departments', 'users'));
    }

    public function show(Project $project)
    {
        $tasks = Task::where('project_id', $project->id)->orderBy('created_at', 'desc')->get();
        $users = User::Where('role_id', 1)->where('deleted_at', null)->get();
        $normalUsers = User::where('deleted_at', null)->get();
        return view('customer.projects.show', compact('project', 'tasks', 'users', 'normalUsers'));
    }
}
