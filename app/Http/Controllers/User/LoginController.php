<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Validation;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->except('_token');
            $validator = Validation::userAuthData($data);
            if ($validator->fails()) {
                return redirect()->back()->with('error', config('custom.login.error_data'));
            }
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
            {
                return redirect()->route('admin')->with('success', config('custom.login.success_auth'));
            }
            return redirect()->back()->with('error', config('custom.login.error_auth'));
        }

        $this->data['title'] = 'Вход в панель управления';

        return view('user._login', $this->data);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
