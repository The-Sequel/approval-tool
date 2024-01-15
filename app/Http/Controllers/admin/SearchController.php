<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchProjects(Request $request) {
        $projectsArray = Project::query();

        $users = User::where('deleted_at', null)->get();
        $departments = Department::all();
        $departmentChoice = Department::where('id', $request['department'])->first();
        $status = $request['status'];
        $date = $request->date != null ? date('Y-m-d', strtotime($request->date)) : "";
        $deadline = $request->deadline != null ? date('Y-m-d', strtotime($request->deadline)) : "";

        if ($request['search'] != null) {
            $projectsArray->where('title', 'like', '%' . $request['search'] . '%');

        }
        if ($request['date'] != null) {
            $projectsArray->where('created_at', 'like', '%' . $date . '%');
        }
        if($request['status'] != null) {
            $projectsArray->where('status', $request['status']);
        }
        if($request['department'] != null) {
            $projectsArray->where('department_id', $request['department']);
        }
        if($request['deadline'] != null){
            $projectsArray->where('deadline', 'like', '%' . $request['deadline'] . '%');
        }

        $projects = $projectsArray->with('customer', 'department')->get()->toArray();

        return view('admin.projects.index', compact('projects', 'users', 'date', 'departments', 'departmentChoice', 'status', 'deadline'));
    }

    public function searchTasks(Request $request){
        $tasksArray = Task::query();

        $users = User::where('deleted_at', null)->get();
        $status = $request['status'];
        $date = $request->date != null ? date('Y-m-d', strtotime($request->date)) : "";
        $deadline = $request->deadline != null ? date('Y-m-d', strtotime($request->deadline)) : "";


        if($request['search'] != null){
            $tasksArray->where('title', 'like', '%' . $request['search'] . '%');
        }
        if($request['date'] != null){
            $tasksArray->where('created_at', 'like', '%' . $request['date'] . '%');
        }
        if($request['status'] != null){
            $tasksArray->where('status', $request['status']);
        }
        if($request['deadline'] != null){
            $tasksArray->where('deadline', 'like', '%' . $request['deadline'] . '%');
        }

        $tasks = $tasksArray->with('customer', 'department')->get()->toArray();

        return view('admin.tasks.index', compact('tasks', 'users', 'status', 'date', 'deadline'));
    }

    public function searchUsers(Request $request){
        $usersArray = User::query();

        $status = $request['status'];
        $search = $request['search'];
        $department_id = $request['department'];
        $role_id = $request['role'];

        $departments = Department::all();
        $roles = Role::all();

        if($request['search'] != null){
            $usersArray->where('name', 'like', '%' . $request['search'] . '%');
        }
        if($request['status'] != null){
            $usersArray->where('status', $request['status']);
        }
        if($request['department'] != null){
            $usersArray->where('department_id', $request['department']);
        }
        if($request['role'] != null){
            $usersArray->where('role_id', $request['role']);
        }

        $users = $usersArray->with('department', 'role', 'customer')->get()->toArray();

        return view('admin.users.index', compact('users', 'status', 'search', 'departments', 'department_id', 'roles', 'role_id'));
    }

    public function searchMessages(Request $request){
        $messagesArray = Message::query();

        if($request['date'] != null){
            $messagesArray->where('created_at', 'like', '%' . $request['date'] . '%');
        }

        $messages = $messagesArray->with('user')->get()->toArray();

        return view('admin.messages.index', compact('messages'));
    }

    public function searchCustomers(Request $request){
        $customersArray = Customer::query();

        $users = User::where('deleted_at', null)->get();

        if($request['search'] != null){
            $customersArray->where('name', 'like', '%' . $request['search'] . '%');
        }

        $customers = $customersArray->get()->toArray();

        return view('admin.customers.index', compact('customers', 'users'));
    }
}
