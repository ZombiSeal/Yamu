<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function show()
    {
        return view('index');
    }

    public function rightMenu(Request $request)
    {
        if($request->get('page') === "auth") {
            return response()->view('auth');
        }
        if($request->get('page') === "register") {
            return response()->view('register');
        }
        if($request->get('page') === "menu") {
            return response()->view('menu');
        }
        if($request->get('page') === "basket") {
            return response()->view('basket.basket');
        }
    }
}
