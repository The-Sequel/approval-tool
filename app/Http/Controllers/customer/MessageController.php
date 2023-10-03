<?php

namespace App\Http\Controllers\customer;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $messages = Message::where('customer_id', $user->customer_id)->get();
        return view('customer.messages.index', compact('messages'));
    }
}
