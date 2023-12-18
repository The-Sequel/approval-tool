<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Projects\NewProjectMail;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();

        $users = User::where('deleted_at', null)->get();

        return view('admin.projects.index', compact('projects', 'users'));
    }

    public function create(){
        $customers = Customer::all();
        $users = User::where('deleted_at', null)->get();
        $departments = Department::all();
        return view('admin.projects.create', compact('customers', 'users', 'departments'));
    }

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

        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'department' => 'required',
        //     'customer_id' => 'required',
        // ]);

        if($request->title == null){
            return redirect()->back()->with('error', 'Vul een titel in!');
        } elseif($request->description == null){
            return redirect()->back()->with('error', 'Vul een beschrijving in!');
        } elseif($request->department == null){
            return redirect()->back()->with('error', 'Vul een afdeling in!');
        } elseif($request->customer_id == null){
            return redirect()->back()->with('error', 'Vul een klant in!');
        }

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

        // Email
        if(Str::contains(url('/'), 'approval.thesequel.nl') == true){
            $project_id = $project->id;
            $project = Project::where('id', $project_id)->first();
    
            $customerUsers = User::where('customer_id', $project->customer_id)->get();
    
            foreach($customerUsers as $user) {
                Mail::to($user->email)->send(new NewProjectMail($project));
            }
        }

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
            $task->messages()->delete();
            $task->delete();
        }

        $project->messages()->delete();
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
