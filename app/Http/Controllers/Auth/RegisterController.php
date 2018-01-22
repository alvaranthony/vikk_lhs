<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Role;
use Auth;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'id_code' => 'required|string|max:11|unique:users',
            'phone_number' => 'required|string|max:16|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $default_role = Role::find(7)->id;
        $student_role = Role::find(1)->id;
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'id_code' => $data['id_code'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        
        if (!isset($data['user_checkbox']))
        {
            $user->role()->attach($default_role);
        }
        else if (isset($data['user_checkbox']))
        {
            $user->role()->attach($student_role);
        }
        
        return $user;
        
        //TODO 
        //MUUTA ROLLIDE MÄÄRAMINE CUSTOM FUNKTSIOONIDEGA
        //ERROR HANDLING
    }
}
