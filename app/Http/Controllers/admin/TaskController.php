<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use App\Mail\EventMail;
use App\Models\Message;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Mail\Tasks\NewTaskMail;
use App\Http\Controllers\Controller;
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

        $options_array = Task::get()->toArray();;

        foreach ($options_array as $key => $value) {
            $options_array[$key]['customer'] = Task::find($value['id'])->customer()->get()->toArray();
        }

        foreach ($options_array as $key => $value) {
            $options_array[$key]['user'] = Task::find($value['id'])->user()->get()->toArray();
        }

        foreach ($options_array as $key => $value) {
            if ($value['approved_by'] != null) {
                $options_array[$key]['approved_by'] = Task::find($value['id'])->user()->get()->toArray();
            } else {
                $options_array[$key]['approved_by'] = [['name' => '-']];
            }
        }

        $tbody = [];
        foreach ($options_array as $key => $value) {
            $tbody[$value['id']] = [
                [
                    'field' => 'link',
                    'content' => $value['title'],
                    'href' => route('admin.tasks.show', $value['id']),
                ],
                [
                    'field' => 'text',
                    'content' => $value['customer'][0]['name'],
                ],
                [
                    'field' => 'text',
                    'content' => $value['user'][0]['name'],
                ],
                [
                    'field' => 'date',
                    'content' => $value['deadline'],
                ],
                [
                    'field' => 'text',
                    'content' => $value['status'],
                ],
                [
                    'field' => 'text',
                    'content' => $value['approved_by'][0]['name'],

                ],
                [
                    'field' => 'date',
                    'content' => $value['updated_at'],
                ],
            ];
        }

        $table = [
            'thead' => [
                'Taken',
                'Klant',
                'Persoon',
                'Deadline',
                'Afdeling',
                'Status',
                'Akkoord door',
                'Bewerkt op:'
            ],

            'tbody' => $tbody,
        ];

        return view('admin.tasks.index', compact('table', 'tasks', 'today', 'users', 'normalUsers'));
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
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'customer_id' => 'required',
        //     'department_id' => 'nullable',
        //     'deadline' => 'nullable',
        //     'created_by' => 'required',
        //     'user_ids' => 'required',
        // ]);

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

        // if($file = $request->file('image')){
        //     $fileName = $file->getClientOriginalName();
        //     $filePath = $file->storeAs('uploads', $fileName, 'public');
        // } else {
        //     $filePath = null;
        // }
        
        $task = Task::create([
            'title' => $request->title,
            // 'description' => nl2br($request->description),
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'approved_by' => $request->approved_by,
            'department_id' => $request->department_id,
            'customer_id' => $request->customer_id,
            'user_id' => $request->created_by,
            'project_id' => $project_id,
            // 'image' => $filePath,
            'images' => json_encode($images),
            'assigned_to' => $assignedTo,
        ]);

        Message::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $task->customer_id,
            'task_id' => $task->id,
            'name' => 'Er is een nieuwe taak aangemaakt! 🎉 ',
        ]);

        // Email
        if($request->send_mail == 'on'){
            $task = Task::where('title', $request->title)->first();
            $users = User::where('deleted_at', null)->get();
            foreach($users as $user){
                if($user->customer_id == $request->customer_id){
                    Mail::to($user->email)->send(new NewTaskMail($task));
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
        return view('admin.tasks.show', compact('task', 'users'));
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
        $task->assigned_users = json_encode($request->assigned_users);
        $task->date_completed = date('Y-m-d');
        $task->completed_by = Auth()->user()->id;
        $task->status = 'completed';

        $task->save();

        Message::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $task->customer_id,
            'task_id' => $task->id,
            'name' => 'Er is een taak copmleet! 🎉',
        ]);


        // Email
        // if ($request->send_mail == 'on') {
        //     $task = Task::find($task->id);
        //     $assignedUsers = json_decode($task->assigned_users);
        
        //     if ($assignedUsers) {
        //         $users = User::where('deleted_at', null)->get();
        
        //         foreach ($users as $user) {
        //             foreach ($assignedUsers as $assignedUser) {
        //                 if ((int) $user->id === (int) $assignedUser) {
        //                     Mail::to($user->email)->send(new CompletedTaskMail($task));
        //                 }
        //             }
        //         }
        //     }
        // }

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
        $task->deleted_at = date('Y-m-d H:i:s');
        return redirect('/admin/tasks');
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

        
        // if($file = $request->file('image')){
        //     $fileName = $file->getClientOriginalName();
        //     $filePath = $file->storeAs('uploads', $fileName, 'public');
        // } else {
        //     $filePath = null;
        // }

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
        // $task->image = $filePath;
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
