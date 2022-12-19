<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminSignUp(Request $request)
    {  
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
      
    ]);
    $admin= new Admin();
    $admin-> name    = $request->input('name');
    $admin-> email    = $request->input('email');
    $admin-> password    =  Hash::make('password');

   $admin->save();

   return $admin;

}
}