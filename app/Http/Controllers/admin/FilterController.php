<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function taskApproved(Request $request)
    {
        if($request->approved == 'on')
        {
            $tasks = Task::all();
        }
        else
        {
            $tasks = Task::where('status', '!=', 'approved')->get();
        }

        // return to the view with $tasks and also the status of the checkbox
        return view('admin.tasks.index', compact('tasks', 'request'));
    }

    // public function date(Request $request){

    //     if($request->name == 'messages'){
    //         $date = date('Y-m-d', strtotime($request->date));
    
    //         $messages = Message::where('created_at', 'like', '%' . $date . '%')->get();

    //         return view('admin.messages.index', compact('messages', 'date'));
    //     }
    // }
}
