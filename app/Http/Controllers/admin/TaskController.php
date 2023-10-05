<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use App\Mail\EventMail;
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

        // get the department title
        foreach ($options_array as $key => $value) {
            $department = Task::find($value['id'])->department;
            $options_array[$key]['department'] = $department->title;
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
                    'content' => $value['department'],
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

        return view('admin.tasks.index', compact('table', 'tasks', 'today'));
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'customer_id' => 'required',
            'department_id' => 'required',
        ]);

        $userIds = $request->input('user_ids', []);

        $assignedTo = json_encode($userIds);

        if($request->project_id != null) {
            $project_id = $request->project_id;
        } else {
            $project_id = null;
        }

        if($file = $request->file('image')){
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        } else {
            $filePath = null;
        }
        
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'approved_by' => $request->approved_by,
            'department_id' => $request->department_id,
            'customer_id' => $request->customer_id,
            'user_id' => $request->created_by,
            'project_id' => $project_id,
            'image' => $filePath,
            'assigned_to' => $assignedTo,
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

        return redirect('/admin/tasks');
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


        // Email
        if($request->send_mail == 'on'){
            $task = Task::find($task->id);
            $users = User::where('deleted_at', null)->get();

            foreach ($users as $user) {
                foreach (json_decode($task->assigned_users) as $assignedUser) {
                    if ((int) $user->id === (int) $assignedUser) {
                        Mail::to($user->email)->send(new CompletedTaskMail($task));
                    }
                }
            }
        }

        return redirect('/admin/tasks');
    }

    public function destroy(Task $task){
        $task->delete();
        return redirect('/admin/tasks');
    }
}
