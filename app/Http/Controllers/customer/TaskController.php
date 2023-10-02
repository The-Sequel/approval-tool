<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->customer_id)->get();
        return view('customer.tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('customer.tasks.show', compact('task'));
    }

    public function approve(Task $task)
    {
        return view('customer.tasks.approve', compact('task'));
    }

    public function finish(Task $task, Request $request)
    {
        if($request->accept == 'accept'){
            $task->update([
                'status' => 'approved'
            ]);
        } else {
            $task->update([
                'status' => 'denied',
                'reason' => $request->message
            ]);
        }

        return redirect()->route('customer.projects.show', $task->project_id);

        // $task->update($request->all());
        // return redirect()->route('customer.tasks.index');
    }
}
