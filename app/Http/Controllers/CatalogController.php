<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductLabel;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(string $category)
    {
        $categoryId = Category::where('code', $category)->first()->id;
        $products = Product::where('is_active', true)->where('category_id', $categoryId)->with('labels')->with('sale')->paginate(8);
        if(!$products->isEmpty()) {
            foreach ($products as $product) {
                if($product->labels->contains('code', 'sale')) {
                    $product->salePrice = $product->price * (1 - $product->sale->percent / 100);
                }
            }
        }
        return view('catalog.catalog', ["products" => $products]);
    }

    public function detail(string $category, int $id)
    {
        $product = Product::find($id);
        return view('catalog.detail', ["product" => $product]);
    }

    public function addToBasket(Request $request)
    {
//        $request->session()->flush();
        $basket = session('basket');
        $capacity = (int)$request->capacity;

        if($basket) {
            foreach ($basket as $id=>$value) {
                if($id === (int)$request->productId) {
                    $capacity = ($capacity === $value) ? ++$value : $capacity;
                    break;
                }
            }
        }

        if($capacity === 0 && !isset($basket[$request->productId])) {
            $capacity++;
        }
        $basket[$request->productId] = $capacity;

        $basket = array_filter($basket, function($value) {
            return $value !== 0;
        });
        $fullCapacity = array_sum($basket);
        session(["basket"=>$basket, "fullCapacity"=>$fullCapacity]);

        return response()->json(["basket" => session("basket"), "fullCapacity"=>$fullCapacity]);
    }

    public function deleteFromBasket(Request $request) {
      
    }
}
