<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchTask(Request $request)
    {
        $users = User::where('role_id', 1)->where('deleted_at', null)->get();
        $user = auth()->user();
        $normalUsers = User::where('deleted_at', null)->get();

        // dd($request->project_id);

        if($request->project_id == null)
        {
            $tasks = Task::where('customer_id', $user->customer_id)->where('title', 'like', '%' . $request->search . '%')->get();

            return view('customer.tasks.index', compact('tasks', 'users', 'normalUsers'));
        } else {
            $project = Project::where('id', $request->project_id)->first();

            $tasks = Task::where('project_id', $request->project_id)->where('customer_id', $user->customer_id)
                ->where('title', 'like', '%' . $request->search . '%')
                ->get();

            // dd('customer.project.show');

            return view('customer.projects.show', compact('tasks', 'users', 'project'));
        }

    }

    public function searchProject(Request $request)
    {
        $users = User::where('role_id', 1)->where('deleted_at', null)->get();

        $user = auth()->user();

        $projects = Project::where('customer_id', $user->customer_id)->where('title', 'like', '%' . $request->search . '%')->get();

        return view('customer.projects.index', compact('projects', 'users'));
    }

    public function statusTask(Request $request)
    {
        $users = User::where('role_id', 1)->where('deleted_at', null)->get();
        $user = auth()->user();

        if($request->project_id == null){
            return view('customer.tasks.index', compact('users'));
        } else {
            $project = Project::where('id', $request->project_id)->first();

            $tasks = Task::where('project_id', $request->project_id)->where('customer_id', $user->customer_id)->where('status', $request->status)->get();

            return view('customer.projects.show', compact('users', 'project', 'tasks'));
        }
    }
}
