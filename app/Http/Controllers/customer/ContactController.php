<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('customer.contact');
    }

    public function send(Request $request)
    {
        dd($request->all());
    }
}
