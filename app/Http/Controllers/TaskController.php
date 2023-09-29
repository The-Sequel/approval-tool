<?php

namespace App\Http\Controllers;

use App\Models\Task;

use App\Models\User;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Admin side

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
                    'field' => 'text',
                    'content' => $value['title'],
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
        return view('admin.tasks.create', compact('departments', 'customers', 'projects'));
    }

    public function projectCreate(Project $project)
    {
        $departments = Department::all();
        $customers = Customer::all();
        $projects = Project::all();
        return view('admin.tasks.project.create', compact('departments', 'customers', 'projects', 'project'));
    }

    public function store(Request $request)
    {
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
            'user_id' => $request->user_id,
            'project_id' => $project_id,
            'image' => $filePath,
        ]);

        return redirect('/admin/tasks');
    }

    public function show(Task $task)
    {
        $users = User::all();
        return view('admin.tasks.show', compact('task', 'users'));
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

        return redirect('/admin/tasks');
    }

    // User side
}
