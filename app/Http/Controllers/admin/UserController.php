<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Customer;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\User\UserCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(){
        $users = User::where('deleted_at', null)->get();
        $departments = Department::all();
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'departments', 'roles'));
    }

    public function create(){
        $customers = Customer::all();
        $roles = Role::all();
        $departments = Department::all();

        return view('admin.users.create', compact('customers', 'roles', 'departments'));
    }

    public function store(Request $request){

        // dd($request->all());

        if($request->name == null){
            return redirect()->back()->with('error', 'Vul een naam in!');
        } elseif($request->email == null){
            return redirect()->back()->with('error', 'Vul een email in!');
        } elseif($request->password == null){
            return redirect()->back()->with('error', 'Vul een wachtwoord in!');
        } elseif($request->role_id == null){
            return redirect()->back()->with('error', 'Vul een rol in!');
        } elseif($request->role_id == 2){
            if($request->customer_id == null){
                return redirect()->back()->with('error', 'Vul een klant in!');
            }
            if($request->department_id == null){
                return redirect()->back()->with('error', 'Vul een afdeling in!');
            }
        }

        $attributes = request()->all();

        // check if there arleady is a user with the same email
        $user = User::where('email', $attributes['email'])->first();

        if($user){
            return redirect()->back()->with('error', 'Er is al een gebruiker met dit email adres!');
        } else {
            $user = User::create($attributes);
        }

        // Redirect the user
        return redirect('/admin/users')->with('success', 'Gebruiker is aangemaakt!');
    }

    public function update(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = isset($request->password) ? $request->password : $user->password;
        $user->phone_number = $request->phone_number;
        $user->status = $request->status;
        $user->role_id = $request->role_id;
        $user->customer_id = $request->customer_id;
        $user->department_id = $request->department_id;
        $user->color = $request->color;

        $user->update();

        return redirect('/admin/users')->with('success', 'Gebruiker is aangepast!');
    }

    public function destroy(User $user){
        $user->deleted_at = date('Y-m-d H:i:s');
        $user->status = "inactive";
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
