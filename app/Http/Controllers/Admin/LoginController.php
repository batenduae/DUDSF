<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login')->with('messages','');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'     =>  'required|email',
            'password'  =>  'required|string|min:6'
        ]);
        if (Auth::guard('admin')->attempt([
            'email'     =>  $request->email,
            'password'  =>  $request->password
        ], $request->get('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }
        return back()->withInput($request->only('email','remember'))->with('message','Login attempt Failed. Credentials doesn\'t match');
    }
}
