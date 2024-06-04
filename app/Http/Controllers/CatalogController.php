<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\NameRequest;
use App\Http\Requests\PhoneRequest;
use App\Models\Addition;
use App\Models\Address;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Delivery;
use App\Models\InfoOrder;
use App\Models\Label;
use App\Models\Order;
use App\Models\OrderAddition;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductLabel;
use App\Models\Quiz;
use App\Models\QuizCoupon;
use App\Models\UserCoupon;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index(string $category)
    {
        $categoryProduct = Category::where('code', $category)->first();
        $products = [];
        if($categoryProduct) {
            $products = Cache::remember("products".$categoryProduct->id, 360000, function() use ($categoryProduct) {
                return Product::where('is_active', true)
                    ->where('category_id', $categoryProduct->id)
                    ->with('labels', 'sale')
                    ->paginate(8);
            });
        } else {
            $categoryProduct = Label::where('code', $category)->first();
            $labelProductsId = ProductLabel::where('label_id', $categoryProduct->id)->pluck('product_id');
            $products = Cache::remember("products" . $category, 360000, function() use ($labelProductsId) {
                return Product::whereIn('id', $labelProductsId)
                    ->where('is_active', true)
                    ->with('labels', 'sale')
                    ->paginate(8);
            });
        }
        if (!$products->isEmpty()) {
            foreach ($products as $product) {
                if ($product->labels->contains('code', 'sale')) {
                    $product->salePrice = $product->price * (1 - $product->sale->percent / 100);
                    $product->salePrice = number_format($product->salePrice, 2);
                }
            }
        }

        return view('catalog.catalog', ["products" => $products, "category" => $categoryProduct]);
    }

    public function detail(string $category, int $id)
    {
        $product = Product::find($id);
        $capacity = (session('basket') && session('basket.'.$id)) ? session('basket.'.$id)['capacity'] : 0;
        if(($product->sale)) {
            $product->salePrice =  $product->price * (1-$product->sale->percent / 100);
            $product->salePrice = number_format($product->salePrice, 2);
        }
//        dd($product->salePrice);
        return view('catalog.detail', ["product" => $product, 'capacity'=>$capacity]);
    }

    public function order(Request $request)
    {
        if (session()->has('basket')) {
            $fullPrice = 0;
            foreach (session('basket') as $id => $value) {
                $product = $this->setProduct($id, $value["capacity"]);
                $fullPrice += $product->fullPrice;
                $fullPrice = number_format($fullPrice, 2);
                $products[] = ["product" => $product, "capacity" => $value["capacity"], "fullPrice" => $fullPrice];
            }

            $additions = Addition::all();
            $deliveries = Delivery::where('is_active', true)->get();
            $address = Address::find(1);
            $payments = Payment::where('is_active', true)->get();

            return response()->view('catalog.order', [
                "products" => $products ?? [],
                "fullPrice" => $fullPrice ?? 0,
                "additions" => $additions ?? [],
                "deliveries" => $deliveries ?? [],
                "address" => $address ?? [],
                "payments" => $payments ?? [],
            ]);
        } else {
            return response()->view('errors.404');
        }
    }

    public function addCoupon(Request $request): JsonResponse
    {
        $coupon = Coupon::where('code', $request->coupon)->with('sale')->first();

        if ($coupon) {
            $isQuizCoupon = Quiz::where('coupon_id', $coupon->id)->first();
            if ($isQuizCoupon) {
                $user = Auth::id();
                $isUserCoupon = ($user) ? UserCoupon::where('user_id', $user)
                    ->where('coupon_id', $coupon->id)
                    ->where('is_active', true)->first() : null;

                if (!$isUserCoupon) {
                    return response()->json(["status" => "error", "message" => "Такого купона не существует"]);
                }
            }

            $newPrice = session('fullPrice') * (1 - $coupon->sale->percent / 100);
            $salePrice = $coupon->sale->percent / 100;
            return response()->json([
                "status" => "ok",
                "newPrice" => number_format($newPrice, 2),
                "salePrice" => number_format($salePrice, 2),
                "view" => view('components.coupon-card', ["coupon" => $coupon, "type" => "coupon"])->render()
            ]);
        }
        return response()->json(["status" => "error", "message" => "Такого купона не существует"]);
    }

    public function addToBasket(Request $request): JsonResponse
    {
        $this->addProductToSession($request->capacity, $request->productId);

        if (session('fullCapacity') == 0) {
            $empty = view('catalog.empty-basket')->render();
        }
        return response()->json([
            "basket" => session("basket"),
            "fullCapacity" => session("fullCapacity"),
            "fullPrice" => number_format(session("fullPrice"), 2),
            "empty" => $empty ?? ""]);
    }

    public function deleteFromBasket(Request $request): JsonResponse
    {
        $basket = session('basket');
        $fullCapacity = session('fullCapacity') - $basket[$request->productId]["capacity"];
        $fullPrice = number_format(session('fullPrice') - $basket[$request->productId]["fullPrice"], 2);
        unset($basket[$request->productId]);
        session(["basket" => $basket, "fullCapacity" => $fullCapacity]);

        if ($fullCapacity == 0) {
            $this->forgetBasketSession();
            $empty = view('catalog.empty-basket')->render();
        }
        return response()->json([
            "basket" => session("basket") ?? [],
            "fullCapacity" => $fullCapacity,
            "fullPrice" => $fullPrice,
            "empty" => $empty ?? ""]);
    }

    public function clearBasket(Request $request): JsonResponse
    {
        $this->forgetBasketSession();
        return response()->json(view('catalog.empty-basket')->render());
    }

    public function repeatOrder(Request $request): JsonResponse
    {
        $this->forgetBasketSession();
        $orderInfo = InfoOrder::where("order_id", $request->orderId)->get();
        if (!$orderInfo->isEmpty()) {
            foreach ($orderInfo as $order) {
                $this->addProductToSession($order->quantity, $order->product_id);
            }
        }
        return response()->json(["fullCapacity" => session("fullCapacity")]);
    }

    public function addOrder(Request $request): JsonResponse
    {
        $validName = $this->checkField($request->all(), new NameRequest());
        $validPhone = $this->checkField($request->all(), new PhoneRequest());
        $validAddress = (Delivery::find($request->delivery)->code !== 'selfservice') ? $this->checkField($request->all(), new AddressRequest()) : [];

        $errors = $validName + $validPhone + $validAddress ?? [];

        if (empty($errors)) {
            try {
                DB::transaction(function () use ($request) {
                    $delivery = Delivery::find($request->delivery);
                    if ($delivery->code !== "selfservice") {
                        $address = Address::create([
                            'city' => $request->city,
                            'street' => $request->street,
                            'house' => $request->house,
                            'corpus' => $request->corpus,
                            'flat' => $request->flat,
                            'entrance' => $request->entrance,
                            'floor' => $request->floor
                        ]);
                    }

                    $order = Order::create([
                        'number' => $this->generateOrderNumber(),
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'delivery_time' => $request->time,
                        'date' => Carbon::now()->toDateString(),
                        'comment' => $request->comment,
                        'coupon_id' => $request->coupon,
                        'user_id' => (Auth::id()) ?: null,
                        'delivery_id' => $request->delivery,
                        'payment_id' => $request->payment,
                        'status_id' => 1,
                        'address_id' => $address->id ?? 1
                    ]);

                    if (Auth::id() && $request->coupon) {
                        $userCoupon = UserCoupon::where('user_id', Auth::id())
                            ->where('coupon_id', (int)$request->coupon)
                            ->first();
                        if ($userCoupon) {
                            $userCoupon->is_active = false;
                            $userCoupon->save();
                        }
                    }

                    if (!empty($request->additions)) {
                        foreach ($request->additions as $id => $capacity) {
                            OrderAddition::create([
                                'order_id' => $order->id,
                                'addition_id' => (int)$id,
                                'quantity' => (int)$capacity,
                            ]);
                        }
                    }

                    if (session('basket')) {
                        foreach (session('basket') as $id => $value) {
                            InfoOrder::create([
                                'order_id' => $order->id,
                                'product_id' => $id,
                                'quantity' => $value['capacity'],
                            ]);
                        }
                    }
                    $this->forgetBasketSession();


                });
                return response()->json(["status" => "ok", "message" => "Заказ будет подтвержден после звонка оператора"]);
            } catch (\Throwable $e) {
                return response()->json(["error" => $e, "status" => "error"]);
            }
        } else {
            return response()->json(["status" => "error", "errors" => $errors]);
        }

    }

    private function setProduct($id, $capacity)
    {
        $product = Product::find($id);
        if ($product->sale_id) {
            $product->price = $product->price * (1 - $product->sale->percent / 100);
        }
        $product->fullPrice = $product->price * $capacity;
        $product->fullPrice = number_format($product->fullPrice, 2);

        return $product;
    }

    private function forgetBasketSession(): void
    {
        session()->forget("basket");
        session()->forget("fullCapacity");
        session()->forget("fullPrice");
    }

    private function addProductToSession($productCapacity, $productId): void
    {
        $basket = session('basket');
        $capacity = (int)$productCapacity;

        if ($basket) {
            foreach ($basket as $id => $value) {
                if ($id === (int)$productId) {
                    $capacity = ($capacity === $value["capacity"]) ? ++$value["capacity"] : $capacity;
                    break;
                }
            }
        }

        if ($capacity === 0 && !isset($basket[$productId])) {
            $capacity++;
        }
        $product = $this->setProduct($productId, $capacity);
        $basket[$productId] = ["capacity" => $capacity, "fullPrice" => $product->fullPrice];

        $basket = array_filter($basket, function ($value) {
            return $value["capacity"] !== 0;
        });

        $fullCapacity = array_sum(array_column($basket, "capacity"));
        $fullPrice = array_sum(array_column($basket, 'fullPrice'));
        session(["basket" => $basket, "fullCapacity" => $fullCapacity, "fullPrice" => $fullPrice]);
    }

    private function checkField(array $data, $valid): array
    {
        $rules = $valid;
        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray();
    }

    private function generateOrderNumber()
    {
        $orderNum = "";
        $flag = false;
        while (!$flag) {
            $orderNum = mt_rand(100000, 999999);

            $checkNum = Order::where("number", $orderNum)->first();
            if (!$checkNum) {
                $flag = true;
            }
        }

        return $orderNum;
    }

}
