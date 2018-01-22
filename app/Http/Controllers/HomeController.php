<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Thesis;
use App\FileEntry;
use App\Relation;
use Auth;

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
        #$fileentry = User::find($user_id)->fileentry;
        #$thesis_ids = Relation::where('user_id', '=', $user_id)->get()->pluck('thesis_id');
        #dd($thesis_ids);
        
        #$theses = Thesis::find($thesis_ids);
        $theses = $user->thesis;
        $intership = User::find($user_id)->internship;
        
        return view('home')->with('internship', $intership)->with('theses', $theses);
        #with('fileentry', $fileentry);
    }
}
