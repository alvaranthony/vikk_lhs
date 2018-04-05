<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use DB;

class UserController extends Controller
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
    
    public function showProfile()
    {
        $user_id = Auth::user()->id;
        $current_user = User::find($user_id);
        $user_roles = $current_user->role->unique();
        
        return view('user.profile')
            ->with('user', $current_user)
            ->with('userRoles', $user_roles);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $current_user = User::find($user_id);
        
        //check if current user has administrator role
        if ($current_user->hasRole('Administraator'))
        {
            if($request->input('last_name'))
            {
                $users_all = User::where('last_name', 'like', '%'.$request->input('last_name').'%')->get();
            }
            else
            {
                $users_all = User::all();
            }
            return view('admin.users')->with('users_all', $users_all);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::user()->id;
        $current_user = User::find($user_id);
        
        //check if current user has administrator role
        if ($current_user->hasRole('Administraator'))
        {
            $user = User::find($id);
            $roles_list = DB::table('roles')->whereIn('id', [2,4,5,6])->pluck('name', 'id');
            $user_roles = $user->role->unique();
            return view('admin.user')
                ->with('user', $user)
                ->with('rolesList', $roles_list)
                ->with('user_roles', $user_roles);
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
        $user_id = Auth::user()->id;
        $current_user = User::find($user_id);
        
        //update user roles(for admin)
        if($request->input('user_role'))
        {
            $user = User::find($id);
            //check if current user has administrator role
            if($current_user->hasRole('Administraator') && !$user->hasRole('Õpilane'))
            {
                $user = User::find($id);
                $user->role()->attach($request->input('user_role'));
                return redirect()->back()->with('success', 'Roll lisatud!');
            }
            else
            {
                return redirect()->back();
            }
        }
        elseif($request->input('exam_lang'))
        {
            if($current_user->hasRole('Õpilane'))
            {
                $current_user->exam_lang_id = $request->input('exam_lang');
                $current_user->save();
                return redirect()->back()->with('success', 'Eksamikeel lisatud!');
            }
            else
            {
                return redirect()->back();
            }
        }
        elseif($request->input('study_group'))
        {
            if($current_user->hasRole('Õpilane'))
            {
                $current_user->group_id = $request->input('study_group');
                $current_user->save();
                return redirect()->back()->with('success', 'Õppegrupp lisatud!');
            }
            else
            {
                return redirect()->back();
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
        $user_id = Auth::user()->id;
        $current_user = User::find($user_id);
        $student_role_id = Role::find(1)->id;

        //check if current user has administrator role
        if ($current_user->hasRole('Administraator') && $user_id != $id)
        {
            $user = User::find($id);   

            $hasThesis = $user->thesis()->where('role_id', $student_role_id)->exists();
            if($hasThesis)
            {
                foreach($user->thesis as $user_thesis)
                {
                    if($user_thesis->pivot->role_id === $student_role_id)
                    {
                        $user_thesis->delete();
                    }
                }
            }

            $user->delete();

            return redirect('/users')->with('warning', 'Kasutaja kustutatud!');
        }
        else
        {
            return redirect()->back();
        }
    }
}
