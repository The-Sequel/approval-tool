<?php

namespace App\Http\Controllers;

use App\Models\Task;

use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Admin side

    public function adminIndex()
    {
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

        return view('admin.tasks.index', compact('table'));
    }

    public function adminCreate()
    {
        $departments = Department::all();
        $customers = Customer::all();
        return view('admin.tasks.create', compact('departments', 'customers'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'approved_by' => $request->approved_by,
            'department_id' => $request->department_id,
            'customer_id' => $request->customer_id,
            'user_id' => $request->user_id,
        ]);

        return redirect('/admin/tasks');
    }

    // User side
}
