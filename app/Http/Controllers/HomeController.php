<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
#use Helper;
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
        $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
        $theses = $user->thesis;
        $roles = Role::all()->pluck('name', 'id')->toArray();
        $intership = $user->internship;
        #$instructor_id = $thesis->role->where('id', 3)->first()->pivot->user_id;
        #$instructor = User::find($instructor_id)->only('first_name', 'last_name');
        return view('home')
            ->with('internship', $intership)
            ->with('theses', $theses)
            ->with('users_all', $users_all)
            ->with('user', $user)
            ->with('roles', $roles);
    }
}
