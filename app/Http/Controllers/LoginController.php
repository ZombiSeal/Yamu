<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],
            [
                'email.required' => 'Заполните поле',
                'password.required' => 'Заполните поле',
            ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

//            if(Auth::user()->email == 'admin@admin.com') {
//                return redirect()->intended(route('admin'));
//            } else {
                return response()->json(['status' => 'ok', 'data' => "Вы успешно вошли в систему"]);
//            }
        }

        return response()->json(['status' => 'error', 'customError' => 'Неверный логин или пароль']);

    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('main');
    }
}
