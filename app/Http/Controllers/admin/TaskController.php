<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Reason;
use App\Models\Message;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Tasks\NewTaskMail;
use App\Http\Controllers\Controller;
use App\Mail\Tasks\NewTaskMailAdmin;
use Illuminate\Support\Facades\Mail;
use App\Mail\Tasks\CompletedTaskMail;

class TaskController extends Controller
{
    public function adminIndex(Request $request)
    {
        $tasks = Task::all();
        $users = User::where('role_id', 1)->where('deleted_at', null)->get();
        $normalUsers = User::where('deleted_at', null)->get();
        $today = date('Y-m-d');

        return view('admin.tasks.index', compact('tasks', 'today', 'users', 'normalUsers'));
    }

    public function adminCreate()
    {
        $departments = Department::all();
        $customers = Customer::all();
        $projects = Project::all();
        $users = User::where('role_id', 1)->get();
        return view('admin.tasks.create', compact('departments', 'customers', 'projects', 'users'));
    }

    public function projectCreate(Project $project)
    {
        $departments = Department::all();
        $customers = Customer::all();
        $projects = Project::all();
        $users = User::where('role_id', 1)->get();
        return view('admin.tasks.project.create', compact('departments', 'customers', 'projects', 'project', 'users'));
    }

    public function store(Request $request)
    {
        if($request->title == null){
            return redirect()->back()->with('error', 'Vul een titel in!');
        } elseif($request->description == null){
            return redirect()->back()->with('error', 'Vul een beschrijving in!');
        } elseif($request->customer_id == null){
            return redirect()->back()->with('error', 'Selecteer een klant!');
        } elseif($request->user_ids == null){
            return redirect()->back()->with('error', 'Selecteer een persoon!');
        }

        $userIds = $request->input('user_ids', []);

        $assignedTo = json_encode($userIds);

        if($request->project_id != null) {
            $project_id = $request->project_id;
        } else {
            $project_id = null;
        }

        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = $image->getClientOriginalName();
                $filePath = $image->storeAs('uploads', $fileName, 'public');
                $images[] = $filePath;
            }
        }

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'approved_by' => $request->approved_by,
            'department_id' => $request->department_id,
            'customer_id' => $request->customer_id,
            'user_id' => $request->created_by,
            'project_id' => $project_id,
            'images' => json_encode($images),
            'assigned_to' => $assignedTo,
        ]);

        $customerUsers = User::where('customer_id', $task->customer_id)->get();

        $users = [];

        foreach($customerUsers as $user){
            $users[] = $user->id;
        }

        Message::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $task->customer_id,
            'task_id' => $task->id,
            'users' => json_encode($users),
            'name' => 'Er is een nieuwe taak aangemaakt! 🎉 ',
        ]);

        
        // Email
        if(Str::contains(url('/'), 'approval.thesequel.nl')) {
            $task_id = $task->id;
            $task = Task::where('id', $task_id)->first();
        
            $assignedUsers = json_decode($task->assigned_to);
            $customerUsers = User::where('customer_id', $task->customer_id)->get();
        
            foreach($assignedUsers as $userId) {
                $user = User::find($userId);

                if(isset($user->email)){
                    if($user->status == 'active'){
                        Mail::to($user->email)->send(new NewTaskMailAdmin($task));
                    }
                }
            }
        
            foreach($customerUsers as $user) {
                if($user->department_id == $task->department_id) {
                    if(isset($user->email)){
                        if($user->status == 'active'){
                            Mail::to($user->email)->send(new NewTaskMail($task));
                        }
                    }
                }
            }
        }

        if($request->project_id != null){
            return redirect('/admin/projects/show/' . $request->project_id)->with('success', 'Taak is aangemaakt!');
        }

        return redirect('/admin/tasks')->with('success', 'Taak is aangemaakt!');
    }

    public function show(Task $task)
    {
        $users = User::where('deleted_at', null)->get();
        $reasons = Reason::where('task_id', $task->id)->get();
        return view('admin.tasks.show', compact('task', 'users', 'reasons'));
    }

    public function complete(Task $task)
    {
        $users = User::where('deleted_at', null)->get();
        return view('admin.tasks.complete', compact('task', 'users'));
    }

    public function finish(Request $request, Task $task)
    {
        if($files = $request->file('files')){
            $filePaths = [];

            foreach($files as $file){
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $filePaths[] = $filePath;
            }
        } else {
            $filePaths = [];
        }

        $task->image_completed = json_encode($filePaths);
        $task->description_completed = $request->description;
        // $task->assigned_users = json_encode($request->assigned_users);
        $task->date_completed = date('Y-m-d');
        $task->completed_by = Auth()->user()->id;
        $task->status = 'completed';

        $task->save();

        $customerUsers = User::where('customer_id', $task->customer_id)->get();

        $users = [];

        foreach($customerUsers as $user){
            $users[] = $user->id;
        }

        Message::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $task->customer_id,
            'task_id' => $task->id,
            'users' => json_encode($users),
            'name' => 'Er is een taak copmleet! 🎉',
        ]);

        if(Str::contains(url('/'), 'approval.thesequel.nl') == true){
            $customerUsers = User::where('customer_id', $task->customer_id)->where('department_id', $task->department_id)->get();
    
            foreach($customerUsers as $user) {
                if($user->status == 'active'){
                    Mail::to($user->email)->send(new CompletedTaskMail($task));
                }
            }
        }

        // Message
        // Message::create([
        //     'user_id' => auth()->user()->id,
        //     'customer_id' => $request->customer_id,
        //     'task_id' => $task->id,
        //     'name' => 'Er is een taak copmleet! 🎉',
        // ]);

        return redirect('/admin/tasks');
    }

    public function destroy(Task $task){
        $task->messages()->delete();
        $task->reasons()->delete();
        $task->delete();

        return redirect('/admin/tasks')->with('success', 'Taak is verwijderd!');
    }

    public function edit(Task $task)
    {
        $assignedUsers = json_decode($task->assigned_to);
        $users = User::where('role_id', 1)->where('deleted_at', null)->get();
        $departments = Department::all();

        return view('admin.tasks.edit', compact('task', 'users', 'assignedUsers', 'departments'));
    }

    public function update(Task $task, Request $request)
    {
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = $image->getClientOriginalName();
                $filePath = $image->storeAs('uploads', $fileName, 'public');
                $images[] = $filePath;
            }
        }

        $userIds = $request->input('user_ids', []);
        $assignedTo = json_encode($userIds);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->images = json_encode($images);
        $task->assigned_to = $assignedTo;

        if($request->department_id != null) {
            $task->department_id = $request->department_id;
        } else {
            $task->department_id = null;
        }

        $task->save();

        return redirect('/admin/tasks');
    }
}
