<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $users = User::where('deleted_at', null)->get();

        $options_array = User::get()->toArray();;

        $tbody = [];
        foreach ($options_array as $key => $value) {
            $tbody[$value['id']] = [
                [
                    'field' => 'text',
                    'content' => $value['name'],
                ],
                [
                    'field' => 'text',
                    'content' => $value['email'],
                ],
                [
                    'field' => 'text',
                    // get department name
                    'content' => $value['department_id'] ? Department::find($value['department_id'])->title : '-',
                ],
                [
                    'field' => 'text',
                    'content' => $value['customer_id'] ? Customer::find($value['customer_id'])->name : '-',
                ],
                [
                    'field' => 'text',
                    'content' => $value['role_id'] ? Role::find($value['role_id'])->name : '',
                ],
            ];
        }

        $table = [
            'thead' => [
                'Gebruikers naam',
                'Email',
                'Afdeling',
                'Klant',
                'Rol',
            ],

            'tbody' => $tbody,
        ];

        return view('admin.users.index', compact('table', 'users'));
    }

    public function create(){
        $customers = Customer::all();
        $roles = Role::all();
        $departments = Department::all();

        return view('admin.users.create', compact('customers', 'roles', 'departments'));
    }

    public function store(){
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required',
            'customer_id' => 'nullable',
            'department_id' => 'nullable',
        ]);


        // Create the user
        User::create($attributes);

        // Redirect the user
        return redirect('/admin/users')->with('success', 'Gebruiker is aangemaakt!');
    }

    public function update(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = isset($request->password) ? $request->password : $user->password;
        $user->status = $request->status;
        $user->role_id = $request->role_id;
        $user->customer_id = $request->customer_id;
        $user->department_id = $request->department_id;

        $user->update();

        return redirect('/admin/users')->with('success', 'Gebruiker is aangepast!');
    }

    public function destroy(User $user){
        $user->deleted_at = date('Y-m-d H:i:s');
        $user->update();
        return redirect('/admin/users')->with('success', 'Gebruiker is verwijderd!');
    }

    public function edit(User $user){
        $customers = Customer::all();
        $roles = Role::all();
        $departments = Department::all();

        return view('admin.users.edit', compact('user', 'customers', 'roles', 'departments'));
    }
}
