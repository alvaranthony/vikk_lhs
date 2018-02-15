<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thesis;
use App\Fileentry;
use Helper;
use App\User;
use App\Role;
use App\Status;
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
        
        if ($user->hasRole('Õpetaja'))
        {
            if($request->input('thesis_status'))
            {
                $theses_all = Thesis::all()->where('status_id', $request->input('thesis_status'));
            }
            elseif($request->input('name'))
            {
                $theses_all = Thesis::where('name', 'like', '%'.$request->input('name').'%')->get();
            }
            else
            {
                $theses_all = Thesis::all();
            }
            
            $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
            $statuses = Status::all()->pluck('name', 'id')->prepend('Kõik', '');
            
            return view('theses')
                ->with('user', $user)
                ->with('statusList', $statuses)
                ->with('users_all', $users_all)
                ->with('theses_all', $theses_all);
        }
        else 
        {
            return redirect('/home');
        }
    }
    
    public function instructorTheses()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
        $theses = $user->thesis;
        
        if ($user->hasRole('Juhendaja'))
        {
            return view('instructor_theses')
                ->with('users_all', $users_all)
                ->with('theses', $theses);
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
        //let user create new thesis if user is student
        if ($user->hasRole('Õpilane'))
        {
            $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
            //get a list of all non students
            $non_students = Helper::getNonStudents($users_all);
            return view ("user.create_thesis")->with('usersList', $non_students);
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
                'thesis_instructor' => 'required'
                ]);
                
                //Create new thesis for current user
                $thesis = new Thesis;
                $thesis->status_id = $status_submit_instructor;
                $thesis->name = $request->input('name');
                $thesis->defense_date = $request->input('defense_date');
                $thesis->save();
                
                //attach user with given thesis
                $user->thesis()->attach($thesis->id, array('role_id' => $student_role_id));
                
                //check if thesis already has an instructor 
                $hasInstructor = $thesis->user()->where('role_id', $instructor_role_id)->exists();
                if ($hasInstructor == false)
                {
                    //attach user with given thesis as instructor
                    $thesis->user()->attach($request->input('thesis_instructor'), array('role_id' => $instructor_role_id));
                }
                
                //Add relation to thesis and user
                #$relation = new Relation; 
                #$relation->thesis_id = $thesis->id;
                #$relation->user_id = Auth::user()->id;
                #$relation->save();
                 
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
        $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
        $thesis = Thesis::find($id);
        $statuses = DB::table('statuses')->whereIn('id', [1,2,3])->pluck('name', 'id');
        $status_id = $thesis->status->id;
        
        return view('thesis')
            ->with('users_all', $users_all)
            ->with('statusList', $statuses)
            ->with('status_id', $status_id)
            ->with('thesis', $thesis);
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
        if ($user->hasRole('Õpilane'))
        {
            if ($user_id !== $thesis_user_id)
            {
                return redirect('/home')->with('error', 'Teil puudub ligipääs!');
            }
            else 
            {
                $users_all = User::select('id', DB::raw("concat(first_name, ' ', last_name) as full_name"))->get();
                #$statuses = Status::all()->pluck('name', 'id');
                #$status_id = $thesis->status->id;
                $non_students = Helper::getNonStudents($users_all);
                
                
                foreach ($thesis->role as $instructor)
                {
                    if ($instructor->id == 3)
                    {
                        $insructor_id = $instructor->pivot->user_id;
                    }
                    else
                    {
                        $insructor_id = NULL;
                    }
                }
                
                return view ('user.edit_thesis')
                    ->with('thesis', $thesis)
                    ->with('instructor_id', $insructor_id)
                    #->with('statusList', $statuses)
                    #->with('status_id', $status_id)
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
        $thesis_user_id = Helper::userOwnsThesis($thesis, $student_role_id);
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
                 //update thesis status
                 #$thesis->status_id = $request->input('thesis_status');
                 $thesis->save();
                 
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
        elseif ($user->hasRole('Juhendaja'))
        {
            if ($request->input('thesis_status'))
            {
                //update thesis status
                $thesis = Thesis::find($id);
                $thesis->status_id = $request->input('thesis_status');
                $thesis->save();
                
                return redirect('/instructor/theses')->with('success', 'Staatus uuendatud!');
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
        
        if ($user->hasRole('Õpilane'))
        {
            if ($user_id !== $thesis_user_id)
            {
                return redirect('/home');
            }
            
            $thesis->delete();
            return redirect('/home');
        }
        else
        {
            return redirect('/home');
        }
    }
}
