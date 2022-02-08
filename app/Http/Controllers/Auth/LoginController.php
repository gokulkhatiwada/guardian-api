<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showLoginForm(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    /**
     * authenticate user
     * @param Request $request
     *
     */
    public function authenticate(Request $request)
    {
        $credentials =  $this->validate($request);

        if(Auth::attempt($credentials,$request->has('remember'))){
            $request->session()->regenerate();

            return $this->authenticated();
        }

        return response()->json([
            'email'=>'Email or password is invalid'
        ],422);

    }



    protected function validate($request)
    {
        return $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
    }

    protected function authenticated()
    {
        if(request()->expectsJson()){
            return response()->json('Ok',200);
        }
        if(auth()->user()->is_admin){
            return redirect()->intended('/dashboard');
        }

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}