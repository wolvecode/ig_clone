<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //Redirect if user is already login
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    //view user login
    public function index()
    {
        return view('auth.login');
    }
    //log user in
    public function  store(Request  $request)
    {
        //validate user
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        //sign user in
        if(!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            return back()->with('status', 'Invalid login details');
        }

        //redirect
        return redirect()->route('dashboard');
    }

}
