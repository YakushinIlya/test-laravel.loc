<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Validation;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        if($request->isMethod('post')) {
            $data      = $request->except('_token');
            $validator = Validation::userRegisterData($data);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', config('custom.login.error_data'));
            }
            if ($this->create($data))
            {
                Auth::attempt(['email' => $data['email'], 'password' => $data['password']]);
                return redirect()->route('admin')->with('success', config('custom.login.success_auth'));
            }
            return redirect()->back()->with('error', config('custom.login.error_reg'));
        }

        $this->data['title'] = 'Регистрация';

        return view('user._register', $this->data);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
        ]);
        $user->role()->attach(1);
        return $user;
    }
}
