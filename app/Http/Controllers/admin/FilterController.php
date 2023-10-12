<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function taskApproved(Request $request)
    {
        if($request->approved == 'on')
        {
            $tasks = Task::all();
        }
        else
        {
            $tasks = Task::where('status', '!=', 'approved')->get();
        }

        // return to the view with $tasks and also the status of the checkbox
        return view('admin.tasks.index', compact('tasks', 'request'));
    }
}
