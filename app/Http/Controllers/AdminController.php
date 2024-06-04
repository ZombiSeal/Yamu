<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\NameRequest;
use App\Http\Requests\PasswordRepeatRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\PhoneRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\QuizRequest;
use App\Http\Requests\StringRequest;
use App\Models\Answer;
use App\Models\BookTable;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Label;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductLabel;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function showUsers()
    {
        $action = \request()->route('action');
        $id = \request()->route('id');
        $params = [];
        if (empty($action)) {
            $users = User::with('role')->paginate(8);
            if (!$users->isEmpty()) {
                foreach ($users as $user) {
                    if ($user->birthday)
                        $user->birthday = \DateTime::createFromFormat('Y-m-d', $user->birthday)->format('d.m.Y');
                }
            }
            $params['users'] = $users;
        } else {
            $roles = Role::all();
            $params = ['roles' => $roles];

            if ($action === 'edit') {
                $params['user'] = User::find($id);
            }
        }

        return view('admin.users', $params);
    }

    public function showOrders()
    {
        $orders = Order::orderByDesc('date')
            ->paginate(8);

        if(!$orders->isEmpty()) {
            foreach ($orders as $order) {
                $order->date = \DateTime::createFromFormat('Y-m-d', $order->date)->format('d.m.Y');
                if ($order->delivery_time)
                    $order->delivery_time = \DateTime::createFromFormat('H:i:s', $order->delivery_time)->format('H:i');
            }
        }
        $statuses = Status::where('is_active', true)->get();
        return view('admin.orders', ["orders" => $orders, "statuses" => $statuses]);

    }

    public function showReserve()
    {
        $tables = BookTable::with('table')
            ->whereDate('date', '>=',  Carbon::now())
            ->orderBy('date')
            ->paginate(8);
        if(!$tables->isEmpty()) {
            foreach ($tables as $table) {
                $table->date = \DateTime::createFromFormat('Y-m-d', $table->date)->format('d.m.Y');
                $table->time = \DateTime::createFromFormat('H:i:s', $table->time)->format('H:i');
            }
        }
        return view('admin.reserve', ["tables" => $tables]);

    }
    public function showProducts()
    {
        $action = \request()->route('action');
        $id = \request()->route('id');
        $params = [];
        if (empty($action)) {
            $products = Product::with('sale')->with('category')->paginate(8);
            $params = ["products" => $products];
        } else {
            $sales = Sale::where('is_active', 1)->get();
            $categories = Category::where('is_active', 1)->get();
            $params = ['sales' => $sales, 'categories' => $categories];

            if ($action === 'edit') {
                $labelId = Label::where('code', 'new')->first()->id;
                $isNew = ProductLabel::where('product_id', $id)->where('label_id', $labelId)->first();
                $params['product'] = Product::find($id);
                $params['isNew'] = $isNew;
            }
        }

        return view('admin.products', $params);
    }

    public function showCoupons()
    {
        $action = \request()->route('action');
        $id = \request()->route('id');
        $params = [];
        if (empty($action)) {
            $coupons = Coupon::with('sale')->with('quiz')->paginate(8);
            $params = ["coupons" => $coupons];
        } else {
            $sales = Sale::where('is_active', 1)->get();
            $params = ['sales' => $sales];

            if ($action === 'edit') {
                $params['coupon'] = Coupon::find($id);
            }
        }

        return view('admin.coupons', $params);
    }


    public function showQuizzes()
    {
        $action = \request()->route('action');
        $id = \request()->route('id');
        $params = [];
        if (empty($action)) {
            $quizzes = Quiz::with('coupon')->paginate(8);
            $params = ["quizzes" => $quizzes];
        } else {
            $params = $this->getActiveCoupons();

            if ($action === 'edit') {
                $params['quiz'] = Quiz::find($id);
            }
        }

        return view('admin.quizzes', $params);
    }

    public function showQuizQuestions()
    {
        return view('admin.quizzes-add-questions');
    }

    public function addUser(Request $request): JsonResponse
    {
        $elem = User::find($request->route('id'));
        $emailError = ($elem->email !== $request->email) ? $this->checkField($request->all(), new EmailRequest()) : [];
        $nameError = ($elem->name !== $request->name) ? $this->checkField($request->all(), new NameRequest()) : [];
        $phoneError = (($request->phone)) ? $this->checkField($request->all(), new PhoneRequest()) : [];
        $passwordError = ($request->password) ? $this->checkField($request->all(), new PasswordRequest()) : [];
        $passwordRepeatError = ($request->password) ? $this->checkField($request->all(), new PasswordRepeatRequest()) : [];

        $errors = $emailError + $nameError + $phoneError + $passwordError + $passwordRepeatError;


        if ($errors) {
            return response()->json(["status" => "error", "errors" => $errors, "ee" => $request->query('action')]);
        } else {

            $elem->role_id = $request->role;
            $elem->name = $request->name;
            $elem->email = $request->email;
            $elem->phone = $request->phone;
            $elem->birthday = \DateTime::createFromFormat('d.m.Y', $request->birthday)->format('Y-m-d');
            if(($request->password)) $elem->password = Hash::make($request->password);
            $elem->save();

            return response()->json(["status" => 'ok', "redirect" => route('admin.users'), 'id' => $request->route('id')]);
        }
    }

    public function addProduct(Request $request): JsonResponse
    {
        $valid = $this->checkField($request->all(), new ProductRequest());
        $isFile = ($request->hasFile('image')) ? [] : ['image' => 'Выберите картинку'];

        $errors = $valid + $isFile;

        if ($errors) {
            return response()->json(["status" => "error", "errors" => $errors, 'id' => $request->route('id')]);
        } else {
            $path = $this->uploadFile($request->file('image'), 'images/products');
            if ($request->query('action') === 'add') {
                DB::transaction(function () use ($request) {
                    $attributes = ProductAttribute::create([
                        "carbs" => $request->carbs,
                        "protein" => $request->protein,
                        "fats" => $request->fats,
                        "calories" => $request->calories
                    ]);
                    $product = Product::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'img_path' => $request->file('image')->getClientOriginalName(),
                        'price' => $request->price,
                        'weight' => $request->weight,
                        'sale_id' => $request->sale,
                        'category_id' => $request->category,
                        'product_attribute_id' => $attributes->id,
                    ]);

                    if ($request->isNew) {
                        $labelId = Label::where('code', 'new')->first()->id;
                        ProductLabel::create([
                            'product_id' => $product->id,
                            'label_id' => $labelId
                        ]);
                    }
                    Cache::forget("products" . $product->category_id);
//                    Cache::forget("products" . "new");
                });
            } else {
                DB::transaction(function () use ($request) {
                    $elem = Product::find($request->route('id'));
                    $categories = [$elem->category_id, $request->category];

                    $attributes = ProductAttribute::find($elem->product_attribute_id);

                    $attributes->carbs = $request->carbs;
                    $attributes->protein = $request->protein;
                    $attributes->fats = $request->fats;
                    $attributes->calories = $request->calories;
                    $attributes->save();

                    $elem->title = $request->title;
                    $elem->description = $request->description;
                    $elem->img_path = $request->file('image')->getClientOriginalName();
                    $elem->price = $request->price;
                    $elem->is_active = $request->isActive ?? false;
                    $elem->weight = $request->weight;
                    $elem->sale_id = $request->sale;
                    $elem->category_id = $request->category;
                    $elem->save();

                    $labelId = Label::where('code', 'new')->first()->id;
                    $label = ProductLabel::where('product_id', $elem->id)->where('label_id', $labelId)->first();
                    if ($request->isNew) {
                        if (!$label) {
                            ProductLabel::create([
                                'product_id' => $elem->id,
                                'label_id' => $labelId
                            ]);
                        }
                    } else {
                        if ($label) $label->delete();
                    }

                    Cache::forget("products" . $categories[0]);
                    Cache::forget("products" . $categories[1]);
//                    Cache::forget("products" . $categories[2]);
                });
            }

            return response()->json(["status" => 'ok', "redirect" => route('admin.products'), 'id' => $request->route('id')]);
        }
    }

    public function addCoupon(Request $request): JsonResponse
    {
        $elem = Coupon::find($request->route('id'));
        $valid = [];
        if ($elem && $elem->code !== $request->code) {
            $valid = $this->checkField($request->all(), new CouponRequest());
        }

        if ($valid) {
            return response()->json(["status" => "error", "errors" => $valid, "ee" => $request->query('action')]);
        } else {
            if ($request->query('action') === 'add') {
                Coupon::create([
                    'code' => $request->code,
                    'sale_id' => $request->sale,
                ]);
            } else {
                $elem->code = $request->code;
                $elem->sale_id = $request->sale;
                $elem->is_active = $request->isActive ?? false;

                $elem->save();
            }

            return response()->json(["status" => 'ok', "redirect" => route('admin.coupons'), 'id' => $request->route('id')]);
        }
    }

    public function addQuiz(Request $request): JsonResponse
    {
        $valid = $this->checkField($request->all(), new QuizRequest());
        $isFile = ($request->hasFile('image')) ? [] : ['image' => 'Выберите картинку'];

        $errors = $valid + $isFile;

        if ($errors) {
            return response()->json(["status" => "error", "errors" => $errors]);
        } else {
            $path = $this->uploadFile($request->file('image'), 'images/quizzes');
            if ($request->query('action') === 'add') {
                Quiz::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'img_path' => $request->file('image')->getClientOriginalName(),
                    'coupon_id' => $request->coupon
                ]);
            } else {
                $quiz = Quiz::find($request->route('id'));
                $quiz->title = $request->title;
                $quiz->description = $request->description;
                $quiz->img_path = $request->file('image')->getClientOriginalName();
                $quiz->coupon_id = $request->coupon;
                $quiz->is_active = $request->isActive ?? false;

                $quiz->save();
            }

            return response()->json(["status" => 'ok', "redirect" => route('admin.quizzes'), 'id' => $request->route('id')]);
        }
    }

    public function addQuestion(Request $request): JsonResponse
    {
        $valid = $this->checkField($request->all(), new StringRequest());

        if ($valid) {
            return response()->json(["status" => "error", "errors" => $valid, "answer" => $request->answer]);
        } else {
            DB::transaction(function () use ($request) {
                $question = Question::create([
                    "text" => $request->question,
                    "quiz_id" => $request->route('id')
                ]);
                foreach ($request->answer as $key => $answer) {
                    Answer::create([
                        'text' => $answer,
                        'question_id' => $question->id,
                        'is_correct' => $key === 0
                    ]);
                }
            });
            $redirect = route('admin.quizzes');
            if ($request->action === 'continue') {
                $redirect = route('admin.quizzes', ['action' => 'questions', 'id' => $request->route('id')]);
            }
            return response()->json(["status" => "ok", "redirect" => $redirect]);
        }
    }

    public function delete(Request $request): JsonResponse
    {
        switch ($request->route('table')) {
            case 'quiz':
                $elem = Quiz::find($request->id);
                break;
            case 'product':
                $elem = Product::find($request->id);
                Cache::forget("products" . $elem->category_id);
                break;
            case 'coupon':
                $elem = Coupon::find($request->id);
                break;
            case 'user':
                $elem = User::find($request->id);
                break;
        }
        if ($elem) $elem->delete();
        return response()->json(['status' => 'ok']);

    }

    public function updateReserve(Request $request): JsonResponse
    {
        $reserve = BookTable::find($request->id);
        $reserve->is_active = $request->active;
        $reserve->save();
        return response()->json($request);
    }

    public function updateOrder(Request $request): JsonResponse
    {
        $order = Order::find($request->id);
        $order->status_id = $request->status;
        $order->save();
        return response()->json($request);
    }
    private function uploadFile($image, string $folder): string
    {
        $fileName = $image->getClientOriginalName();
        return $image->move(public_path($folder), $fileName);
    }

    private function checkField(array $data, $valid): array
    {
        $rules = $valid;
        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray();
    }

    private function getActiveCoupons(): array
    {
        $quizzesCoupon = Quiz::with('coupon')->pluck('coupon_id');
        $coupons = Coupon::where('is_active', true)->pluck('id');
        $showCoupons = $coupons->diff($quizzesCoupon);

        return ['coupons' => Coupon::whereIn('id', $showCoupons)->get()];
    }
}
