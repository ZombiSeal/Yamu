<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Product;
use App\Models\ProductLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function show()
    {
        if(Auth::check() && Auth::user()->role_id === 1) {
            return redirect()->route('admin');
        }
        $labelId = Label::where('code', 'new')->first()->id;
        $productsNew = ProductLabel::where('label_id', $labelId)->pluck('product_id');
        $products = Product::whereIn('id', $productsNew)->get();
        return view('index', ['products' => $products]);
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
            if(session()->has('basket')) {
                $fullPrice = 0;
                foreach(session('basket') as $id=>$value) {
                    $product = Product::find($id);
                    if($product->sale_id) {
                        $product->price = $product->price * (1 - $product->sale->percent / 100);
                    }
                    $product->fullPrice = number_format($product->price * $value["capacity"], 2);

                    $fullPrice += (float)$product->fullPrice;
                    $fullPrice = number_format($fullPrice, 2);
                    $products[] = ["product" => $product, "capacity" => $value["capacity"]];
                }
            }
            return response()->view('catalog.basket', ["products" => $products ?? [], "fullPrice" => $fullPrice ?? 0]);
        }
    }
}
