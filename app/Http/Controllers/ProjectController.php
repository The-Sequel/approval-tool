<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Task;

use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    // Admin side
    public function index(){
        $options_array = Project::get()->toArray();;

        foreach ($options_array as $key => $value) {
            $options_array[$key]['customer'] = Project::find($value['id'])->customer()->get()->toArray();
        }

        foreach ($options_array as $key => $value) {
            $customer = Project::find($value['id'])->customer;
            $options_array[$key]['users'] = $customer->users()->get()->toArray();
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
                    'content' => implode(', ', array_column($value['users'], 'name')),
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
                    'content' => $value['approved_by'],
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

        return view('admin.projects.index', compact('table'));
    }

    // public function index()
    // {
    //     $user = auth()->user();
    //     $customers = Customer::all();
    //     return view('project.index', compact('customers', 'user'));
    // }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'deadline' => 'required',
            'customer_id' => 'required',
            'prio_level' => 'required',
        ]);

        // Handle file upload
        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName); // Store the file in the 'uploads' directory
        } else {
            $filePath = null;
        }

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => auth()->user()->name,
            'deadline' => $request->deadline,
            'customer_id' => $request->customer_id,
            'prio_level' => $request->prio_level,
            'file_path' => $filePath, // Save the file path in the database
        ]);

        Log::channel('log')->info('Project is aangemaakt door ' . auth()->user()->name . ' met id ' . $project->id);

        return redirect('/admin')->with('success', 'Project is aangemaakt!');
    }

    public function update(Request $request, Project $project){
        $project->status = $request->status;
        $project->prio_level = $request->prio_level;

        // Mail::to('fake@mail.com')->send(new TestMail($oldProjectStatus, $newProjectStatus, $name));

        Log::channel('log')->info('Project status is aangepast door ' . auth()->user()->name . ' met id ' . $project->id . ' naar ' . $request->status . ' en prioriteit is aangepast naar ' . $request->prio_level);

        $project->save();
        return redirect('/admin')->with('success', 'Project is aangepast!');
    }

    public function show($id){
        $project = Project::findOrFail($id);

        $tasks = Task::where('project_id', $id)->get();

        return view('project.show', compact('project', 'tasks'));
    }
}
