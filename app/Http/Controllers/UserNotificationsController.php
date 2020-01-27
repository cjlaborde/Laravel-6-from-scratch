<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class UserNotificationsController extends Controller
{
    #using Tab method
    public function show()
    {
        $notifications = tap(auth()->user()->unreadNotifications)->markAsRead();
        return view('notifications.show', [
            # let say I want the user unread notifications, but also want to return a method on it that returns void if it does not return anything
            # here is how we can handle that.
            'notifications' => $notifications
        ]);
    }
    /*
    public function show()
    {
        # 3) In Next pay load it will not show anything till a new notification comes in.
        # 1) First we will fetch any unread notifications
        $notifications = auth()->user()->unreadNotifications;

        # Slow Way with multiple queries

//         foreach ($notifications as $notification )
//             $notification->markAsRead();
//         @endforeach

        #More efficient way using methods inside `DatabaseNotificationCollection`
        # 2) But immediately we will update them in database.
        $notifications->markAsRead();

        return view('notifications.show', [
//            'notifications' => auth()->user()->unread # check in  `/home/cjlaborde/Sites/laravel6/vendor/laravel/framework/src/Illuminate/Notifications/DatabaseNotification.php`
            'notifications' => $notifications
        ]);
    }
    */



}
