<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thesis; 
use App\User;
use App\Relation;
use Auth;

class ThesesController extends Controller
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
        return view ("user.create_thesis");
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
        
        $this->validate($request, [
        'name' => 'required|string|max:100',
        'defense_date' => 'required|date',
        'instructor_first_name' => 'required|max:50',
        'instructor_last_name' => 'required|max:50',
        'reviewer_first_name' => 'required|max:50',
        'reviewer_last_name' => 'required|max:50'
        ]);
        
         //Create new thesis for current user
         $thesis = new Thesis;
         $thesis->name = $request->input('name');
         $thesis->defense_date = $request->input('defense_date');
         $thesis->instructor_first_name = $request->input('instructor_first_name');
         $thesis->instructor_last_name = $request->input('instructor_last_name');
         $thesis->reviewer_first_name = $request->input('reviewer_first_name');
         $thesis->reviewer_last_name = $request->input('reviewer_last_name');
         $thesis->save();
         
         $thesis->user()->attach($user_id);
         //Add relation to thesis and user
         #$relation = new Relation; 
         #$relation->thesis_id = $thesis->id;
         #$relation->user_id = Auth::user()->id;
         #$relation->save();
         
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
        $thesis = Thesis::find($id);
        
        return view ('user.edit_thesis')->with('thesis', $thesis);
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
            'name' => 'required|string|max:100',
            'defense_date' => 'required|date',
            'instructor_first_name' => 'required|max:50',
            'instructor_last_name' => 'required|max:50',
            'reviewer_first_name' => 'required|max:50',
            'reviewer_last_name' => 'required|max:50'
        ]);
            
         //Update thesis for current user
         
         $thesis = Thesis::find($id);
         $thesis->name = $request->input('name');
         $thesis->defense_date = $request->input('defense_date');
         $thesis->instructor_first_name = $request->input('instructor_first_name');
         $thesis->instructor_last_name = $request->input('instructor_last_name');
         $thesis->reviewer_first_name = $request->input('reviewer_first_name');
         $thesis->reviewer_last_name = $request->input('reviewer_last_name');
         $thesis->save();
         
         return redirect('/home')->with('success', 'Lõputöö andmed muudetud!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thesis = Thesis::find($id);
        
        $thesis->delete();
        return redirect('/home');
    }
}
