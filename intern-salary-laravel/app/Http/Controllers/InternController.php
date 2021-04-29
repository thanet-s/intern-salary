<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternController extends Controller
{
    public function form(Request $request)
    {
        return view('addStudent');
    }

    public function add(Request $request)
    {
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

        return redirect()->route('dashboard')->withErrors(['addsuccess' => 'ok',]);
    }
}
