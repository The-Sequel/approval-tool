<?php

namespace App\Http\Controllers\admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        // get all messages by most recently created
        $messages = Message::orderBy('created_at', 'desc')->get();

        return view('admin.messages.index', compact('messages'));
    }

    public function filter(Request $request){
        $date = date('Y-m-d', strtotime($request->date));

        $messages = Message::where('created_at', 'like', '%' . $date . '%')->get();

        return view('admin.messages.index', compact('messages', 'date'));
    }
}
