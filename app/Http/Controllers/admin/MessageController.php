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
        // $options_array = Message::get()->toArray();

        // foreach ($options_array as $key => $value) {
        //     $options_array[$key]['department'] = Message::find($value['id'])->department->title;
        // }

        // $tbody = [];
        // foreach ($options_array as $key => $value) {
        //     $tbody[$value['id']] = [
        //         [
        //             'field' => 'text',
        //             'content' => $value['name'],
        //         ],
        //         [
        //             'field' => 'date',
        //             'content' => $value['created_at'],
        //         ],
        //         [
        //             'field' => 'text',
        //             'content' => $value['department'],
        //         ]
        //     ];
        // }

        // $table = [
        //     'thead' => [
        //         'Onderwerp',
        //         'Datum',
        //         'Afdelingen',
        //     ],

        //     'tbody' => $tbody,
        // ];

        // return view('admin.messages.index', compact('table'));
    }
}
