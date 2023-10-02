<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $projects = Project::where('customer_id', $user->customer_id)->get();
        return view('customer.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $tasks = Task::where('project_id', $project->id)->get();
        return view('customer.projects.show', compact('project', 'tasks'));
    }
}
