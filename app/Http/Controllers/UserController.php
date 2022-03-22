<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        if ($data['email']) {
            $user = User::where('email', $data['email'])->first();
            if ($user) {
                return response(['Данная почта уже зарегестрирована'], 500);
            }
        }
        if ($data['user_password'] && $data['first_name'] && $data['email']) {
            User::forceCreate([
                'name'     => $data['first_name'],
                'password' => md5($data['user_password']),
                'email'    => $data['email'],
                'username' => $data['user_name'],
            ]);
            return redirect('/');
        } else {
            return response(['Вы не ввели все данные для регистрации'], 500);
        }
    }
}
