<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function SignUp(Request $request)
    { 
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8| confirmed',
        
      
        ]);
        $user= new User();
        $user-> name    = $request->input('name');
        $user-> email    = $request->input('email');
        $user-> password    =  Hash::make($request->password);
        $user->isAdmin =$request->has('isAdmin');
         $user->save();
         $token = $user->createToken("hi");
         // dd($token);
         $accessToken = $token->accessToken;
        if ($request->isAdmin) {
                        $admin= new Admin();
                        $admin->location = $request->input('location');
                        $admin->contact = $request->input('contact');                       
                        $admin->user_id = $user->id;
                        $admin->save();
                        return $admin.$accessToken;

         }   
       //if user is saved, create a token for them
        $token = $user->createToken("hi");
        $accessToken = $token->accessToken;
        if ($request->isAdmin) {
            return response()->json([
                'data' => new $user->refresh(),
                'token' => $accessToken,

            ]);
        } else {
            return response()->json([
                'data' => $user->refresh(),
                'token' => $accessToken
            ]);
        }
                    $user->save();
                    return $user;

   }


    public function Login(Request $request)
    { 
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return "success";            
        }
             return "fail";
        }



        public function logout() {
            Session::flush();
            Auth::logout();
      
            return 'logout';
        }

    }








