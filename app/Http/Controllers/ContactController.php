<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\TopicSent;
use App\User;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * @param ContactRequest $req
     * @return RedirectResponse*
     */
    public function submit(ContactRequest $req){

        if (! Auth::user()->canSend()) {
            return redirect()
                ->route('contact')
                ->with('danger', 'Отправка сообщений возможна не больше 1 раза в сутки');
        }

        $contact = new Contact();
        $contact->topic = $req->input('topic');
        $contact->message = $req->input('message');
        $contact->user_id = auth()->user()->id;
        $contact->status = false;

        if($req->hasFile('file')) {
            $file = $req->file('file');
            $file->move(public_path() . '/path', $req->file('file')->getClientOriginalName());
        }

        $contact->file = $req->file('file')->getClientOriginalName();
        $contact->save();

        Auth::user()->updateLastTopic();
        self::sendTopicMessage($contact);

        return redirect()->route('contact')->with('success', 'Сообщение было отправлено');
    }

    /**
     * Send topic messages to users with admin permission.
     *
     * @param Contact $topic
     * @return void
     */
    public function sendTopicMessage(Contact $topic)
    {
        $managers = DB::table('users')
            ->join('users_roles', 'users_roles.user_id', '=', 'users.id')
            ->where('users_roles.role_id', '=', 1)
            ->select('users.email', 'users.name')
            ->get();

    }
    public function show(){
        $userid = Auth::id();
        $contacts = DB::table('contacts')->where('user_id',"=", $userid)->get();
        return view('contact', compact('contacts'));
    }

    public function message(){
        $userid = 1;
        $comments = DB::table('comments')->where('user_id',"=", $userid)->select('body')->get();

        return view('showMessage', compact('comments'));

    }
}
