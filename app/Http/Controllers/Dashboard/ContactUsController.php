<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessagesRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function contactView()
    {
        return view('dashboard.contactUs');
    }

    public function contactsPost(MessagesRequest $request)
    {
        DB::beginTransaction();

        ContactUs::create([

            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'message' => $request->message,
        ]);
        DB::commit();
        return redirect()->route('contact.view')->with(['success' => 'شكرا لتواصلكم معنا']);
    }

    public function messagesView()
    {
        $messages = ContactUs::selection()->get();
        return view('dashboard.messages.messagesView', compact('messages'));
    }


    public function messageShow($id)
    {
        $message = ContactUs::selection()->find($id);
        if (!$message)
            return redirect()->route('messages.view')->with(['error' => 'هذه الرسالة غير موجودة']);

        $message->update(['is_checked' => 1]);
        return view('dashboard.messages.messageShow', compact('message'));
    }

    public function messageDestroy($id)
    {
        try {
            $message = ContactUs::find($id);
            if (!$message)
                return redirect()->route('messages.view')->with(['error' => 'هذه الرسالة غير موجودة']);
            $message->delete();

            return redirect()->route('messages.view')->with(['success' => 'تم الحذف بنجاح']);


        } catch (\Exception $ex) {
            return redirect()->route('messages.view')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
