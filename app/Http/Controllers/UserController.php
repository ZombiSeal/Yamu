<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\NameRequest;
use App\Http\Requests\PasswordRepeatRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\PhoneNoRequiredRequest;
use App\Http\Requests\PhoneRequest;
use App\Models\BookTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    public function index()
    {
        return view('account.data');
    }

    public function create(Request $request): JsonResponse
    {
        $validatorName = $this->checkField($request->all(), new NameRequest());
        $validatorEmail = $this->checkField($request->all(), new EmailRequest());
        $validatorPassword = $this->checkField($request->all(), new PasswordRequest());
        $validatorPasswordRepeat = $this->checkField($request->all(), new PasswordRepeatRequest());

        $validatorData = $validatorName + $validatorEmail + $validatorPassword + $validatorPasswordRepeat;

        if (count($validatorData) == 0) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user) {
                Auth::login($user);
                return response()->json(['status' => "ok", 'message' => "Пользователь успешно зарегистрирован и авторизирован"]);
            }

        }

        return response()->json(['status' => "error", 'errors' => $validatorData]);
    }

    public function login(Request $request): JsonResponse
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

        return response()->json(['status' => 'error', 'loginError' => 'Неверный логин или пароль']);

    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('main');
    }

    public function edit(Request $request): JsonResponse
    {
        $nameErr = ($request->name) ? $this->checkField($request->all(), new NameRequest()) : [];
        $emailErr = ($request->email !== Auth::user()->email) ? $this->checkField($request->all(), new EmailRequest()) : [];
        $phoneErr = ($request->phone) ? $this->checkField($request->all(), new PhoneRequest()) : [];


        $errors = $nameErr + $emailErr + $phoneErr;

        if (count($errors) === 0) {
            $date = \DateTime::createFromFormat('d.m.Y', $request->birthday);
            $birthday = $date->format('Y-m-d');
            User::where("email", Auth::user()->email)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $birthday
            ]);
            return response()->json(['status' => 'ok', 'message' => 'Данные успешно изменены']);

        } else {
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }

    }

    public function editPassword(Request $request) : JsonResponse
    {
        $passwordErr = ($request->password) ? $this->checkField($request->all(), new PasswordRequest()) : [];
        $repeatPassErr = ($request->password_repeat) ? $this->checkField($request->all(), new PasswordRepeatRequest()) : [];

        $errors = $passwordErr + $repeatPassErr;

        if (count($errors) == 0) {
            User::where("email", Auth::user()->email)->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->json(['status' => 'ok', 'message' => 'Пароль успешно изменен']);

        } else {
            return response()->json(['status' => 'error', 'errors' => $errors]);

        }

    }

    public function showUserTables()
    {
        $tables = BookTable::where('user_id', Auth::id())->orderBy('date','desc')->with('table')->get();
        if(!$tables->isEmpty()){
            foreach ($tables as $table) {
                $table->date = \DateTime::createFromFormat('Y-m-d', $table->date)->format('d.m.Y');
                $table->time = \DateTime::createFromFormat('H:i:s', $table->time)->format('H:i');
            }
        }
        return view('account.reserve', ['tables' => $tables]);
    }
    private function checkField(array $data, $valid) : array
    {
        $rules = $valid;
        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray();
    }
}
