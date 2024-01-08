<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        foreach($request->all() as $message){
            $message = Message::find($message['id']);
            $message->update(['seen' => true]);
        }
        return response()->json(['messages' => []]);
    }
}
