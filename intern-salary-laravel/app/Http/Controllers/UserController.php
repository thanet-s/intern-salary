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

            return redirect()->route('dashboard');
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

    public function addAdmin(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $name = $request->input('name');
                $email = $request->input('email');
                $pass1 = $request->input('password1');
                $pass2 = $request->input('password2');
                $emails = DB::select('select email from users');

                foreach ($emails as $em) {
                    if ($em->email == $email) {
                        return back()->withErrors(['email' => 'email does exists']);
                    }
                }

                if ($pass1 != $pass2) {
                    return back()->withErrors(['pass' => 'password not match']);
                }

                $user = new User();
                $user->name = $name;
                $user->password = Hash::make($pass1);
                $user->email = $email;
                $user->save();
                return redirect()->route('admins')->withErrors(['addsuccess' => 'ok',]);


            case 'GET':
                return view('addadmin');

            default:
                // invalid request
                return back();
        }
    }

    public function admins(Request $request)
    {
        $users = DB::select('select id, name, email from users');
        return view('admins', ['users' => $users]);
    }

    public function removeAdmin(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');
        $authId = Auth::user()->id;
        if ($id == $authId) {
            return back()->withErrors(['selfremove' => "ไม่สามารถลบตัวเองได้"]);
        }

        $deleted = DB::delete("delete from users where id = $id");

        return back()->withErrors(['remove' => "ลบ $name แล้ว"]);
    }
}
