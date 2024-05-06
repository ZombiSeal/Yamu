<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\LastnameRequest;
use App\Http\Requests\NameRequest;
use App\Http\Requests\PasswordRepeatRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\PhoneNoRequiredRequest;
use App\Http\Requests\PhoneRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('account.data');
    }

    public function edit(Request $request)
    {
        $nameErr = ($request->name) ? $this->checkField($request->all(), new NameRequest()) : [];
        $lastnameErr = ($request->lastname) ? $this->checkField($request->all(), new LastnameRequest()) : [];
        $emailErr = ($request->email !== Auth::user()->email) ? $this->checkField($request->all(), new EmailRequest()) : [];
        $phoneErr = ($request->phone) ? $this->checkField($request->all(), new PhoneRequest()) : [];


        $errors = $nameErr + $lastnameErr + $emailErr + $phoneErr;

        if(count($errors) === 0) {
            User::where("email", Auth::user()->email)->update([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday
            ]);
            return response()->json(['status' => 'ok', 'message'=>'Данные успешно изменены']);

        } else {
            return response()->json(['status' => 'error', 'errors' => $errors]);
        }

    }

    public function editPassword(Request $request)
    {
        $passwordErr = ($request->password) ? $this->checkField($request->all(), new PasswordRequest()) : [];
        $repeatPassErr = ($request->password_repeat) ? $this->checkField($request->all(), new PasswordRepeatRequest()) : [];

        $errors =  $passwordErr + $repeatPassErr;

        if(count($errors) == 0) {
            User::where("email", Auth::user()->email)->update([
                'password' => Hash::make($request->password),
            ]);
            return response()->json(['status' => 'ok', 'message'=>'Пароль успешно изменен']);

        } else {
            return response()->json(['status' => 'error', 'errors'=>$errors]);

        }

    }

    private function checkField(array $data, $valid):array
    {
        $rules = $valid;
        $validator = \Illuminate\Support\Facades\Validator::make($data, $rules->rules(), $rules->messages());
        return $validator->errors()->toArray() ;
    }
}
