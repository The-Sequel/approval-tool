<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();

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
