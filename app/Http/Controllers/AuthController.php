<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //login valid?

        if (Auth::attempt($credentials)) {

            $user = auth()->user();
            session(['cabang'=> $user->cabang],['dept'=>$user->dept],['id'=>$user->id]);
            return redirect('dashboard');

            // return redirect()->intended('dashboard');
        }
        return back()->withErrors('password')->with('failed', 'Email atau Password Salah !!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function showregisterform()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = 0;
        $user->save();

        Auth::login($user);

        return redirect()->route('login');
    }

}
