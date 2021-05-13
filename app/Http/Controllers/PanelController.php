<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Comment;
use App\User;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ContactRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PanelController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(){
        $topics = DB::table('contacts')
            ->join('users', 'users.id', '=', 'contacts.user_id')
            ->select('contacts.*', 'users.name', 'users.email')
            ->get();
        return view('panel', compact('topics'));
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function update($id){
        DB::table('contacts')->where('id', $id)->update(['status' => true]);
        return redirect()->route('panel');
    }
    public function otvet(){
        $topics = DB::table('contacts')
            ->join('users', 'users.id', '=', 'contacts.user_id')
            ->select('contacts.*', 'users.name', 'users.email')
            ->get();
        return view('comment', compact('topics'));
    }

    public function submit(Request $req, $contact){

        $comment = new Comment();
        $comment -> user_id = auth()->user()->id;
        $comment -> body = $req -> comment;
        $comment -> contact_id = $contact;
        $comment ->save();


        return redirect()->route('panel')->with('success', 'Сообщение было отправлено');
    }

}
