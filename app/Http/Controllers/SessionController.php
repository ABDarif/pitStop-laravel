<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store()
    {
        // validate
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        // log in
        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'password' => 'Sorry, those credentials do not match!'
            ]);
        };

        request()->session()->regenerate();

        // redirect
        $admin = ["abdarifnitul@gmail.com"];
        $mechanics = ["johndoe@gmail.com", "emilydavis@gmail.com", "mikebrown@gmail.com"];

        if (in_array($attributes['email'], $admin)) {
            return redirect('/admin');
        }

        elseif (in_array($attributes['email'], $mechanics)) {
            return redirect('/mechanic');
        }

        else {
            return redirect('/index');
        }
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/login');
    }
}
