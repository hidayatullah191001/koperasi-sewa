<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
     public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerate session
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->is_active != 'yes') {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is not active. Please contact administrator.');
            }
            // Check role_id
            if ($user->role_id != null) {
                if ($user->role->code == 'SUADM') {
                    return redirect()->intended('superadmin');
                } elseif($user->role->code == 'ADM'){
                    return redirect()->intended('admin');
                } else {
                    return redirect()->route('login')->with('error', 'You don\'t have permission to access this');
                }
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role is not assigned to your account');
            }
        } else {
            return redirect()->back()->with('error', 'Email or password is wrong')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }

}
