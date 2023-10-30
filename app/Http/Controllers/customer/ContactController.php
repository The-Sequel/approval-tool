<?php

namespace App\Http\Controllers\customer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\Contact\ContactMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $value = $request->value; 

        return view('customer.contact', compact('value'));
    }

    public function send(Request $request)
    {
        // create contact object
        $contact = new \stdClass();

        $contact->user = $request->user;
        $contact->message = $request->message;
        $contact->subject = $request->subject;
        $contact->customer = $request->customer;

        $users = User::where('role_id', 1)->where('deleted_at', null)->get();


        // foreach($users as $user) {
        //     Mail::to($user->email)->send(new ContactMail($contact));
        // }

        return redirect()->route('/')->with('success', 'Uw bericht is verzonden!');
    }
}
