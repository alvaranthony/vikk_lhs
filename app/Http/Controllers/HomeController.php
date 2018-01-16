<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Thesis;
use App\FileEntry;
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
        $student_id = Auth::user()->id;
        
        $fileentry = Student::find($student_id)->fileentry;
        $thesis = Student::find($student_id)->thesis;
        $intership = Student::find($student_id)->internship;
        
        return view('home')->with('thesis', $thesis)->with('internship', $intership)->
        with('fileentry', $fileentry);
    }
}
