<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationManageController extends Controller
{
    // new pr 12-8-25
    public function markNotification(Request $request){
        auth()->user()->unreadNotifications
            ->when($request->input('id'), function($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();
        return redirect()->back();
    }

    // new pr 12-8-25
    public function viewNotification(){
        
        // check resource login
        if(auth('resource')->check()){
            return view('resource.notification.index');
            exit();
        }

        // check customer login
        if(auth('customer')->check()){
            return view('customer.notification.index');
            exit();
        }
    }

    // new pr 27-8-25
    public function adminViewNotification(){
        
        // check admin login
        if(auth('admin')->check()){
            return view('admin.notification.index');
            exit();
        }
    }
}
