<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        $this->validate($request, [
        'comment' => 'required|string|max:500',
        ]);
                
        //Create new comment for current thesis
        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->thesis_id = $request->input('thesisId');
        $comment->user_id = $user_id;
        $comment->save();
        
        return redirect()->back();
    }
}
