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
        
        return view('home')
            ->with('internship', $intership)
            ->with('theses', $theses)
            ->with('user', $user);
    }
}
