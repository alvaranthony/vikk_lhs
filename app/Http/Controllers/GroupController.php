<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use Auth;

class GroupController extends Controller
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
        $current_user = User::find($user_id);
        
        //check if current user has administrator role
        if ($current_user->hasRole('Administraator'))
        {
            if($request->input('group_name'))
            {
                $groups_all = Group::where('name', 'like', '%'.$request->input('group_name').'%')->get();
            }
            else 
            {
                $groups_all = Group::all();
            }
            
            return view('admin.groups')->with('groups_all', $groups_all);
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
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $group_exists = Group::where('name', $request->input('new_group_name'))->exists();
        
        if (!$group_exists)
        {
            if($user->hasRole('Administraator'))
            {
                $this->validate($request, [
                'new_group_name' => 'required|string|max:25',
                ]);
                        
                //Create new comment for current thesis
                $group = new Group;
                $group->name = $request->input('new_group_name');
                $group->save();
                
                return redirect('/groups')->with('success', 'Grupp lisatud!');
            }
            else 
            {
                return redirect('/groups');
            }
        }
        else 
        {
            return redirect('/groups')->with('error', 'Antud õppegrupp on juba olemas!');
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
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $group_exists = Group::where('name', $request->input('updated_group_name'))->exists();
        
        //check if current user has student role
        if ($user->hasRole('Administraator') && !$group_exists)
        {
            $this->validate($request, [
            'updated_group_name' => 'required|string|max:25',
            ]);
            
            //Create new comment for current thesis
            $group = Group::find($id);
            $group->name = $request->input('updated_group_name');
            $group->save();
            
            return redirect('/groups')->with('success', 'Grupi nimi muudetud!');
        }
        else 
        {
            return redirect('/groups');
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
        // JÄÄB HEKTEL VÄLJA, VAJA PAREMINI LÄBI MÕELDA
        /*
        $group = Group::find($id);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        
        //check if current user has admin role
        if ($user->hasRole('Administraator'))
        {
            $group->delete();
            return redirect('/groups');
        }
        else 
        {
            return redirect('/groups');
        }
        */
    }
}
