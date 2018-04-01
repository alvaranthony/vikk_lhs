<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReviewerAssessment;
use App\Thesis;
use App\User;
use App\Role;
use Helper;
use Auth;

class ReviewerAssessmentController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $thesis = Thesis::find($request->input('thesisId'));
        $reviewer_role_id = Role::find(8)->id;
        $isReviewer = Helper::userIsInstructorOrReviewer($thesis, $user_id, $reviewer_role_id);
        
        if ($isReviewer)
        {
            $this->validate($request, [
            'assessment' => 'required|string|max:750',
            ]);
                    
            //Create new assessment for current thesis
            $assessment = new ReviewerAssessment;
            $assessment->assessment = $request->input('assessment');
            $assessment->save();
            
            $thesis->reviewer_assessment_id = $assessment->id;
            $thesis->save();
            
            return redirect()->back()->with('success', 'Hinnang lisatud!');
        }
        else
        {
            return redirect()->back()->with('error', 'Teil puudub ligipääs!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $thesis = Thesis::find($request->input('thesisId'));
        $reviewer_role_id = Role::find(8)->id;
        $isReviewer = Helper::userIsInstructorOrReviewer($thesis, $user_id, $reviewer_role_id);
        
        if ($isReviewer)
        {
            $thesis->reviewer_assessment_id = NULL;
            $thesis->save();
            $reviewer_assessment = ReviewerAssessment::find($id);
            $reviewer_assessment->delete();
            
            return redirect()->back()->with('warning', 'Hinnang eemaldatud!');
        }
        else
        {
            return redirect()->back()->with('error', 'Teil puudub ligipääs!');
        }
    }
}
