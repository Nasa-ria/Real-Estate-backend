<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminSignUp(Request $request)
    {  
         $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8| confirmed',
        
      
        ]);
        $user= new User();
        $user-> name    = $request->input('name');
        $user-> email    = $request->input('email');
        $user-> password    =  Hash::make('password');
        $user->isAdmin =$request->has('isAdmin');
         $user->save();
        if ($request->isAdmin) {
                        $admin= new Admin();
                        $admin->location = $request->input('location');
                        $admin->contact = $request->input('contact');
                        
                        $admin->user_id = $user->id;;
                       
                        $admin->save();
                        return $admin;

                    }$user->save();
                    return $user;




   }


    public function AdminLogin(Request $request, Admin $user)
    { 
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

      
            $loginDetails = [
                'email' => $request->email,
                'password' => $request->password,
            ];
    
        
           // return $loginDetails;

        if(Auth::attempt($loginDetails)){
            dd(Auth::attempt($loginDetails));
           
            return "login";
        }
    }








}