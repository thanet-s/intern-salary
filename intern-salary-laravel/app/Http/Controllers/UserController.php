<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Login ไม่สำเร็จ: email หรือรหัสผ่านไม่ถูกต้อง',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->withErrors(['logout' => 'logetedout',]);
    }

    public function resetPass(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $password = $request->input('password');
                $new1 = $request->input('newpassword1');
                $new2 = $request->input('newpassword2');
                if ($new1 == $new2) {
                    if (Hash::check($password, Auth::user()->password)) {
                        $request->user()->fill([
                            'password' => Hash::make($new1)
                        ])->save();
                        return back()->withErrors([
                            'success' => 'reset',
                        ]);
                    } else {
                        return back()->withErrors([
                            'password' => 'reset err',
                        ]);
                    }
                } else {
                    return back()->withErrors([
                        'password' => 'reset err',
                    ]);
                }

            case 'GET':
                return view('user');

            default:
                // invalid request
                return back();
        }
    }

    public function addAdmin(Request $request) {
        switch ($request->method()) {
            case 'POST':
                
                

            case 'GET':
                return view('user');

            default:
                // invalid request
                return back();
        }
    }

    public function admins(Request $request) {
        $users = DB::select('select id, name, email from users');
        return view('admins', ['users' => $users]);
    }
}
