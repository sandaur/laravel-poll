<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authForm(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = $this->validateCredentials($request);
        if ($validator->fails()) {
            return redirect()->route('login-form')->withErrors($validator)->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            $request->session()->flash('message', 'La contraseña o el nombre de usuario son invalidos.');
            return redirect()->route('login-form')->withInput($request->except('password'));
        }
    }

    private function validateCredentials(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];

        $messages = [
            'email.*' => 'El email ingresado no es valido.',
            'password.*' => 'La contraseña ingresada no es valida.',
        ];

        return validator($request->all(), $rules, $messages);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
