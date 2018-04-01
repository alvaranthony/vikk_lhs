<?php

//helper functions for vikk_lhs

class Helper{
    //function to check if current user has student role
    /*
    public static function isStudent($user, $user_id){
        foreach($user->role as $role)
        {
            if ($role->id === 1)
            {
                return true;
                break;
            }
            else
            {
                return false;
                break;
            }
        }
    }
    
    //function to check if current user has teacher role
    public static function isTeacher($user, $user_id){
        foreach($user->role as $role)
        {
            if ($role->id === 2)
            {
                return true;
                break;
            }
            else
            {
                return false;
                break;
            }
        }
    }
    
    //function to check if current user has default role
    public static function isDefault($user, $user_id){
        foreach($user->role as $role)
        {
            if ($role->id === 7)
            {
                return true;
                break;
            }
            else
            {
                return false;
                break;
            }
        }
    }
    */
    
    //function to check if current user owns current thesis
    public static function userOwnsThesis($thesis, $student_role_id)
    {
        foreach ($thesis->user as $t_user)
        {
            if ($t_user->pivot->role_id === $student_role_id)
            {
                   $thesis_user_id = $t_user->id;
            }
        }
        return $thesis_user_id;
    }
    
    //function to check if current user is instructor of given thesis
    public static function userIsInstructorOrReviewer($thesis, $current_user_id, $role_id)
    {
        foreach ($thesis->user as $t_user)
        {
            if ($t_user->pivot->user_id === $current_user_id && $t_user->pivot->role_id === $role_id)
            {
                return true;
            }
        }
        return false;
        
    }
    
    //function to get all non-student users list
    public static function getNonStudents($users_all)
    {
        $non_students = array();
        foreach ($users_all as $user)
        {
            foreach($user->role as $role){
               {
                    if ($role->id != 1)
                    {
                        if(!in_array($user->id, $non_students))
                        {
                            $non_students[$user->id] = $user->full_name;
                        }
                    }
               }
            }
        }
        return $non_students;
    }
    
    //check if user has specific study group
    public static function isMatch($matchable, $group_name)
    {
        $group_name_stripped = preg_replace('/[0-9]+/', '', $group_name);
        if ($group_name_stripped === $matchable)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}