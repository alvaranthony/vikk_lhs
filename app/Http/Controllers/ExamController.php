<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamLanguage;
use App\ExamType;
use App\Group;
use App\Exam;
use App\User;
use App\Role;
use Helper;
use Auth;
use DB;

class ExamController extends Controller
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
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        if($user->hasRole('Õpetaja'))
        {
            $exam_types_all = ExamType::all();
            return view('exam_registrations')->with('exam_types', $exam_types_all);
        }
        else
        {
            return redirect()->back();
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
        $exam_lang_list = ExamLanguage::all()->pluck('language', 'id');
        $groups_all = Group::all()->pluck('name', 'id');
        
        if ($user->hasRole('Õpilane'))
        {
            if ($user->group)
            {
                $isMatch_IS = Helper::isMatch('IS', $user->group->name);
                $isMatch_ISK = Helper::isMatch('ISK', $user->group->name);
                $isMatch_TA = Helper::isMatch('TA', $user->group->name);
                $isMatch_TAK = Helper::isMatch('TAK', $user->group->name);
                $isMatch_ITT = Helper::isMatch('ITT', $user->group->name);
                
                if ($isMatch_ITT)
                {
                    $exam_type_list = DB::table('exam_types')->whereIn('id', [3])->orderBy('id','ASC')->pluck('type', 'id');
                }
                elseif($isMatch_IS || $isMatch_ISK)
                {
                    if(!$user->thesis->isEmpty() && $user->thesis->first()->status_id === 4)
                    {
                        $exam_type_list = DB::table('exam_types')->whereIn('id', [1,3])->orderBy('id','ASC')->pluck('type', 'id');
                    }
                    else
                    {
                        $exam_type_list = DB::table('exam_types')->whereIn('id', [1,3,4])->orderBy('id','ASC')->pluck('type', 'id');
                    }
                }
                elseif($isMatch_TA || $isMatch_TAK)
                {
                    if(!$user->thesis->isEmpty() && $user->thesis->first()->status_id === 4)
                    {
                        $exam_type_list = DB::table('exam_types')->whereIn('id', [1,2])->orderBy('id','ASC')->pluck('type', 'id');
                    }
                    else
                    {
                        $exam_type_list = DB::table('exam_types')->whereIn('id', [1,2,5])->orderBy('id','ASC')->pluck('type', 'id');
                    }
                }
                else
                {
                    $exam_type_list = [];
                }
                
                return view ("user.create_exam")
                    ->with('user', $user)
                    ->with('groupsList', $groups_all)
                    ->with('exam_lang_list', $exam_lang_list)
                    ->with('exam_type_list', $exam_type_list)
                    ->with('isMatch_IS', $isMatch_IS)
                    ->with('isMatch_ISK', $isMatch_ISK)
                    ->with('isMatch_TA', $isMatch_TA)
                    ->with('isMatch_TAK', $isMatch_TAK)
                    ->with('isMatch_ITT', $isMatch_ITT);
            }
            else
            {
                $isMatch_IS = $isMatch_ISK = $isMatch_TA = $isMatch_TAK = $isMatch_ITT = false; 
                
                return view ("user.create_exam")
                    ->with('user', $user)
                    ->with('groupsList', $groups_all)
                    ->with('exam_lang_list', $exam_lang_list)
                    ->with('isMatch_IS', $isMatch_IS)
                    ->with('isMatch_ISK', $isMatch_ISK)
                    ->with('isMatch_TA', $isMatch_TA)
                    ->with('isMatch_TAK', $isMatch_TAK)
                    ->with('isMatch_ITT', $isMatch_ITT);
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
        $isMatch_IS = Helper::isMatch('IS', $user->group->name);
        $isMatch_ISK = Helper::isMatch('ISK', $user->group->name);
        $isMatch_TA = Helper::isMatch('TA', $user->group->name);
        $isMatch_TAK = Helper::isMatch('TAK', $user->group->name);
        $isMatch_ITT = Helper::isMatch('ITT', $user->group->name);
        
        if ($user->hasRole('Õpilane') && $user->exam_lang != NULL && $user->group != NULL &&
        ($isMatch_IS || $isMatch_ISK || $isMatch_ITT || $isMatch_TA || $isMatch_TAK))
        {
            if(!(count($user->exam_type) > 3))
            {
                if(!(((count($request->input('exam_type'))) + (count($user->exam_type))) > 3))
                {
                    $this->validate($request, [
                    'exam_type' => 'required',
                    ]);
                            
                    if(count($request->input('exam_type')))
                    //attach given exam_types to current user
                    $user->exam_type()->attach($request->input('exam_type'));
                    //$user->thesis()->attach($thesis->id, array('role_id' => $student_role_id));
                    
                    return redirect('/home')->with('success', 'Olete eksamitele edukalt registreeritud!');
                }
                else
                {
                    return redirect('/home')->with('error', 'Maksimaalselt on lubatud 3 eksami registreeringut!');
                }
                
            }
            else 
            {
                return redirect('/home')->with('error', 'Maksimaalselt on lubatud 3 eksami registreeringut!');
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
    public function show(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        if($user->hasRole('Õpetaja'))
        {
            $exam_type = ExamType::find($id);
            $groups_all = Group::all()->pluck('name', 'id')->prepend('Kõik', '');
            if($request->input('study_group'))
            {
                $exam_type_users = $exam_type->user->where('group_id', $request->input('study_group'));
            }
            else
            {
                $exam_type_users = $exam_type->user;
            }
            
            return view('exam_show')
                ->with('groupsList', $groups_all)
                ->with('exam_type', $exam_type)
                ->with('exam_type_users', $exam_type_users);
        }
        else 
        {
            return redirect()->back()->with('error', 'Teil puudub ligipääs!');
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
    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        $student_role_id = Role::find(1)->id;
        
        if ($user->hasRole('Õpilane'))
        {
            $exam = Exam::where('exam_type_id', $id)->where('user_id', $user_id);
            $exam->delete();
            
            return redirect('/home')->with('warning', 'Olete registreeringu antud eksamile tühistanud!');
        }
        else
        {
            return redirect('/home');
        }
    }
}
