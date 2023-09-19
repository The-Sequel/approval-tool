<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Project;
use App\Models\User;
use App\Models\Role;
use App\Models\Contract;

class AdminController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $projects = Project::all();
        $users = User::all();
        return view('admin.dashboard', compact('customers', 'projects', 'users'));
    }

    // User

    public function userIndex()
    {
        $users = User::all();
        $customers = Customer::all();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'customers', 'roles'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser()
    {
        // Validate the user input
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Create the user
        User::create($attributes);

        // Redirect the user
        return redirect('/admin')->with('success', 'Gebruiker is aangemaakt!');
    }

    public function updateUser(Request $request, User $user){
        $user->customer_id = $request->customer_id;
        $user->role_id = $request->role_id;
        $user->save();      
        return redirect('/admin')->with('success', 'Gebruiker is aangepast!');
    }
    
    // Add user to customer
    public function addUser(){
        return view('admin.users.add');
    }

    // Delete user
    public function destroyUser(User $user){
        $user->delete();
        return redirect('/admin')->with('success', 'Gebruiker is verwijderd!');
    }

    // Customer

    public function customerIndex(){
        $customers = Customer::all();
        $contracts = Contract::all();
        return view('admin.customers.index', compact('customers', 'contracts'));
    }

    public function createCustomer()
    {
        return view('admin.customers.create');
    }

    public function storeCustomer()
    {
        // Validate the user input
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        // Create the user
        Customer::create($attributes);

        // Redirect the user
        return redirect('/admin');
    }

    public function destroyCustomer(Customer $customer){
        $customer->delete();
        return redirect('/admin')->with('success', 'Klant is verwijderd!');
    }

    // Contracts
    public function createContract(Request $request){
        $customer_id = $request->customer_id;
        return view('admin.contracts.create', compact('customer_id'));
    }

    public function storeContract(Request $request){
        $customer_id = $request->customer_id;
        $name = $request->name;
        $hours = $request->hours;

        Contract::create([
            'customer_id' => $customer_id,
            'name' => $name,
            'hours' => $hours,
        ]);

        return redirect('/admin')->with('success', 'Contract is aangemaakt!');
    }
}
