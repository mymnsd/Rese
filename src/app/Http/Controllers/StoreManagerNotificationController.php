<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class StoreManagerNotificationController extends Controller
{
    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('store_manager.notification', compact('users'));
    }

    public function send(Request $request)
    {
        $subject = 'Notification Subject';
        $message = 'This is the notification message.'; 

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            // 'recipients' => 'required|array',
            // 'recipients.*' => 'required|email',
        ]);

        $subject = $request->input('subject');
        $message = $request->input('message');
        // $recipients = $request->input('recipients');
        $users = User::where('role', '!=', 'admin')->get();

        // foreach ($recipients as $email) {
        //     Mail::to($email)->send(new NotificationMail($subject, $message));
        // }
        foreach ($users as $user) {
        Mail::to($user->email)->send(new NotificationMail($subject, $message));
    }
        
        return redirect()->route('store_manager.notification')->with('success', 'お知らせメールを送信しました。');

    }

}
