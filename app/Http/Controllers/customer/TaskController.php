<?php

namespace App\Http\Controllers\customer;

use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use App\Models\Reason;
use Illuminate\Http\Request;
use App\Mail\Tasks\DeniedTaskMail;
use App\Http\Controllers\Controller;
use App\Mail\Tasks\ApprovedTaskMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

            // Email
            if(Str::contains(url('/'), 'approval.thesequel.nl') == true){
                $assignedUsers = json_decode($task->assigned_to);

                $users = [];
    
                foreach($assignedUsers as $user) {
                    $users[] = User::where('id', $user)->get();
                }

                foreach($users as $user){
                    Mail::to($user[0]->email)->send(new ApprovedTaskMail($task));
                }

            }

            if($task->project_id != null) {
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
            }


            Message::create([
                'user_id' => auth()->user()->id,
                'task_id' => $task->id,
                'name' => 'Er is een taak goedgekeurd! 🎉',
            ]);

            if($task->project_id != null) {
                return redirect()->route('customer.projects.show', ['project' => $task->project_id])->with('success', 'Je hebt de taak goedgekeurd!');
            }

                return redirect()->route('customer.tasks.index')->with('success', 'Je hebt de taak goedgekeurd!');

        } else {
            Reason::create([
                'task_id' => $task->id,
                'reason' => $request->message,
            ]);            

            $task->update([
                'status' => 'denied',
                // 'reason' => $request->message,
                // 'reasons' => json_encode(['reason' => $request->message]),
            ]);

            // Email
            if(Str::contains(url('/'), 'approval.thesequel.nl') == true){
                $assignedUsers = json_decode($task->assigned_to);

                $users = [];
    
                foreach($assignedUsers as $user) {
                    $users[] = User::where('id', $user)->get();
                }

                foreach($users as $user){
                    Mail::to($user[0]->email)->send(new DeniedTaskMail($task));
                }

            }

            Message::create([
                'user_id' => auth()->user()->id,
                'task_id' => $task->id,
                'name' => 'Er is een taak afgekeurd! 😢',
            ]);

            if($task->project_id != null) {
                return redirect()->route('customer.projects.show', ['project' => $task->project_id])->with('error', 'Je hebt de taak afgekeurd!');
            }

            return redirect()->route('customer.tasks.index')->with('error', 'Je hebt de taak afgekeurd!');
        }

        if($task->project_id != null){
            return redirect()->route('customer.projects.show', ['project' => $task->project_id]);
        }

        return redirect()->route('customer.tasks.index');
    }
}
