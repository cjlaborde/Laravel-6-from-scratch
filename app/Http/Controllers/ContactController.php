<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    /*
    public function store()
    {
        # we validate email first before allowing it to be submitted.
        request()->validate(['email' => 'required|email']);
        // send the email
        // You can read any input by using request() helper method.
        $email = request('email');
        dd($email);
    }
    */

    public function store()
    {
        # we validate email first before allowing it to be submitted.
        request()->validate(['email' => 'required|email']);

        Mail::to(request('email'))
            ->send(new ContactMe('shirts'));


        #Send mail without view/Class
        /*
        Mail::raw('It works', function ($message) {
            $message->to(request('email'))
                    ->subject('Hello There');
        });
        */

        return redirect('/contact')
            ->with('message', 'Email sent!');
    }
}




























