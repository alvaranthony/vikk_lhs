<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\ReviewerAssessment;
use App\ReviewerGrade;
use App\FileEntry;
use App\Thesis;
use App\Status;
use App\Group;
use App\User;
use App\Role;
use Helper;
use Auth;
use DB;

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
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        //check if current user has teacher or administrator role
        if ($user->hasRole('Õpetaja') || $user->hasRole('Administraator'))
        {
            if($request->input('thesis_status'))
            {
                $theses_all = Thesis::all()->where('status_id', $request->input('thesis_status'));
            }
            elseif($request->input('name'))
            {
                $theses_all = Thesis::where('name', 'like', '%'.$request->input('name').'%')->get();
            }
            elseif($request->input('study_group'))
            {
                $theses_all = Thesis::all()->where('group_id', $request->input('study_group'));
            }
            else
            {
                $theses_all = Thesis::all();
            }
            
            $statuses = Status::all()->pluck('name', 'id')->prepend('Kõik', '');
            $reviewer_role_id = Role::find(8)->id;
            $groups_all = Group::all()->pluck('name', 'id')->prepend('Kõik', '');
            
            return view('theses')
                ->with('statusList', $statuses)
                ->with('reviewer_role_id', $reviewer_role_id)
                ->with('groupsList', $groups_all)
                ->with('theses_all', $theses_all);
        }
    }
    
    public function instructorTheses()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $theses = $user->instructorTheses;
        
        //check if current user has instructor role
        if ($user->hasRole('Juhendaja'))
        {
            return view('instructor_theses')->with('theses', $theses);
        }
        else 
        {
            return redirect('/home');
        }
        
    }
    
    public function reviewerTheses()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $theses = $user->reviewerTheses;
        
        //check if current user has reviewer role
        if ($user->hasRole('Retsensent'))
        {
            return view('reviewer_theses')->with('theses', $theses);
        }
        else
        {
            return redirect('home');
        }
    }
    
    public function committeeTheses(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        if ($user->hasRole('Komisjoni esimees') || $user->hasRole('Komisjoni liige'))
        {
            $reviewer_role_id = Role::find(8)->id;
            
            if ($request->input('name'))
            {
                $theses_all = Thesis::whereIn('status_id', [3, 4])
                    ->where('name', 'like', '%'.$request->input('name').'%')->get();
            }
            else
            {
                $theses_all = Thesis::all()->whereIn('status_id', [3, 4]);
            }
            
            return view('committee_theses')
                ->with('reviewer_role_id', $reviewer_role_id)
                ->with('theses_all', $theses_all);
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
        $student_role_id = Role::find(1)->id;
        
        //check if current user has teacher role
        //let user create new thesis if user is student
        if ($user->hasRole('Õpilane'))
        {   
            //check if user already has thesis
            $hasThesis = $user->thesis()->where('role_id', $student_role_id)->exists();
            if($hasThesis === false)
            {
                $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
                $groups_all = Group::all()->pluck('name', 'id');
                //get a list of all non students
                $non_students = Helper::getNonStudents($users_all);
                return view ("user.create_thesis")
                    ->with('usersList', $non_students)
                    ->with('groupsList', $groups_all);
            }
            else
            {
                return redirect('/home');
            }
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
        $student_role_id = Role::find(1)->id;
        $instructor_role_id = Role::find(3)->id;
        $status_submit_instructor = Status::find(1)->id;
        
        //check if current user has student role
        if ($user->hasRole('Õpilane'))
        {
            //check if user already has thesis 
            $hasThesis = $user->thesis()->where('role_id', $student_role_id)->exists();
            
            if ($hasThesis == false)
            {
                $this->validate($request, [
                'name' => 'required|string|max:100',
                'defense_date' => 'required|date',
                'thesis_instructor' => 'required', 
                'study_group' => 'required'
                ]);
                
                //Create new thesis for current user
                $thesis = new Thesis;
                $thesis->status_id = $status_submit_instructor;
                $thesis->group_id = $request->input('study_group');
                $thesis->name = $request->input('name');
                $thesis->defense_date = $request->input('defense_date');
                $thesis->save();
                
                //attach study_group to the given user
                $user->group_id = $request->input('study_group');
                $user->save();
                
                //attach user with given thesis
                $user->thesis()->attach($thesis->id, array('role_id' => $student_role_id));
                
                //check if thesis already has an instructor 
                $hasInstructor = $thesis->user()->where('role_id', $instructor_role_id)->exists();
                if ($hasInstructor == false)
                {
                    //attach user with given thesis as instructor
                    $thesis->user()->attach($request->input('thesis_instructor'), array('role_id' => $instructor_role_id));
                }
                
                //upload thesis file
                $file = $request->file('thesis_file');
                if ($file)
                {
                    $allowed = array("application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
                    if(in_array($file->getClientMimeType(), $allowed))
                    {
                		$extension = $file->getClientOriginalExtension();
                		Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
                		$entry = new FileEntry;
                		$entry->thesis_id = $thesis->id;
                		$entry->filename = $file->getFilename().'.'.$extension;
                		$entry->mime = $file->getClientMimeType();
                		$entry->original_filename = $file->getClientOriginalName();
                		$entry->save();
                    }
                }
                 
                return redirect('/home')->with('success', 'Lõputöö lisatud!');
            }
            else 
            {
                return redirect('/home');
            }
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
        $current_user = User::find(Auth::user()->id);
        $thesis = Thesis::find($id);
        $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
        //get a list of all non students
        $non_students = Helper::getNonStudents($users_all);
        
        if($thesis)
        {
            $instructor_role_id = Role::find(3)->id;
            $student_role_id = Role::find(1)->id;
            $reviewer_role_id = Role::find(8)->id;
            $hasReviewer = $thesis->user()->where('role_id', $reviewer_role_id)->exists();
            $reviewer_add_update = ($hasReviewer ? 'Uuenda' : 'Määra');
            $reviewer_grade_add_update = ($thesis->reviewer_grade === NULL ? 'Määra' : 'Uuenda');
            $isInstructor = Helper::userIsInstructorOrReviewer($thesis, $current_user->id, $instructor_role_id);
            $isReviewer = Helper::userIsInstructorOrReviewer($thesis, $current_user->id, $reviewer_role_id);
            $thesis_user_id = Helper::userOwnsThesis($thesis, $student_role_id);
            $committee_actions = $thesis->status->name != 'Kaitstud';
            
            if ($thesis_user_id === $current_user->id || $current_user->hasRole('Õpetaja') ||
                $current_user->hasRole('Administraator') || $current_user->hasRole('Komisjoni esimees') ||
                $current_user->hasRole('Komisjoni liige') || $isInstructor || $isReviewer)
            {
                $reviewer_grades_list = ReviewerGrade::all()->pluck('grade', 'id');
                $statuses = DB::table('statuses')->whereIn('id', [1,2,3])->pluck('name', 'id');
                $status_id = $thesis->status->id;
                
                return view('thesis')
                    ->with('current_user', $current_user)
                    ->with('usersList', $non_students)
                    ->with('hasReviewer', $hasReviewer)
                    ->with('isInstructor', $isInstructor)
                    ->with('isReviewer', $isReviewer)
                    ->with('gradesList', $reviewer_grades_list)
                    ->with('committee_actions', $committee_actions)
                    ->with('reviewer_add_update', $reviewer_add_update)
                    ->with('reviewer_grade_add_update', $reviewer_grade_add_update)
                    ->with('statusList', $statuses)
                    ->with('status_id', $status_id)
                    ->with('thesis', $thesis);
            }
            else
            {
                return redirect()->back()->with('error', 'Teil puudub ligipääs!');
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $student_role_id = Role::find(1)->id;
        $thesis = Thesis::find($id);
        $thesis_user_id = Helper::userOwnsThesis($thesis, $student_role_id);
        
        //check if current user has student role
        if ($user->hasRole('Õpilane'))
        {
            if ($user_id !== $thesis_user_id)
            {
                return redirect('/home')->with('error', 'Teil puudub ligipääs!');
            }
            else 
            {
                $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
                $groups_all = Group::all()->pluck('name', 'id');
                $non_students = Helper::getNonStudents($users_all);
                
                foreach ($thesis->role as $instructor)
                {
                    if ($instructor->id == 3)
                    {
                        $insructor_id = $instructor->pivot->user_id;
                    }
                }
                
                return view ('user.edit_thesis')
                    ->with('thesis', $thesis)
                    ->with('instructor_id', $insructor_id)
                    ->with('groupsList', $groups_all)
                    ->with('usersList', $non_students);
            }
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
        $thesis = Thesis::find($id);
        $student_role_id = Role::find(1)->id;
        $reviewer_role_id = Role::find(8)->id;
        $instructor_role_id = Role::find(3)->id;
        $isInstructor = Helper::userIsInstructorOrReviewer($thesis, $user_id, $instructor_role_id);
        $isReviewer = Helper::userIsInstructorOrReviewer($thesis, $user_id, $reviewer_role_id);
        $thesis_user_id = Helper::userOwnsThesis($thesis, $student_role_id);
        
        //check if current user has student role
        if ($user->hasRole('Õpilane'))
        {
            if ($user_id !== $thesis_user_id){
                return redirect('/home')->with('error', 'Teil puudub ligipääs!');
            }
            else 
            {
                $this->validate($request, [
                'name' => 'required|string|max:100',
                'defense_date' => 'required|date'
                ]);
                    
                //Update thesis for current user
                $thesis = Thesis::find($id);
                $thesis->name = $request->input('name');
                $thesis->defense_date = $request->input('defense_date');
                $thesis->group_id = $request->input('study_group_id');
                $thesis->save();
                
                //update user's study group
                $user->group_id = $request->input('study_group_id');
                $user->save();
                
                //update thesis instructor 
                foreach ($thesis->role as $instructor)
                {
                if ($instructor->id == 3)
                    {
                        $instructor->pivot->user_id = $request->input('thesis_instructor');
                        $instructor->pivot->save();
                    }
                }
                
                return redirect('/home')->with('success', 'Lõputöö andmed muudetud!');
            }
        }
        
        elseif ($request->input('thesis_status'))
        {
            if ($isInstructor)
            {
                //update thesis status
                $thesis = Thesis::find($id);
                $thesis->status_id = $request->input('thesis_status');
                $thesis->save();
                
                return redirect()->back()->with('success', 'Staatus uuendatud!');
            }
            else
            {
                return redirect('/home');
            }
        }
        
        elseif ($request->input('reviewer_grade'))
        {
            if ($isReviewer)
            {
                $grade_add_update_text = ($thesis->reviewer_grade === NULL ? 'lisatud!' : 'uuendatud!');
                
                $thesis = Thesis::find($id);
                $thesis->reviewer_grade_id = $request->input('reviewer_grade');
                $thesis->save();
                
                return redirect()->back()->with('success', 'Hinne ' . $grade_add_update_text);
                
            }
            else 
            {
                return redirect('/home');
            }
        }
        
        elseif ($request->input('thesis_reviewer'))
        {
            if ($user->hasRole('Administraator'))
            {
                $hasReviewer = $thesis->user()->where('role_id', $reviewer_role_id)->exists();
            
                //check if thesis already has reviewer and if thesis has status "Kaitsmisele lubatud"
                if ($hasReviewer == false && $thesis->status_id == 3)
                {
                    //attach user with given thesis as reviewer
                    $thesis->user()->attach($request->input('thesis_reviewer'), array('role_id' => $reviewer_role_id));
                    return redirect()->back()->with('success', 'Retsensent lisatud!');
                }
                elseif ($hasReviewer == true && $thesis->status_id == 3)
                {
                    //update thesis reviewer 
                    foreach ($thesis->role as $reviewer)
                    {
                    if ($reviewer->id == 8)
                        {
                            $reviewer->pivot->user_id = $request->input('thesis_reviewer');
                            $reviewer->pivot->save();
                        }
                    }
                    
                    //remove previous reviewer's grade and comment
                    $previous_assessment_id = $thesis->reviewer_assessment_id;
                    $thesis->reviewer_grade_id = NULL;
                    $thesis->reviewer_assessment_id = NULL;
                    $thesis->save();
                    
                    if ($previous_assessment_id != NULL)
                    {
                        $reviewer_assessment = ReviewerAssessment::find($previous_assessment_id);
                        $reviewer_assessment->delete();
                    }
                    
                    return redirect()->back()->with('success', 'Retsensent muudetud!');
                }
                else
                {
                    return redirect()->back()->with('error', 'Antud tööl on ebapiisav staatus!');
                }
            }
            else 
            {
                return redirect('/home');
            }
        }
        
        //committee actions
        elseif ($request)
        {
            if ($user->hasRole('Komisjoni esimees'))
            {
                $thesis = Thesis::find($id);
                $committee_actions = $thesis->status->name != 'Kaitstud';
                
                if ($committee_actions)
                {
                    //update thesis status to "Kaitstud"
                    $thesis->status_id = 4;
                    $thesis->save();
                }
                else 
                {
                    //else change back to "Kaitsmisele lubatud"
                    $thesis->status_id = 3;
                    $thesis->save();
                }
                
                return redirect()->back()->with('success', 'Staatus uuendatud!');
            }
            else
            {
                return redirect('/home')->with('error', 'Midagi läks valesti! Teil võib puududa vastav ligipääs.');
            }
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
        $thesis = Thesis::find($id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $student_role_id = Role::find(1)->id;
        $thesis_user_id = Helper::userOwnsThesis($thesis, $student_role_id);
        
        //check if current user has student role
        if ($user->hasRole('Õpilane'))
        {
            if ($user_id !== $thesis_user_id)
            {
                return redirect('/home');
            }
            
            $thesis->delete();
            return redirect('/home')->with('warning', 'Lõputöö kustutatud!');
        }
        else
        {
            return redirect('/home')->with('error', 'Teil puudub ligipääs!');
        }
    }
}
