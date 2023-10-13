<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\User;
use App\Models\Message;
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
        $users = User::Where('role_id', 1)->where('deleted_at', null)->get();
        $normalUsers = User::Where('customer_id', $user->customer_id)->where('deleted_at', null)->get();
        $tasks = Task::where('customer_id', $user->customer_id)->get();
        return view('customer.tasks.index', compact('tasks', 'users', 'normalUsers'));
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
                'status' => 'approved',
                'approved_by' => auth()->user()->id,
            ]);

            $project = $task->project()->get()->first();

            // check if all of the tasks of the project are approved
            $tasks = Task::where('project_id', $project->id)->get();

            $allApproved = true;

            foreach($tasks as $task){
                if($task->status != 'approved'){
                    $allApproved = false;
                }
            }

            if($allApproved){
                $project->update([
                    'status' => 'approved'
                ]);
            }

            Message::create([
                'user_id' => auth()->user()->id,
                'task_id' => $task->id,
                'name' => 'Er is een taak goedgekeurd! 🎉',
            ]);

            // $users = User::where('role_id', 1)->where('deleted_at', null)->get();
            
            // foreach ($users as $user) {
            //     if(in_array($user->id, json_decode($task->assigned_to))){
            //         Mail::to($user->email)->send(new ApprovedTaskMail($task));
            //     }
            // }

        } else {
            $task->update([
                'status' => 'denied',
                'reason' => $request->message
            ]);

            Message::create([
                'user_id' => auth()->user()->id,
                'task_id' => $task->id,
                'name' => 'Er is een taak afgekeurd! 😢',
            ]);

            // $users = User::where('role_id', 1)->where('deleted_at', null)->get();

            // foreach($users as $user){
            //     if(in_array($user->id, json_decode($task->assigned_to))){
            //         Mail::to($user->email)->send(new DeniedTaskMail($task));
            //     }
            // }
        }

        if($task->project_id != null){
            return redirect()->route('customer.projects.show', ['project' => $task->project_id]);
        } else {
            return redirect()->route('customer.tasks.index');
        }

        // $task->update($request->all());
        // return redirect()->route('customer.tasks.index');
    }
}
