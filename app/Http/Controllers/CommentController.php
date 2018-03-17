<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Thesis;
use App\User;
use App\Role;
use Helper;
use Auth;

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
        $instructor_role_id = Role::find(3)->id;
        $student_role_id = Role::find(1)->id;
        $thesis = Thesis::find($request->input('thesisId'));
        $thesis_user_id = Helper::userOwnsThesis($thesis, $student_role_id);
        $isInstructor = (Helper::userIsInstructorOrReviewer($thesis, $user_id, $instructor_role_id));
        
        if ($user->hasRole('Õpetaja') ||
            $user->hasRole('Komisjoni esimees') || 
            $user->hasRole('Komisjoni liige') ||
            $user->hasRole('Administraator') ||
            $thesis_user_id === $user_id ||
            $isInstructor)
        {
            $this->validate($request, [
            'comment' => 'required|string|max:500',
            ]);
                    
            //Create new comment for current thesis
            $comment = new Comment;
            $comment->comment = $request->input('comment');
            $comment->thesis_id = $request->input('thesisId');
            $comment->user_id = $user_id;
            $comment->save();
            
            return redirect()->back()->with('success', 'Kommentaar lisatud!');
        }
        else
        {
            return redirect()->back()->with('error', 'Teil puudub ligipääs!');
        }
        
    }
}
