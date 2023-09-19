<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::all();
        return view('admin.logs.index', compact('logs'));
    }
}
