<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

class TaskController extends Controller
{
    // Admin side

    public function adminIndex()
    {
        $tasks = Task::all();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function adminCreateTask()
    {
        return view('admin.tasks.create');
    }


    // User side
}
