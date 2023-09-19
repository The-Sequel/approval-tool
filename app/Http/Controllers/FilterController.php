<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\User;
use App\Models\Customer;

class FilterController extends Controller
{
    public function filterProjects(Request $request)
    {
        // dd($request->date);
        // Get all users and customers
        $users = User::all();
        $customers = Customer::all();

        // Query the database to retrieve filtered projects based on the criteria
        $projects = Project::query()
            ->when($request->input('status'), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->input('prio_level'), function ($query, $prioLevel) {
                return $query->where('prio_level', $prioLevel);
            })
            ->when($request->input('user'), function ($query, $user) {
                return $query->where('created_by', $user);
            })
            ->when($request->input('customer'), function ($query, $customer) {
                return $query->where('customer_id', $customer);
            })
            ->when($request->input('date'), function ($query, $date) {
                return $query->where('deadline', $date);
            })
            ->get();

        return view('admin.dashboard', compact('projects', 'users', 'customers'));
    }

}
