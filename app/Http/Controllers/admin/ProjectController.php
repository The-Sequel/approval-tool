<?php

namespace App\Http\Controllers\admin;

use App\Models\Log;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();

        $users = User::all();

        $options_array = Project::get()->toArray();;

        foreach ($options_array as $key => $value) {
            $options_array[$key]['customer'] = Project::find($value['id'])->customer()->get()->toArray();
        }

        foreach ($options_array as $key => $value) {
            $customer = Project::find($value['id'])->customer;
            $options_array[$key]['users'] = $customer->users()->get()->toArray();
        }

        // get the department title
        foreach ($options_array as $key => $value) {
            $department = Project::find($value['id'])->department;
            $options_array[$key]['department'] = $department->title;
        }

        $tbody = [];
        foreach ($options_array as $key => $value) {
            $tbody[$value['id']] = [
                [
                    'field' => 'link',
                    'content' => $value['title'],
                    'href' => route('admin.projects.show', $value['id']),
                ],
                [
                    'field' => 'text',
                    'content' => $value['customer'][0]['name'],
                ],
                [
                    'field' => 'text',
                    'content' => $value['users'] ? implode(', ', array_column($value['users'], 'name')) : '-',
                ],
                [
                    'field' => 'date',
                    'content' => $value['deadline'] ? $value['deadline'] : '-',
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
                    'content' => $value['approved_by'] ? $value['approved_by'] : '-',
                ],
                [
                    'field' => 'date',
                    'content' => $value['updated_at'],
                ],
            ];
        }

        $table = [
            'thead' => [
                'Projecten',
                'Klant',
                'Personen',
                'Deadline',
                'Afdelingen',
                'Status',
                'Akkoord door',
                'Bewerkt op:'
            ],

            'tbody' => $tbody,
        ];

        return view('admin.projects.index', compact('table', 'projects', 'users'));
    }

    public function create(){
        $customers = Customer::all();
        $users = User::all();
        $departments = Department::all();
        return view('admin.projects.create', compact('customers', 'users', 'departments'));
    }

    // public function index()
    // {
    //     $user = auth()->user();
    //     $customers = Customer::all();
    //     return view('project.index', compact('customers', 'user'));
    // }

    public function store(Request $request){
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'status' => 'required',
        //     'deadline' => 'required',
        //     'customer_id' => 'required',
        // ]);

        // Handle file upload
        // if ($request->file('file')) {
        //     $file = $request->file('file');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = $file->storeAs('uploads', $fileName); // Store the file in the 'uploads' directory
        // } else {
        //     $filePath = null;
        // }

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => auth()->user()->name,
            'deadline' => $request->deadline,
            'customer_id' => $request->customer_id,
            'department_id' => $request->department,
            // 'file_path' => $filePath, // Save the file path in the database
        ]);

        Log::channel('log')->info('Project is aangemaakt door ' . auth()->user()->name . ' met id ' . $project->id);

        return redirect('/admin')->with('success', 'Project is aangemaakt!');
    }

    public function update(Request $request, Project $project){
        $project->status = $request->status;
        $project->prio_level = $request->prio_level;

        Log::channel('log')->info('Project status is aangepast door ' . auth()->user()->name . ' met id ' . $project->id . ' naar ' . $request->status . ' en prioriteit is aangepast naar ' . $request->prio_level);

        $project->save();
        return redirect('/admin')->with('success', 'Project is aangepast!');
    }

    public function show(Project $project){
        // get the tasks and put the most recent above
        $tasks = Task::where('project_id', $project->id)->orderBy('created_at', 'desc')->get();

        return view('admin.projects.show', compact('project', 'tasks'));
    }
}