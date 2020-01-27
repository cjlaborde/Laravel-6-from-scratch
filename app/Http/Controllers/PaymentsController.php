<?php

namespace App\Http\Controllers;

use App\Notifications\PaymentReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentsController extends Controller
{
    public function create()
    {
        # 1) When user clicks payment button in the view.
        return view('payments.create');
    }

    # 2) Will hit store method
    public function store(Request $request)
    {
        # 3) Then will send a notification to the sign in  user = user()
        # 4) Then will fire off this Notification `new PaymentReceived()`
        # Notification is an alternative facade to Mail::
        # send the notification to the person currently signed in
//        Notification::send(request()->user(), new PaymentReceived());

        # Alternative way but more redeable
        request()->user()->notify(new PaymentReceived(900));

        return redirect('notifications');
    }
}


