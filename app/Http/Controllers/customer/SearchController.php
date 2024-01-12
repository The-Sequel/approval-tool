<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use App\Models\Project;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchProjects(Request $request){
        $projectsArray = Project::query();

        $users = User::where('deleted_at', null)->get();
        $departments = Department::all();
        $departmentChoice = Department::where('id', $request['department'])->first();
        $status = $request['status'];
        $date = $request->date != null ? date('Y-m-d', strtotime($request->date)) : "";

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

        $projects = $projectsArray->with('customer', 'department')->get()->toArray();

        return view('customer.projects.index', compact('projects', 'users', 'date', 'departments', 'departmentChoice', 'status'));
    }

    public function searchTasks(Request $request){
        $tasksArray = Task::query();

        $users = User::where('deleted_at', null)->get();
        $status = $request['status'];

        if($request['search'] != null){
            $tasksArray->where('title', 'like', '%' . $request['search'] . '%');
        }
        if($request['date'] != null){
            $tasksArray->where('created_at', 'like', '%' . $request['date'] . '%');
        }
        if($request['status'] != null){
            $tasksArray->where('status', $request['status']);
        }

        $tasks = $tasksArray->with('customer', 'department')->get()->toArray();

        return view('customer.tasks.index', compact('tasks', 'users', 'status'));
    }

    public function searchMessages(Request $request){
        $messagesArray = Message::query();

        $date = date('Y-m-d', strtotime($request->date));

        if($request['search'] != null){
            $messagesArray->where('title', 'like', '%' . $request['search'] . '%');
        }
        if($request['date'] != null){
            $messagesArray->where('created_at', 'like', '%' . $date . '%');
        }

        $messages = $messagesArray->get()->toArray();

        return view('customer.messages.index', compact('messages', 'date'));
    }
}
