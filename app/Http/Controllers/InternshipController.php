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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create_internship');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        
        if(Auth::user()->id !== $internship->user_id){
            return redirect('/home')->with('error', 'Teil puudub ligipääs!');
        }
        
        return view ('user.edit_internship')->with('internship', $internship);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $internship = Internship::find($id);
        
        if(Auth::user()->id !== $internship->user_id){
            return redirect('/home')->with('error', 'Teil puudub ligipääs!');
        }
        
        $internship->delete();
        return redirect('/home');
    }
}
