<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        // $users = User::all();
        // $customers = Customer::all();
        // $roles = Role::all();
        $options_array = User::get()->toArray();;

        // dd($options_array);

        $tbody = [];
        foreach ($options_array as $key => $value) {
            // dd($value['users']['name']);
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
                    'content' => $value['customer_id'] ? Customer::find($value['customer_id'])->name : '',
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
                'Klant',
                'Rol',
            ],

            'tbody' => $tbody,
        ];

        return view('admin.users.index', compact('table'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(){
        // Validate the user input
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Create the user
        User::create($attributes);

        // Redirect the user
        return redirect('/admin/users')->with('success', 'Gebruiker is aangemaakt!');
    }

    public function update(Request $request, User $user){
        $user->customer_id = $request->customer_id;
        $user->role_id = $request->role_id;
        $user->save();      
        return redirect('/admin/users')->with('success', 'Gebruiker is aangepast!');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect('/admin/users')->with('success', 'Gebruiker is verwijderd!');
    }
}
