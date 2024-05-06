<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\LastnameRequest;
use App\Http\Requests\NameRequest;
use App\Http\Requests\PasswordRepeatRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\StringRequest;
use App\Models\User;
//use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class RegistrationController extends Controller
{
    private function checkField(array $data, $valid):array
    {
        $rules = $valid;
        $validator = Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray() ;
    }

    public function create(Request $request) {
        $validatorName = $this->checkField($request->all(), new NameRequest());
        $validatorLastname = $this->checkField($request->all(), new LastnameRequest());
        $validatorEmail = $this->checkField($request->all(), new EmailRequest());
        $validatorPassword = $this->checkField($request->all(), new PasswordRequest());
        $validatorPasswordRepeat = $this->checkField($request->all(), new PasswordRepeatRequest());

        $validatorData = $validatorName + $validatorLastname + $validatorEmail + $validatorPassword + $validatorPasswordRepeat;

        if(count($validatorData) == 0) {
            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
            ]);

            if($user) {
                Auth::login($user);
                return response()->json(['status' => "ok", 'data' => "Пользователь успешно зарегистрирован и авторизирован"]);
            }

        } else {
            return response()->json(['status' => "error", 'errors' => $validatorData]);
        }
    }
}
