<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchTasks(Request $request)
    {
        $users = User::where('role_id', 1)->where('deleted_at', null)->get();
        $normalUsers = User::where('deleted_at', null)->get();

        $tasks = Task::where('title', 'like', '%' . $request->search . '%')
            ->orWhereHas('project', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('customer', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->get();
    
        return view('admin.tasks.index', compact('tasks', 'users', 'normalUsers'));
    }

    public function searchProjects(Request $request)
    {
        $users = User::where('deleted_at', null)->get();

        // get all projects where title is like $request->search
        $projects = Project::where('title', 'like', '%' . $request->search . '%')
            ->orWhereHas('customer', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('department', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->get();

        return view('admin.projects.index', compact('projects', 'users'));

    }

    public function searchUser(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('email', 'like', '%' . $request->search . '%')
            ->orWhere('status', 'like', '%' . $request->search . '%')
            ->orWhereHas('department', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('customer', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orWhereHas('role', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function searchCustomer(Request $request)
    {
        $customers = Customer::where('name', 'like', '%' . $request->search . '%')->get();

        return view('admin.customers.index', compact('customers'));
    }
}
