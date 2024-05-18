<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $categories = Category::all()->where('is_active', true);
            return response()->view('menu', ['categories' => $categories]);
        }
        if($request->get('page') === "basket") {
            return response()->view('catalog.basket');
        }
    }
}
