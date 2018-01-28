<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Thesis;
use App\FileEntry;
use App\Relation;
use App\Role;
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
        //get thesis for current student 
        #$thesis = $user->thesis()->where('role_id', 1)->first();
        #$thesis_fileentry = $thesis->fileentry;
        #dd($thesis_fileentry);
        #$thesis_ids = Relation::where('user_id', '=', $user_id)->get()->pluck('thesis_id');
        #dd($thesis_ids);
        
        #$theses = Thesis::find($thesis_ids);
        $roles = Role::all()->pluck('name', 'id')->toArray();
        $fileentries = $user->fileentry;
        $theses = $user->thesis;
        $intership = User::find($user_id)->internship;
        
        return view('home')
            ->with('internship', $intership)
            ->with('theses', $theses)
            ->with('roles', $roles)
            ->with('fileentries', $fileentries);
    }
}
