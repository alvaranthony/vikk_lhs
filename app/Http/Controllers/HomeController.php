<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Thesis;
use App\FileEntry;
use App\Internship;
use App\Role;
use Auth;
use DB;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $theses = $user->thesis;
        $intership = $user->internship;
        $exams = $user->exam_type;
        $reviewer_role_id = Role::find(8)->id;
        
        #dd(!(count(Auth::user()->role) < 2 && Auth::user()->hasRole('Vaikimisi')))
        
        return view('home')
            ->with('internship', $intership)
            ->with('reviewer_role_id', $reviewer_role_id)
            ->with('theses', $theses)
            ->with('exams', $exams)
            ->with('user', $user);
    }
}
