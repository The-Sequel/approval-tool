<?php

namespace App\Http\Controllers\admin;

use App\Models\Log;
use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Projects\NewProjectMail;

class ProjectController extends Controller
{
    public function index(){
        // $projects = Project::where('status', '!=', 'Afgerond')->get();
        $projects = Project::all();

        $users = User::where('deleted_at', null)->get();

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
        $users = User::where('deleted_at', null)->get();
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

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'department' => 'required',
            'customer_id' => 'required',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => auth()->user()->id,
            'deadline' => $request->deadline,
            'customer_id' => $request->customer_id,
            'department_id' => $request->department,
            // 'file_path' => $filePath, // Save the file path in the database
        ]);

        // if($request->send_mail == 'on'){
        //     $project = Project::where('title', $request->title)->first();
        //     $users = User::where('deleted_at', null)->get();
        //     foreach($users as $user){
        //         if($user->customer_id == $request->customer_id){
        //             Mail::to($user->email)->send(new NewProjectMail($project));
        //         }
        //     }
        // }


        // Message
        Message::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $request->customer_id,
            'project_id' => $project->id,
            'name' => 'Er is een nieuw project aangemaakt! 🎉 ',
        ]);

        return redirect('/admin/projects')->with('success', 'Project is aangemaakt!');
    }

    public function update(Request $request, Project $project){

        $project->title = $request->title;
        $project->description = $request->description;
        $project->deadline = $request->deadline;
        $project->customer_id = $request->customer_id;
        $project->department_id = $request->department_id;

        if($request->status != null){
            $project->status = $request->status;
        }
        
        $project->save();
        
        return redirect('/admin/projects')->with('success', 'Project is aangepast!');
    }

    public function show(Project $project){
        $users = User::where('role_id', 1)->where('deleted_at', null)->get();
        $normalUsers = User::where('deleted_at', null)->get();
        $tasks = Task::where('project_id', $project->id)->orderBy('created_at', 'desc')->get();

        return view('admin.projects.show', compact('project', 'tasks', 'users', 'normalUsers'));
    }

    public function destroy(Project $project){
        $tasks = Task::where('project_id', $project->id)->get();

        foreach($tasks as $task){
            $task->delete();
        }

        $project->delete();
        return redirect('/admin/projects/')->with('success', 'Project is verwijderd!');
    }

    public function edit(Project $project)
    {
        $departments = Department::all();
        $customers = Customer::all();
        return view('admin.projects.edit', compact('project', 'departments', 'customers'));
    }
}
