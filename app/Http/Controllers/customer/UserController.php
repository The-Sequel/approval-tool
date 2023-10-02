<?php

namespace App\Http\Controllers\customer;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $users = User::where('customer_id', $user->customer_id)->get();
        return view('customer.users.index', compact('users'));
    }
}
