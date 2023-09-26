<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

class AdminController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $projects = Project::orderBy('created_at', 'desc')->take(3)->get();
        $tasks = Task::orderBy('created_at', 'desc')->take(3)->get();
        $users = User::all();
        return view('admin.dashboard', compact('customers', 'projects', 'users', 'tasks'));
    }

    // User
    
    // Add user to customer
    public function addUser(){
        return view('admin.users.add');
    }

    // Delete user

    // Customer

    // public function customerIndex(){
    //     $customers = Customer::all();
    //     return view('admin.customers.index', compact('customers', 'contracts'));
    // }

    // public function createCustomer()
    // {
    //     return view('admin.customers.create');
    // }

    // public function storeCustomer()
    // {
    //     // Validate the user input
    //     $attributes = request()->validate([
    //         'name' => 'required',
    //     ]);

    //     // Create the user
    //     Customer::create($attributes);

    //     // Redirect the user
    //     return redirect('/admin');
    // }

    // public function destroyCustomer(Customer $customer){
    //     $customer->delete();
    //     return redirect('/admin')->with('success', 'Klant is verwijderd!');
    // }
}
