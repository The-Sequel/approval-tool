<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\Tasks\DeniedTaskMail;
use App\Http\Controllers\Controller;
use App\Mail\Tasks\ApprovedTaskMail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tasks = Task::where('customer_id', $user->customer_id)->get();
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

            $users = User::where('role_id', 1)->where('deleted_at', null)->get();
            
            foreach ($users as $user) {
                Mail::to($user->email)->send(new ApprovedTaskMail($task));
            }

        } else {
            $task->update([
                'status' => 'denied',
                'reason' => $request->message
            ]);

            $users = User::where('role_id', 1)->where('deleted_at', null)->get();

            foreach($users as $user){
                Mail::to($user->email)->send(new DeniedTaskMail($task));
            }
        }

        return redirect()->route('customer.projects.show', $task->project_id);

        // $task->update($request->all());
        // return redirect()->route('customer.tasks.index');
    }
}
