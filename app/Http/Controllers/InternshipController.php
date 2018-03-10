<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Internship;
use Auth;

class InternshipController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if ($user->hasRole('Õpetaja'))
        {
            if($request->input('company_name'))
            {
                $internships_all = Internship::where('company_name', 'like', '%'.$request->input('company_name').'%')->get();
            }
            else
            {
                $internships_all = Internship::all();
            }
            
            return view('internships')->with('internships_all', $internships_all);
        }
        else 
        {
            return redirect('/home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        //check if current user has student role
        if($user->hasRole('Õpilane'))
        {
            return view('user.create_internship');
        }
        else 
        {
            return redirect('/home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        //check if current user has student role
        if ($user->hasRole('Õpilane'))
        {
            $this->validate($request, [
            'company_name' => 'required|string|max:50',
            'start_date' => 'required|date',
            'start_date' => 'required|date',
            'duration' => 'required|integer'
            ]);
            
            //Create new internship for current user
            $internship = new Internship;
            $internship->user_id = Auth::user()->id;
            $internship->company_name = $request->input('company_name');
            $internship->start_date = $request->input('start_date');
            $internship->end_date = $request->input('end_date');
            $internship->duration = $request->input('duration');
            $internship->save();
            
            return redirect('/home')->with('success', 'Lõputöö lisatud!');
        }
        else 
        {
            return redirect('/home');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $internship = Internship::find($id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        //check if current user has student role
        if ($user->hasRole('Õpilane'))
        {
            if(Auth::user()->id !== $internship->user_id)
            {
                return redirect('/home')->with('error', 'Teil puudub ligipääs!');
            }
            
            return view ('user.edit_internship')->with('internship', $internship);
        }
        else 
        {
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        //check if current user has student role
        if ($user->hasRole('Õpilane'))
        {
            $this->validate($request, [
            'company_name' => 'required|string|max:50',
            'start_date' => 'required|date',
            'start_date' => 'required|date',
            'duration' => 'required|integer'
            ]);
            
            //Update internship for current user
            $internship = Internship::find($id);
            $internship->company_name = $request->input('company_name');
            $internship->start_date = $request->input('start_date');
            $internship->end_date = $request->input('end_date');
            $internship->duration = $request->input('duration');
            $internship->save();
            
            return redirect('/home')->with('success', 'Praktika andmed muudetud!');
        }
        else 
        {
            return redirect('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $internship = Internship::find($id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        //check if current user has student role
        if ($user->hasRole('Õpilane'))
        {
            if(Auth::user()->id !== $internship->user_id){
                return redirect('/home')->with('error', 'Teil puudub ligipääs!');
            }
            
            $internship->delete();
            return redirect('/home');
        }
        else 
        {
            return redirect('/home');
        }
    }
}
