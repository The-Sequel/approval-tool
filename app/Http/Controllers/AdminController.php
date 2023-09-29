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
    
    // Customer
}
