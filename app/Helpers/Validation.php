<?php

namespace App\Helpers;

use Validator;

class Validation
{
    public static function postData(array $data)
    {
        return Validator::make($data, [
            'head'     => 'required|string',
            'category' => 'nullable|integer',
            'image'    => 'nullable|image|mimes:JPG,jpg,PNG,png,JPEG,jpeg,GIF,gif,SVG,svg|max:2048',
        ]);
    }

    public static function userAuthData($data)
    {
        return Validator::make($data, [
            'email'    => 'email|required|string',
            'password' => 'required|string'
        ]);
    }

    public static function userRegisterData($data)
    {
        return Validator::make($data, [
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
        ]);
    }

    public static function userData($data)
    {
        return Validator::make($data, [
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5',
            'role'     => 'required|integer',
        ]);
    }
}
